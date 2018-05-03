let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
    // .js('resources/assets/js/select2.min.js', 'public/js/select2.js')
    // .styles('resources/assets/sass/select2.min.css', 'public/css/select2.css')
    .sass('resources/assets/sass/app.scss', 'public/css');
