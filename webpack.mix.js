let mix = require('laravel-mix');

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

mix.copyDirectory('node_modules/simditor/styles','resources/assets/sass/simditor')
    .copy('node_modules/simple-module/lib/module.js','resources/assets/js/simditor/module.js')
    .copy('node_modules/simple-hotkeys/lib/hotkeys.js','resources/assets/js/simditor/hotkeys.js')
    .copy('node_modules/simple-uploader/lib/uploader.js','resources/assets/js/simditor/uploader.js')
    .copy('node_modules/simditor/lib/simditor.js','resources/assets/js/simditor/simditor.js')
    .scripts(
        [
            'resources/assets/js/simditor/module.js',
            'resources/assets/js/simditor/hotkeys.js',
            'resources/assets/js/simditor/uploader.js',
            'resources/assets/js/simditor/simditor.js'
        ],
        'public/js/editor.js')
    .js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .sass('resources/assets/sass/simditor/simditor.scss', 'public/css');
