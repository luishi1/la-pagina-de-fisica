let canvas;

export function initCanvas() {
    canvas = new fabric.Canvas("physicsCanvas", {
        selection: true,
        // Te recomiendo agregar esto para mejor rendimiento con objetos físicos
        renderOnAddRemove: false 
    });

    const container = document.getElementById("canvas-container");

    // Observador moderno: Si el contenedor cambia de tamaño, ajusta el canvas automáticamente
    const resizeObserver = new ResizeObserver(() => {
        resizeCanvas();
    });
    resizeObserver.observe(container);

    initViewport(canvas);
    initGrid(canvas);
    initCoordinates(canvas);
}

function resizeCanvas() {
    const container = document.getElementById("canvas-container");
    
    // Fabric maneja su propio wrapper, le pasamos las medidas exactas del padre
    canvas.setWidth(container.clientWidth);
    canvas.setHeight(container.clientHeight);
    
    canvas.calcOffset(); 
    canvas.renderAll();
}

export function getCanvas() {
    return canvas;
}
