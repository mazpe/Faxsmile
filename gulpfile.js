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

    // admin style
    mix.styles([
        'resources/assets/css/global.css',
        'bower_components/Ionicons/css/ionicons.css',
        'bower_components/AdminLTE/dist/css/AdminLTE.css',
        'bower_components/AdminLTE/dist/css/skins/skin-blue.min.css'
    ], 'public/assets/css/admin.css','./');

    // JavaScript
    mix.scripts([
        'bower_components/jquery/dist/jquery.js',
        'bower_components/bootstrap/dist/js/bootstrap.js',
    ], 'resources/assets/js/global.js','./');

    mix.scripts([
        'resources/assets/js/global.js',
        'node_modules/bootstrap-sass/assets/javascripts/bootstrap.js',
        'bower_components/AdminLTE/dist/js/app.js',
    ], 'public/assets/js/admin.js','./');

    // Tasks
    mix.copy('node_modules/bootstrap-sass/assets/fonts/bootstrap', 'public/assets/fonts');
    mix.copy('node_modules/font-awesome/fonts','public/assets/fonts');
    mix.copy('bower_components/AdminLTE/dist/img', 'public/assets/images/admin');
    mix.copy('bower_components/Ionicons/fonts','public/assets/fonts');


    // Browser Sync
    mix.browserSync({
        proxy: 'faxsmile.app'
    });
});