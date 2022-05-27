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

mix.scripts(['public/vendor/jquery/jquery.min.js',
            'public/vendor/bootstrap/js/bootstrap.bundle.min.js',
            'public/vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js',
            'public/vendor/adminlte/dist/js/adminlte.min.js'], 'public/js/app.js')
    .sass('resources/sass/app.scss', 'public/css');
