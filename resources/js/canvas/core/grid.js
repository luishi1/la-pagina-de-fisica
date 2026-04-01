let gridEnabled = true;

export function enableGrid() {
    gridEnabled = true;
}

export function disableGrid() {
    gridEnabled = false;
}

export function initGrid(canvas) {
    canvas.on('before:render', function() {

        if (!gridEnabled) return; // 🔥 CLAVE

        const ctx = canvas.getContext();
        const vpt = canvas.viewportTransform;
        const zoom = canvas.getZoom();
        const width = canvas.getWidth();
        const height = canvas.getHeight();

        ctx.save();
        ctx.transform(vpt[0], vpt[1], vpt[2], vpt[3], vpt[4], vpt[5]);

        const gridSize = 50; 
        const subGridSize = 10; 

        const left = -vpt[4] / zoom;
        const top = -vpt[5] / zoom;
        const right = (width - vpt[4]) / zoom;
        const bottom = (height - vpt[5]) / zoom;

        // 🔹 Subgrilla
        ctx.strokeStyle = '#2a2a40';
        ctx.lineWidth = 0.5 / zoom;
        ctx.beginPath();
        for (let x = Math.floor(left / subGridSize) * subGridSize; x <= right; x += subGridSize) {
            ctx.moveTo(x, top);
            ctx.lineTo(x, bottom);
        }
        for (let y = Math.floor(top / subGridSize) * subGridSize; y <= bottom; y += subGridSize) {
            ctx.moveTo(left, y);
            ctx.lineTo(right, y);
        }
        ctx.stroke();

        // 🔹 Grilla principal
        ctx.strokeStyle = '#3a3a55';
        ctx.lineWidth = 1 / zoom;
        ctx.beginPath();
        for (let x = Math.floor(left / gridSize) * gridSize; x <= right; x += gridSize) {
            ctx.moveTo(x, top);
            ctx.lineTo(x, bottom);
        }
        for (let y = Math.floor(top / gridSize) * gridSize; y <= bottom; y += gridSize) {
            ctx.moveTo(left, y);
            ctx.lineTo(right, y);
        }
        ctx.stroke();

        // 🔹 Ejes
        ctx.lineWidth = 2 / zoom;

        // Eje X
        ctx.strokeStyle = '#4CAF50';
        ctx.beginPath();
        ctx.moveTo(left, 0);
        ctx.lineTo(right, 0);
        ctx.stroke();

        // Eje Y
        ctx.strokeStyle = '#3b82f6';
        ctx.beginPath();
        ctx.moveTo(0, top);
        ctx.lineTo(0, bottom);
        ctx.stroke();

        ctx.restore();
    });
}