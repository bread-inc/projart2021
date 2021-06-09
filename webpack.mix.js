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
    'resources/css/root.css',
    'resources/css/normalize.css',
    'resources/css/general.css',
    'resources/css/components.css',
    'resources/css/dashboard.css',
    'resources/css/menu.css',
    'resources/css/login.css',
    'resources/css/navbar.css',
    'resources/css/regions.css',
    'resources/css/user-profile.css',
    'resources/css/scoreboard.css',
], 'public/css/all.css');

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps();

mix.js('resources/js/vue.js', 'public/js')
    .vue();
