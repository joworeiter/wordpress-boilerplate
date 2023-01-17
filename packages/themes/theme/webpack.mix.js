const mix = require('laravel-mix');
const path = require('path');
const url = 'woetzer-2022.ddev.site';


mix.setResourceRoot(path.normalize(''));
mix.setPublicPath(path.normalize('assets/dist'));

mix.js('assets/src/js/index.js', 'assets/dist/')
    .sass('assets/src/scss/base.scss', 'assets/dist/')
    .copy('node_modules/@splidejs/splide/dist/css/splide.min.css', 'assets/dist/')
    .copyDirectory('assets/images', 'assets/dist/images')
    .sourceMaps(true, 'source-map')
    .browserSync({
        proxy: url,
        host: url,
        port: 3000,
        open: false
    });
