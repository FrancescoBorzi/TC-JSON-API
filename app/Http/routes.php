<?php

/* Creature */

Route::get('/creature/template/{id}', function($id) {
  $results = DB::select("SELECT * FROM creature_template WHERE entry = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/creature/template/{name}/{subname?}', function($name, $subname = null) {

  $name = DB::connection()->getPdo()->quote("%" . $name . "%");

  if ($subname == null)
    $query = sprintf("SELECT * FROM creature_template WHERE name LIKE %s", $name);
  else
  {
    $subname = DB::connection()->getPdo()->quote("%" . $subname . "%");

    $query = sprintf("SELECT * FROM creature_template WHERE name LIKE %s AND subname LIKE %s", $name, $subname);
  }

  $results = DB::select($query);

  return Response::json($results);
});

Route::get('/creature/spawn/id/{id}', function($id) {
  $results = DB::select("SELECT * FROM creature WHERE id = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/creature/spawn/guid/{id}', function($id) {
  $results = DB::select("SELECT * FROM creature WHERE guid = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');


/* Gameobject */

Route::get('/gameobject/template/{id}', function($id) {
  $results = DB::select("SELECT * FROM gameobject_template WHERE entry = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/gameobject/template/{name}', function($name) {

  $name = DB::connection()->getPdo()->quote("%" . $name . "%");

  $query = sprintf("SELECT * FROM gameobject_template WHERE name LIKE %s", $name);

  $results = DB::select($query);

  return Response::json($results);
});

Route::get('/gameobject/spawn/id/{id}', function($id) {
  $results = DB::select("SELECT * FROM gameobject WHERE id = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/gameobject/spawn/guid/{id}', function($id) {
  $results = DB::select("SELECT * FROM gameobject WHERE guid = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');


/* Item */

Route::get('/item/template/{id}', function($id) {
  $results = DB::select("SELECT * FROM item_template WHERE entry = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/item/template/{name}', function($name) {

  $name = DB::connection()->getPdo()->quote("%" . $name . "%");

  $query = sprintf("SELECT * FROM item_template WHERE name LIKE %s", $name);

  $results = DB::select($query);

  return Response::json($results);
});


/* Quest */

Route::get('/quest/template/{id}', function($id) {
  $results = DB::select("SELECT * FROM quest_template WHERE id = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/quest/template/{name}', function($name) {

  $name = DB::connection()->getPdo()->quote("%" . $name . "%");

  $query = sprintf("SELECT * FROM quest_template WHERE title LIKE %s", $name);

  $results = DB::select($query);

  return Response::json($results);
});


/* Loot templates */

Route::get('/loot/creature/{id}', function($id) {
  $results = DB::select('SELECT * FROM creature_loot_template WHERE entry = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/reference/{id}', function($id) {
  $results = DB::select('SELECT * FROM reference_loot_template WHERE entry = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/gameobject/{id}', function($id) {
  $results = DB::select('SELECT * FROM gameobject_loot_template WHERE entry = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/item/{id}', function($id) {
  $results = DB::select('SELECT * FROM item_loot_template WHERE entry = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/fishing/{id}', function($id) {
  $results = DB::select('SELECT * FROM fishing_loot_template WHERE entry = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/disenchant/{id}', function($id) {
  $results = DB::select('SELECT * FROM disenchant_loot_template WHERE entry = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/prospecting/{id}', function($id) {
  $results = DB::select('SELECT * FROM prospecting_loot_template WHERE entry = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/milling/{id}', function($id) {
  $results = DB::select('SELECT * FROM milling_loot_template WHERE entry = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/pickpocketing/{id}', function($id) {
  $results = DB::select('SELECT * FROM pickpocketing_loot_template WHERE entry = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/skinning/{id}', function($id) {
  $results = DB::select('SELECT * FROM skinning_loot_template WHERE entry = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/spell/{id}', function($id) {
  $results = DB::select('SELECT * FROM spell_loot_template WHERE entry = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');


Route::get('/loot/creature/item/{id}', function($id) {
  $results = DB::select('SELECT * FROM creature_loot_template WHERE item = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/reference/item/{id}', function($id) {
  $results = DB::select('SELECT * FROM reference_loot_template WHERE item = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/gameobject/item/{id}', function($id) {
  $results = DB::select('SELECT * FROM gameobject_loot_template WHERE item = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/item/item/{id}', function($id) {
  $results = DB::select('SELECT * FROM item_loot_template WHERE item = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/fishing/item/{id}', function($id) {
  $results = DB::select('SELECT * FROM fishing_loot_template WHERE item = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/disenchant/item/{id}', function($id) {
  $results = DB::select('SELECT * FROM disenchant_loot_template WHERE item = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/prospecting/item/{id}', function($id) {
  $results = DB::select('SELECT * FROM prospecting_loot_template WHERE item = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/milling/item/{id}', function($id) {
  $results = DB::select('SELECT * FROM milling_loot_template WHERE item = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/pickpocketing/item/{id}', function($id) {
  $results = DB::select('SELECT * FROM pickpocketing_loot_template WHERE item = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/skinning/item/{id}', function($id) {
  $results = DB::select('SELECT * FROM skinning_loot_template WHERE item = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/spell/item/{id}', function($id) {
  $results = DB::select('SELECT * FROM spell_loot_template WHERE item = ?', [$id]);

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
