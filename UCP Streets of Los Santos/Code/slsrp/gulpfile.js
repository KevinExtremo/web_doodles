var elixir = require('laravel-elixir');

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
elixir(function(mix) 
{
	   mix.sass('resources/assets/sass/landing.scss', 'public/css/landing.css');
	   mix.sass('resources/assets/sass/cp-layout.scss','public/css/cp-layout.css');
});
