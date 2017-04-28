<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/', function() {
	return view('landing.login_page', ['title' => 'Welcome to SLS Roleplay', 'description' => 'SLS Roleplay is a roleplay community based on Grand Theft Auto 5 by Rockstar Games, where you can establish your own virtual story.', 'keywords' => 'harambe, gta5, love, roleplay, story, character, development, fun, gaming, helpful, great, awesome']);
});

Route::get('/register', function() {
	return view('landing.register_page', ['title' => 'Welcome to SLS Roleplay', 'description' => 'SLS Roleplay is a roleplay community based on Grand Theft Auto 5 by Rockstar Games, where you can establish your own virtual story.', 'keywords' => 'harambe, gta5, love, roleplay, story, character, development, fun, gaming, helpful, great, awesome']);
});
Route::get('/login', function() {
	return view('landing.login_page', ['title' => 'Welcome to SLS Roleplay', 'description' => 'SLS Roleplay is a roleplay community based on Grand Theft Auto 5 by Rockstar Games, where you can establish your own virtual story.', 'keywords' => 'harambe, gta5, love, roleplay, story, character, development, fun, gaming, helpful, great, awesome']);
});