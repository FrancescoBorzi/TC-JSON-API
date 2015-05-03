<?php

/* Creature */

Route::get('/creature/template/{id}', function($id) {
  $results = DB::select("SELECT * FROM creature_template WHERE entry = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/creature/template/{name}/{subname?}', function($name, $subname = null) {

  $query = sprintf("SELECT * FROM creature_template WHERE name LIKE '%%%s%%'", $name);

  $results = DB::select($query);

  return Response::json($results);

});


/* Loot templates */

Route::get('/loot/creature/{id}', function($id) {
  $results = DB::select('SELECT * FROM creature_loot_template where entry = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/reference/{id}', function($id) {
  $results = DB::select('SELECT * FROM reference_loot_template where entry = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/gameobject/{id}', function($id) {
  $results = DB::select('SELECT * FROM gameobject_loot_template where entry = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/item/{id}', function($id) {
  $results = DB::select('SELECT * FROM item_loot_template where entry = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/fishing/{id}', function($id) {
  $results = DB::select('SELECT * FROM fishing_loot_template where entry = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/disenchant/{id}', function($id) {
  $results = DB::select('SELECT * FROM disenchant_loot_template where entry = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/prospecting/{id}', function($id) {
  $results = DB::select('SELECT * FROM prospecting_loot_template where entry = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/milling/{id}', function($id) {
  $results = DB::select('SELECT * FROM milling_loot_template where entry = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/pickpocketing/{id}', function($id) {
  $results = DB::select('SELECT * FROM pickpocketing_loot_template where entry = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/skinning/{id}', function($id) {
  $results = DB::select('SELECT * FROM skinning_loot_template where entry = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/spell/{id}', function($id) {
  $results = DB::select('SELECT * FROM spell_loot_template where entry = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');


/* Other */

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
  'auth' => 'Auth\AuthController',
  'password' => 'Auth\PasswordController',
]);
