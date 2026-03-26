import './bootstrap';
import Alpine from 'alpinejs';
// Importamos la función por defecto y la nombramos uiState
import uiState from './ui-state'; 
import './canvas-logic';

window.Alpine = Alpine;

// Registro del componente: 
// El primer parámetro es el nombre que usas en x-data="physicsApp()"
// El segundo es la función que importamos arriba
Alpine.data('physicsApp', uiState); 

Alpine.start();