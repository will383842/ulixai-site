const mix = require('laravel-mix');

// ============================================
// COMPILATION DES ASSETS
// ============================================

// JavaScript
mix.js('resources/js/app.js', 'public/js')
   .js('resources/js/header-init.js', 'public/js')
   .js('resources/js/modules/wizard/wizard_request_help/request-form.js', 'public/js')
   .js('resources/js/pages/index.js', 'public/js/pages')
   .js('resources/js/pages/my-account.js', 'public/js/pages')

// CSS avec Tailwind v3
mix.postCss('resources/css/app.css', 'public/css', [
       require('tailwindcss'),
       require('autoprefixer'),
   ])
   .postCss('resources/css/pages/index.css', 'public/css/pages', [])

// Vendor CSS (Font Awesome, Toastr) - bundled locally instead of CDN
mix.styles([
    'node_modules/@fortawesome/fontawesome-free/css/all.min.css',
    'node_modules/toastr/build/toastr.min.css',
], 'public/css/vendor.css')

// Copy Font Awesome webfonts
mix.copyDirectory('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/webfonts')

// Options globales
mix.options({
     processCssUrls: false,
     postCss: [
       require('autoprefixer'),
     ]
   })
   
// Minification en production
if (mix.inProduction()) {
    mix.version(); // Cache busting
}

// Source maps en développement
if (!mix.inProduction()) {
    mix.sourceMaps();
}