const elixir = require('laravel-elixir');

require('laravel-elixir-vue');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    // CSS
    elixir(function(mix) {
        mix.sass([
            'global.scss',
            ],'resources/assets/css/global.css');
    });

    // - admin
    mix.styles([
        'resources/assets/css/global.css',
        'bower_components/Ionicons/css/ionicons.css',
        'bower_components/AdminLTE/dist/css/AdminLTE.css',
        'bower_components/AdminLTE/dist/css/skins/skin-blue.min.css',
        'bower_components/datatables.net-bs/css/dataTables.bootstrap.css',
    ], 'public/assets/css/admin.css','./');

    // JavaScript
    // - admin
    mix.scripts([
        'bower_components/jquery/dist/jquery.js',
        'node_modules/bootstrap-sass/assets/javascripts/bootstrap.js',
        'bower_components/AdminLTE/dist/js/app.js',
        'bower_components/html5shiv/dist/html5shiv.js',
        'bower_components/respond/dest/respond.src.js',
        'bower_components/datatables.net/js/jquery.dataTables.js',
        'bower_components/datatables.net-bs/js/dataTables.bootstrap.js',
    ], 'public/assets/js/admin.js','./');

    // Tasks
    // - fonts
    mix.copy('node_modules/bootstrap-sass/assets/fonts/bootstrap', 'public/assets/fonts');
    mix.copy('node_modules/font-awesome/fonts','public/assets/fonts');
    mix.copy('bower_components/Ionicons/fonts','public/assets/fonts');

    // - images
    mix.copy('bower_components/AdminLTE/dist/img', 'public/assets/images/admin');

    // Browser Sync
    mix.browserSync({
        proxy: 'faxsmile.app'
    });
});