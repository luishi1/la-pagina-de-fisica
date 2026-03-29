export function initViewport(canvas) {

    // 🔍 ZOOM
    canvas.on('mouse:wheel', function(opt) {
        let delta = opt.e.deltaY;
        let zoom = canvas.getZoom();

        zoom *= 0.999 ** delta;

        zoom = Math.min(Math.max(zoom, 0.2), 5);

        canvas.zoomToPoint(
            { x: opt.e.offsetX, y: opt.e.offsetY },
            zoom
        );

        opt.e.preventDefault();
        opt.e.stopPropagation();
    });

    // 🖐️ PAN
    let isDragging = false;
    let lastX, lastY;

    canvas.on('mouse:down', function(opt) {
        if (opt.e.altKey) {
            isDragging = true;
            canvas.selection = false;
            lastX = opt.e.clientX;
            lastY = opt.e.clientY;
        }
    });

    canvas.on('mouse:move', function(opt) {
        if (isDragging) {
            let e = opt.e;
            let vpt = canvas.viewportTransform;

            vpt[4] += e.clientX - lastX;
            vpt[5] += e.clientY - lastY;

            canvas.requestRenderAll();

            lastX = e.clientX;
            lastY = e.clientY;
        }
    });

    canvas.on('mouse:up', function() {
        isDragging = false;
        canvas.selection = true;
    });
}