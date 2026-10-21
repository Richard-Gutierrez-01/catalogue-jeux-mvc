<?php
use App\Routes\Route;

// Table de routage de l'application Catalogue de jeux vidéo

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

// Jeu - CRUD complet
Route::get('/jeu', 'JeuController@index');
Route::get('/jeu/show', 'JeuController@show');
Route::get('/jeu/create', 'JeuController@create');
Route::post('/jeu/create', 'JeuController@store');
Route::get('/jeu/edit', 'JeuController@edit');
Route::post('/jeu/edit', 'JeuController@update');
Route::post('/jeu/delete', 'JeuController@delete');

// Developpeur - CRUD complet
Route::get('/developpeur', 'DeveloppeurController@index');
Route::get('/developpeur/show', 'DeveloppeurController@show');
Route::get('/developpeur/create', 'DeveloppeurController@create');
Route::post('/developpeur/create', 'DeveloppeurController@store');
Route::get('/developpeur/edit', 'DeveloppeurController@edit');
Route::post('/developpeur/edit', 'DeveloppeurController@update');
Route::post('/developpeur/delete', 'DeveloppeurController@delete');

// Plateforme - CRUD complet
Route::get('/plateforme', 'PlateformeController@index');
Route::get('/plateforme/show', 'PlateformeController@show');
Route::get('/plateforme/create', 'PlateformeController@create');
Route::post('/plateforme/create', 'PlateformeController@store');
Route::get('/plateforme/edit', 'PlateformeController@edit');
Route::post('/plateforme/edit', 'PlateformeController@update');
Route::post('/plateforme/delete', 'PlateformeController@delete');

Route::dispatch();
