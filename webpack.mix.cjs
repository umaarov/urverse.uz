const mix = require ('laravel-mix');

mix
  .js ('resources/js/app.js', 'public/js')
  .js ('resources/js/articles.js', 'public/js')
  .sass ('resources/sass/articles.scss', 'public/css')
  .options ({
    processCssUrls: false,
  })
  .version ();
