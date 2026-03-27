export default () => ({
    module: 'Cinematica 1D',
    status: 'Sistema listo: Cinematica 1D cargada.',
    mobileMenu: false,
    showItems: false,
    showProps: false,

    changeModule(newModule) {  
        if (this.module === newModule) return;
        this.module = newModule;
        this.status = `Ejecutando: ${newModule}`;
    } 
});