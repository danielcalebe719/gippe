const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .js('node_modules/lightbox2/dist/js/lightbox.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .styles('node_modules/lightbox2/dist/css/lightbox.css', 'public/css/lightbox.css')
   .options({
       processCssUrls: false
   });

if (mix.inProduction()) {
    mix.version();
} else {
    mix.sourceMaps();
}
