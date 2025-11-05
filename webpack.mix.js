const mix = require('laravel-mix');

// Configuration pour Tailwind v4
mix.js('resources/js/app.js', 'public/js')
   .js('resources/js/header-init.js', 'public/js')
   .js('resources/js/request-form.js', 'public/js')
   .postCss('resources/css/app.css', 'public/css', [
       require('@tailwindcss/postcss'),  // ✅ NOUVEAU
   ]);

if (mix.inProduction()) {
    mix.version();
}