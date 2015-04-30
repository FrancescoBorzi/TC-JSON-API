<?php

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

Route::get('/creature/loot/{id}', function($id) {
  $results = DB::select('SELECT * FROM creature_loot_template where entry = ?', [$id]);

  return Response::json($results);
});

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
  'auth' => 'Auth\AuthController',
  'password' => 'Auth\PasswordController',
]);
