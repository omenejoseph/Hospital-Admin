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

mix.js(['resources/assets/js/app.js', 
    'public/plugins/jQuery/jquery-2.2.3.min.js',
    'public/bootstrap/js/bootstrap.min.js',
    'public/plugins/slimScroll/jquery.slimscroll.min.js',
    'public/plugins/fastclick/fastclick.js',
    'public/dist/js/app.min.js',
    'public/dist/js/demo.js',
    ], 'public/js/all.js');
   

   mix.styles([
    'public/bootstrap/css/bootstrap.min.css',
    'public/fonts/font-awesome.min.css',
    'public/fonts/ionicons.min.css',
    'public/dist/css/AdminLTE.min.css',
    'public/dist/css/skins/_all-skins.min.css',
], 'public/css/all.css');
