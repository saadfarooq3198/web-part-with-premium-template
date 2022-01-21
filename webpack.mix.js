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

mix.js('resources/js/app.js', 'public/js').postCss('resources/css/app.css', 'public/css', [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
]);


// compiling styles
mix.styles([
    'resources/assets/css/dashlite.css',
    'resources/assets/css/theme.css'
],'public/css/all.css');

// Compiling Javascript
mix.scripts([
    'resources/assets/js/bundle.js',
    'resources/assets/js/scripts.js'
],'public/js/all.js');

// Copying Fonts
mix.copyDirectory('resources/assets/fonts', 'public/fonts');

// Copying Images
mix.copyDirectory('resources/assets/images', 'public/images');