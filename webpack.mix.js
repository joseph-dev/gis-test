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

/**
 * Combine js scripts
 */
mix.scripts([
    'node_modules/jquery/dist/jquery.js',
    'node_modules/bootstrap/dist/js/bootstrap.js'
], 'public/js/libs.js');

/**
 * Compile main script
 */
mix.js('resources/assets/js/app.js', 'public/js/app.js');

/**
 * Combine css
 */
mix.styles([
    'node_modules/bootstrap/dist/css/bootstrap.css'
], 'public/css/libs.css');

/**
 * Compile main css
 */
mix.sass('resources/assets/sass/app.scss', 'public/css/app.css');
