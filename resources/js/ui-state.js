export default () => ({
    module: 'Cinematica 1D',
    terminalLines: [
        '>> Inicializando motor de fisica ...',
        '>> Sistema listo.'
    ],

    changeModule(newModule) {  
        this.module = newModule;
        this.terminalLines.push(`>> Cambiando a ${newModule} ...`);
    } 
});