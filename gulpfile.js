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

elixir(function (mix) {
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
        'node_modules/jquery/dist/jquery.min.js',
        'resources/assets/js/jquery'
    )

    .copy(
        'node_modules/admin-lte/bootstrap/css',
        'resources/assets/css/bootstrap'
    )

    .copy(
        'node_modules/admin-lte/bootstrap/js/bootstrap.min.js',
        'resources/assets/js/bootstrap'
    )

    .copy(
        'node_modules/admin-lte/dist/css',
        'resources/assets/css/adminlte'
    )

    .copy(
        'node_modules/admin-lte/dist/js',
        'resources/assets/js/adminlte'
    )

    .copy(
        'node_modules/admin-lte/plugins/select2/select2.min.css',
        'resources/assets/css/select2'
    )

    .copy(
        'node_modules/admin-lte/plugins/select2/select2.min.js',
        'resources/assets/js/select2'
    )

    .copy(
        'node_modules/admin-lte/plugins/slimScroll/jquery.slimscroll.min.js',
        'resources/assets/js/slimScroll'
    )

    .copy(
        'node_modules/parsleyjs/src/parsley.css',
        'resources/assets/css/parsley'
    )

    .copy(
        'node_modules/parsleyjs/dist/parsley.min.js',
        'resources/assets/js/parsley'
    )

    .copy(
        'node_modules/admin-lte/plugins/datatables/dataTables.bootstrap.css',
        'resources/assets/css/dataTables'
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
        'node_modules/numeral/min/numeral.min.js',
        'resources/assets/js/numeral'
    )

    .copy(
        'node_modules/react-dom/dist/react-dom.js',
        'resources/assets/js/react/react-dom.js'
    )

    .copy(
        'node_modules/jquery-confirm/dist/jquery-confirm.min.css',
        'resources/assets/css/jquery-confirm/jquery.confirm.min.css'
    )

    .copy(
        'node_modules/jquery-confirm/dist/jquery-confirm.min.js',
        'resources/assets/js/jquery-confirm/jquery.confirm.min.js'
    )

    .copy(
        'node_modules/react/dist/react.js',
        'resources/assets/js/react/react.js'
    )

    .copy(
        'node_modules/react-dom/dist/react-dom.js',
        'resources/assets/js/react/react-dom.js'
    )

    .copy(
        'resources/assets/js/ckeditor',
        'public/build/js/ckeditor'
    )

    .copy(
        'resources/assets/jsx',
        'public/build/jsx'
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
        'jquery-confirm/jquery.confirm.min.css',
        'cannybrain/site.css',
        'cannybrain/mcq.css',
        'cannybrain/questionViewer.css'
    ], 'public/css/utility.css')

    .styles([
        'datatables/dataTables.bootstrap.css',
        'datatables/buttons.dataTables.min.css',
        'datatables/select.dataTables.min.css'
    ], 'public/css/dataTables.css')


    .scripts([
        'jquery/jquery.min.js',
        'bootstrap/bootstrap.min.js',
        'adminlte/app.min.js'
    ], 'public/js/app.js')


    .scripts([
        'parsley/parsley.min.js',
        'select2/select2.min.js',
        'pace/pace.min.js',
        'moment/moment.min.js',
        'moment/locales.min.js',
        'numeral/numeral.min.js',
        'jquery-confirm/jquery.confirm.min.js',
        'slimScroll/jquery.slimscroll.min.js',
        'cannybrain/site.js'
    ], 'public/js/utility.js')

    .scripts([
        'dataTables/jquery.datatables.min.js',
        'dataTables/dataTables.bootstrap.min.js',
        'dataTables/dataTables.buttons.min.js',
        'dataTables/dataTables.select.min.js'
    ], 'public/js/dataTables.js')

    .scripts([
        'react/react.js',
        'react/react-dom.js',
        'react/browser.min.js',
    ], 'public/js/react.js')

    /**
     * Apply version control
     */

    .version([
        "public/css/app.css",
        "public/js/app.js",
        "public/css/utility.css",
        "public/js/utility.js",
        "public/css/dataTables.css",
        "public/js/dataTables.js",
        "public/js/react.js"
    ]);




    //mix.phpUnit([] , path.normalize('vendor/bin/phpunit') + ' --verbose');
});