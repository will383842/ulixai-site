import './bootstrap';
import toastr from 'toastr';
import 'toastr/build/toastr.min.css';

// Import des popups de catégories
import { initializeCategoryPopups } from './modules/ui/category/category-popups.js';

// Initialise quand le DOM est prêt
document.addEventListener('DOMContentLoaded', () => {
  initializeCategoryPopups();
});

// Rend la fonction globale pour les boutons onclick=""
window.initializeCategoryPopups = initializeCategoryPopups;