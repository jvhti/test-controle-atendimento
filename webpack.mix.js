const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.autoload({
        jquery: ['$', 'window.jQuery', 'jQuery']
    })
    .js('resources/js/app.js', 'public/js')
    .js('resources/js/gerenciarFuncionario.js', 'public/js')
    .js('resources/js/simular.js', 'public/js')
    .postCss('resources/css/customStyle.css', 'public/css', [])
    .postCss('resources/css/bootstrap.css', 'public/css', []);


if (mix.inProduction()) {
    mix.version();
}
