import { enableGrid, disableGrid } from "../canvas/core/grid";

const moduleConfig = {
    "Cinematica 1D": {
        grid: true,
        tools: ["mobile1D", "reference", "trajectory"],
        extras: ["Graficar x(t)", "Graficar v(t)", "Graficar a(t)"],
    },
    "Cinematica 2D": {
        grid: true,
        tools: ["mobile2D", "vector", "projectile"],
        extras: ["Trayectoria", "Vector velocidad"],
    },
    Dinamica: {
        grid: false,
        tools: ["block", "force", "plane"],
        extras: ["DCL", "Resultante"],
    },
    "Trabajo y Energia": {
        grid: false,
        tools: ["mass", "spring"],
        extras: ["Energía", "Gráfico energía"],
    },
    Fluidos: {
        grid: false,
        tools: ["fluid", "container"],
        extras: ["Presión", "Empuje"],
    },
};

export default () => ({
    module: "Cinematica 1D",
    mobileMenu: false,
    showItems: false,
    showProps: false,

    toolsPage: 0, 
    extrasPage: 0,
    itemsPerPage: 6,

    viewRightPanel: "properties",

    init() {
        this.changeModule(this.module);
    },

    get currentTools() {
        return moduleConfig[this.module]?.tools || [];
    },

    get currentExtras() {
        return moduleConfig[this.module]?.extras || [];
    },

    get paginatedTools() {
        const start = this.toolsPage * this.itemsPerPage;
        return this.currentTools.slice(start, start + this.itemsPerPage);
    },

    get paginatedExtras() {
        const start = this.extrasPage * this.itemsPerPage;
        return this.currentExtras.slice(start, start + this.itemsPerPage);
    },

    get totalToolPages() {
        return Math.ceil(this.currentTools.length / this.itemsPerPage);
    },

    get totalExtrasPages() {
        return Math.ceil(this.currentExtras.length / this.itemsPerPage);
    },

    nextTools() {
        if (this.toolsPage < this.totalToolPages - 1) this.toolsPage++;
    },

    prevTools() {
        if (this.toolsPage > 0) this.toolsPage--;
    },

    nextExtras() {
        if (this.extrasPage < this.totalExtrasPages - 1) this.extrasPage++;
    },

    prevExtras() {
        if (this.extrasPage > 0) this.extrasPage--;
    },

    changeModule(m) {
        this.module = m;

        this.toolsPage = 0;
        this.extrasPage = 0;

        if (moduleConfig[m]?.grid) enableGrid();
        else disableGrid();

        if (window.canvas) {
            window.canvas.requestRenderAll();
        }
    },

    toggleToExtras() {
        this.viewRightPanel = "extras";
    },

    toggleToProperties() {
        this.viewRightPanel = "properties";
    },

    addObject(type) {
        console.log("Agregar objeto:", type);
    },
});