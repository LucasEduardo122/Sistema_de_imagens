const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.
    scripts('node_modules/jquery/dist/jquery.js', 'public/site/assets/js/jquery.js')
    .sass('resources/scss/materialize.scss', 'public/site/assets/css/materialize.css')
    .scripts('node_modules/materialize-css/dist/js/materialize.js', 'public/site/assets/js/materialize.js')

