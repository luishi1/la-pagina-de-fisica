export function initViewport(canvas) {
    

    canvas.on('mouse:wheel', function(opt) {
        let delta = opt.e.deltaY;
        let zoom = canvas.getZoom();
        
        const step = 0.85;
        if (delta > 0) zoom *= step;
        else zoom /= step;

        zoom = Math.min(Math.max(zoom, 0.05), 20);

        canvas.zoomToPoint(
            { x: opt.e.offsetX, y: opt.e.offsetY },
            zoom
        );

        opt.e.preventDefault();
        opt.e.stopPropagation();
        canvas.requestRenderAll();
    });


    let isDragging = false;
    let lastX, lastY;

    canvas.on('mouse:down', function(opt) {
        // Solo arrastramos si NO tocamos un objeto (o si presionamos Alt)
        if (!opt.target || opt.e.altKey) {
            isDragging = true;
            canvas.selection = false; 
            
            lastX = opt.e.clientX;
            lastY = opt.e.clientY;
            canvas.defaultCursor = 'grabbing';
        }
    });

    canvas.on('mouse:move', function(opt) {
        if (isDragging) {
            let e = opt.e;
            let vpt = canvas.viewportTransform;

            // Mover la cámara
            vpt[4] += e.clientX - lastX;
            vpt[5] += e.clientY - lastY;

            canvas.requestRenderAll();
            
            lastX = e.clientX;
            lastY = e.clientY;
        }
    });

    canvas.on('mouse:up', function() {
        isDragging = false;
        
        // Volvemos a activar la selección por si luego quieres mover objetos
        canvas.selection = true; 
        canvas.defaultCursor = 'default';
    });
}