var elixir = require('laravel-elixir');
var path = require('path');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    //mix.less('app.less');
    mix

        .copy(
            'node_modules/admin-lte/bootstrap/fonts',
            'public/build/fonts/bootstrap'
        )

        .copy(
            'node_modules/admin-lte/dist/img',
            'public/build/img/adminlte'
        )

        .copy(
            'node_modules/admin-lte/bootstrap/css',
            'resources/assets/css/bootstrap'
        )

        .copy(
            'node_modules/admin-lte/dist/css',
            'resources/assets/css/adminlte'
        )

        .copy(
            'node_modules/jquery/dist/jquery.min.js',
            'resources/assets/js/jquery'
        )

        .copy(
            'node_modules/admin-lte/bootstrap/js/bootstrap.min.js',
            'resources/assets/js/bootstrap'
        )

        .copy(
            'node_modules/admin-lte/dist/js',
            'resources/assets/js/adminlte'
        )

        .styles([
            'bootstrap/bootstrap.min.css',
            'adminlte/skins/_all-skins.min.css',
            'adminlte/AdminLTE.min.css'
        ],'public/css/app.css')

        .scripts([
            'jquery/jquery.min.js',
            'bootstrap/bootstrap.min.js',
            'adminlte/app.min.js'
        ],'public/js/app.js')

        /**
        * Apply version control
        */

        .version([
         "public/css/app.css",
         "public/js/app.js"         
         ]);

        


    mix.phpUnit([] , path.normalize('vendor/bin/phpunit') + ' --verbose');
});
