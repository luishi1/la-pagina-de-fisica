export function initCoordinates(canvas) {
    canvas.on("mouse:move", function(opt) {
        const pointer = canvas.getPointer(opt.e);

        // DEBUG (después lo mandás al footer)
        console.log(`x: ${pointer.x.toFixed(2)}, y: ${pointer.y.toFixed(2)}`);
    });
}