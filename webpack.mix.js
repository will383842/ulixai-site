const mix = require('laravel-mix');

// Configuration pour Tailwind v4
mix.js('resources/js/app.js', 'public/js')
   // ❌ RETIREZ cette ligne :
   // .js('resources/js/header-init.js', 'public/js')
   
   .js('resources/js/modules/wizard/wizard_request_help/request-form.js', 'public/js')
   .postCss('resources/css/app.css', 'public/css', [
       require('@tailwindcss/postcss'),
   ])
   // ✅ AJOUTEZ : copier les fichiers JS sans les compiler
   .copyDirectory('resources/js/modules', 'public/js/modules')
   .copy('resources/js/header-init.js', 'public/js/header-init.js');

if (mix.inProduction()) {
    mix.version();
}