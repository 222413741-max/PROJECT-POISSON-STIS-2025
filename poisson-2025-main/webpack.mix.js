const mix = require("laravel-mix");

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

mix
  .js("resources/js/app.js", "public/js")
  .js("resources/js/init.js", "public/js")
  .js("resources/js/uploadHandling.js", "public/js")
  .js("resources/js/notification.js", "public/js")
  .js("resources/js/timerHandling.js", "public/js")
  .js("resources/js/timer.js", "public/js")
  .react()
  //   .babelConfig({
  //     presets: ["@babel/preset-env", "@babel/preset-react"],
  //   })
  .postCss("resources/css/app.css", "public/css", [require("postcss-import"), require("tailwindcss")])
  .postCss('resources/css/photobooth.css', 'public/css')
  .js('resources/js/photobooth.js', 'public/js');

if (mix.inProduction()) {
  mix.version();
}
