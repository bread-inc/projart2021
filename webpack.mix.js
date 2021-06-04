const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

 mix.styles([
    'public/css/root.css',
    'public/css/normalize.css',
    'public/css/general.css',
    'public/css/components.css',
    'public/css/login.css',
], 'public/css/all.css');

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps();

mix.js('resources/js/vue.js', 'public/js')
    .vue();
