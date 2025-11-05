const mix = require('laravel-mix');

mix
  .js("resources/js/app.js", "public/js")
  .js("resources/js/header-init.js", "public/js")
  .postCss("resources/css/app.css", "public/css", [
    require("@tailwindcss/postcss"),
  ]);
  // ← Retire la ligne .postCss("resources/css/styles.css", "public/css");