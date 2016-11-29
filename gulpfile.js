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
        'public/build/fonts'
        )

        .copy(
        'node_modules/font-awesome/fonts',
        'public/build/fonts'
        )

        .copy(
        'node_modules/ionicons/dist/fonts',
        'public/build/fonts'
        )

        .copy(
        'node_modules/admin-lte/dist/img',
        'public/build/img/adminlte'
        )

        .copy(
        'node_modules/dataTables/media/images',
        'public/build/images'
        )

        .copy(
        'node_modules/font-awesome/css/font-awesome.min.css',
        'resources/assets/css/font-awesome'
        )

        .copy(
        'node_modules/ionicons/dist/css/ionicons.min.css',
        'resources/assets/css/ionicons'
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
        'node_modules/admin-lte/plugins/select2/select2.min.css',
        'resources/assets/css/select2'
        )

        .copy(
        'node_modules/parsleyjs/src/parsley.css',
        'resources/assets/css/parsley'
        )

        .copy(
        'node_modules/admin-lte/plugins/datatables/dataTables.bootstrap.css',
        'resources/assets/css/dataTables'
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

        .copy(
        'node_modules/admin-lte/plugins/select2/select2.min.js',
        'resources/assets/js/select2'
        )

        .copy(
        'node_modules/parsleyjs/dist/parsley.min.js',
        'resources/assets/js/parsley'
        )

        .copy(
        'node_modules/admin-lte/plugins/datatables/jquery.dataTables.min.js',
        'resources/assets/js/dataTables'
        )

        .copy(
        'node_modules/admin-lte/plugins/datatables/dataTables.bootstrap.min.js',
        'resources/assets/js/dataTables'
        )

        .copy(
        'node_modules/moment/min/moment.min.js',
        'resources/assets/js/moment'
        )

        .copy(
        'node_modules/moment/min/locales.min.js',
        'resources/assets/js/moment'
        )

        .styles([
            'font-awesome/font-awesome.min.css',
            'ionicons/ionicons.min.css',
            'bootstrap/bootstrap.min.css',
            'adminlte/skins/_all-skins.min.css',
            'adminlte/AdminLTE.min.css'
        ], 'public/css/app.css')

        .styles([
            'parsley/parsley.css',
            'select2/select2.min.css',
            'pace/pace-theme-flash.css',
            'datatables/dataTables.bootstrap.css',
        ], 'public/css/utility.css')



        .scripts([
            'jquery/jquery.min.js',
            'bootstrap/bootstrap.min.js',
            'adminlte/app.min.js'
        ], 'public/js/app.js')



        .scripts([
            'parsley/parsley.min.js',
            'select2/select2.min.js',
            'pace/pace.min.js',
            'dataTables/jquery.datatables.min.js',
            'dataTables/dataTables.bootstrap.min.js',
            'moment/moment.min.js',
            'moment/locales.min.js'
        ], 'public/js/utility.js')

        /**
        * Apply version control
        */

        .version([
            "public/css/app.css",
            "public/js/app.js",
            "public/css/utility.css",
            "public/js/utility.js"
        ]);




    //mix.phpUnit([] , path.normalize('vendor/bin/phpunit') + ' --verbose');
});
