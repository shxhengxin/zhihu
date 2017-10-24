let mix = require('laravel-mix');
const proxy = require('http-proxy-middleware');

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

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');
// 设置代理
var middleware = proxy('**', {
    target: 'http://zhihu.app',
    changeOrigin: true,
    logLevel: 'debug',
    pathRewrite: {
        // '^/api' : ''
    },
});

mix.browserSync({
    middleware: [middleware]
});