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
    mix.styles([
        './bower_components/bootstrap/dist/css/bootstrap.css',
        './bower_components/AdminLTE/dist/css/AdminLTE.css',
        './bower_components/AdminLTE/dist/css/skins/skin-blue.min.css'
    ], 'public/assets/css/admin.css');

    mix.scripts([
        './bower_components/jquery/dist/jquery.js',
        './bower_components/bootstrap/dist/js/bootstrap.js',
        './bower_components/AdminLTE/dist/js/app.js',
    ], 'public/assets/js/admin.js');

    mix.copy('./bower_components/AdminLTE/dist/img', 'public/assets/images/admin');
    mix.copy('bower_components/bootstrap/dist/fonts', 'public/assets/fonts');

    mix.browserSync({
        proxy: 'faxsmile.app'
    });
});