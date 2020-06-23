const mix = require('laravel-mix');

mix.js('js/app.js', 'public/js')
    .postCss('css/app.css', 'public/css', [
        require('tailwindcss'),
        require('autoprefixer'),
    ]);