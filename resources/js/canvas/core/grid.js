export function initGrid(canvas) {
    const gridSize = 50;

    const grid = [];

    const width = 5000;
    const height = 5000;

    for (let i = -width; i < width; i += gridSize) {
        grid.push(new fabric.Line([i, -height, i, height], {
            stroke: '#2a2a40',
            selectable: false,
            evented: false
        }));
    }

    for (let i = -height; i < height; i += gridSize) {
        grid.push(new fabric.Line([-width, i, width, i], {
            stroke: '#2a2a40',
            selectable: false,
            evented: false
        }));
    }

    const group = new fabric.Group(grid, {
        selectable: false,
        evented: false
    });

    canvas.add(group);
    canvas.sendToBack(group);
}