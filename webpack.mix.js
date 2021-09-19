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

mix.js('resources/js/app.js', 'public/js')
    .vue({ version: 2 })
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/sb-admin-2.scss', 'public/css/sb-admin-2.min.css')
    .sourceMaps();

    mix.styles([
        'resources/css/libs/blog-post.css',
        'resources/css/libs/bootstrap.css',
        'resources/css/libs/font-awesome.css',
        'resources/css/libs/metisMenu.css',
        'resources/css/libs/sb-admin-2.css',
        'resources/css/sandbox.css',

    ], 'public/css/libs.css');

    mix.scripts([
        'resources/js/libs/jquery.js',
        'resources/js/libs/bootstrap.js',
        'resources/js/libs/metisMenu.js',
        'resources/js/sb-admin-2.js',
        'resources/js/libs/jquery.js',
        'resources/js/libs/scripts.js',
        'resources/vendor/chart.js/Chart.bundle.js',
        'resources/vendor/chart.js/Chart.js',
        'resources/js/sandbox.js',

    ], 'public/js/libs.js');
    mix.js('resources/js/routes','public/js')
    mix.js('resources/js/laravel-echo','public/js')
    mix.js('resources/js/bootstrap.js','public/js');
