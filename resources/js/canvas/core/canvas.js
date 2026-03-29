import { initGrid } from "./grid.js";
import { initViewport } from "./viewport.js";
import { initCoordinates } from "./coordinates.js"; 

let canvas;

export function initCanvas() {
    canvas = new fabric.Canvas("physicsCanvas", {
        selection: true,
        renderOnAddRemove: false 
    });

    const container = document.getElementById("canvas-container");

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
    const width = container.clientWidth;
    const height = container.clientHeight;

    
    canvas.setDimensions({
        width: width,
        height: height
    }, { backstoreOnly: false });

    canvas.calcOffset(); 
    canvas.renderAll();
}
