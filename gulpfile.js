var elixir = require('laravel-elixir');

require('laravel-elixir-livereload');
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

elixir(function (mix) {
    mix
        .styles([
            '../../../vendor/bower-asset/dropzone/dist/dropzone.css',
            '../../../vendor/bower-asset/bootstrap/dist/css/bootstrap.css',
        ])
        .scripts([
            '../../../vendor/bower-asset/jquery/dist/jquery.js',
            '../../../vendor/bower-asset/bootstrap/dist/js/bootstrap.js',
            '../../../vendor/bower-asset/jquery-pjax/jquery.pjax.js',
            'checkout.js',
            'stripe-loader.js',
            'pjax-loader.js',

        ])
        .version([
            'js/all.js',
            'css/all.css'
        ])
        .phpUnit()
        .livereload()
});
