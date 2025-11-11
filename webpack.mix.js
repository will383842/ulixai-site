const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .js('resources/js/header-init.js', 'public/js')
   .js('resources/js/modules/wizard/wizard_request_help/request-form.js', 'public/js')
   .postCss('resources/css/app.css', 'public/css', [
       require('@tailwindcss/postcss'),
   ])
   .options({
     processCssUrls: false
   });

if (mix.inProduction()) {
    mix.version();
}