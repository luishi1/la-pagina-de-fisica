import './bootstrap';
import Alpine from 'alpinejs';
import uiState from './ui/ui-state'; 
import { initCanvas } from './canvas/core/canvas';

window.Alpine = Alpine;
window.initCanvas = initCanvas;

Alpine.data('physicsApp', uiState); 

Alpine.start();