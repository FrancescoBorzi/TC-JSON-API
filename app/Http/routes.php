<?php

/* DBC */

Route::get('/dbc/achievements/{id}', function($id) {

  if (isset($_GET['version']) && $_GET['version'] == 6)
    $results = DB::connection('sqlite')->select("SELECT * FROM achievements_wod WHERE id = ?", [$id]);
  else
    $results = DB::connection('sqlite')->select("SELECT * FROM achievements_wotlk WHERE id = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/dbc/areas_and_zones/{id}', function($id) {

  if (isset($_GET['version']) && $_GET['version'] == 6)
    $results = DB::connection('sqlite')->select("SELECT * FROM areas_and_zones_wod WHERE m_ID = ?", [$id]);
  else
    $results = DB::connection('sqlite')->select("SELECT * FROM areas_and_zones_wotlk WHERE m_ID = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/dbc/areatriggers/{id}', function($id) {

  if (isset($_GET['version']) && $_GET['version'] == 6)
    $results = DB::connection('sqlite')->select("SELECT * FROM areatriggers_wod WHERE m_id = ?", [$id]);
  else
    $results = DB::connection('sqlite')->select("SELECT * FROM areatriggers_wotlk WHERE m_id = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/dbc/emotes/{id}', function($id) {

  if (isset($_GET['version']) && $_GET['version'] == 6)
    $results = DB::connection('sqlite')->select("SELECT * FROM emotes_wod WHERE id = ?", [$id]);
  else
    $results = DB::connection('sqlite')->select("SELECT * FROM emotes_wotlk WHERE id = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/dbc/factions/{id}', function($id) {

  if (isset($_GET['version']) && $_GET['version'] == 6)
    $results = DB::connection('sqlite')->select("SELECT * FROM factions_wod WHERE m_ID = ?", [$id]);
  else
    $results = DB::connection('sqlite')->select("SELECT * FROM factions_wotlk WHERE m_ID = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/dbc/languages/{id}', function($id) {

  if (isset($_GET['version']) && $_GET['version'] == 6)
    $results = DB::connection('sqlite')->select("SELECT * FROM languages_wod WHERE id = ?", [$id]);
  else
    $results = DB::connection('sqlite')->select("SELECT * FROM languages_wotlk WHERE id = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/dbc/maps_wotlk/{id}', function($id) {

  if (isset($_GET['version']) && $_GET['version'] == 6)
    // TODO add maps_wod
    $results = DB::connection('sqlite')->select("SELECT * FROM maps_wotlk WHERE m_ID = ?", [$id]);
  else
    $results = DB::connection('sqlite')->select("SELECT * FROM maps_wotlk WHERE m_ID = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/dbc/player_titles/{id}', function($id) {

  if (isset($_GET['version']) && $_GET['version'] == 6)
    $results = DB::connection('sqlite')->select("SELECT * FROM player_titles_wod WHERE id = ?", [$id]);
  else
    $results = DB::connection('sqlite')->select("SELECT * FROM player_titles_wotlk WHERE id = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/dbc/skills/{id}', function($id) {

  if (isset($_GET['version']) && $_GET['version'] == 6)
    $results = DB::connection('sqlite')->select("SELECT * FROM skills_wod WHERE id = ?", [$id]);
  else
    $results = DB::connection('sqlite')->select("SELECT * FROM skills_wotlk WHERE id = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/dbc/sound_entries/{id}', function($id) {

  if (isset($_GET['version']) && $_GET['version'] == 6)
    // TODO add sound_entries_wod
    $results = DB::connection('sqlite')->select("SELECT * FROM sound_entries_wotlk WHERE id = ?", [$id]);
  else
    $results = DB::connection('sqlite')->select("SELECT * FROM sound_entries_wotlk WHERE id = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/dbc/spells/{id}', function($id) {

  if (isset($_GET['version']) && $_GET['version'] == 6)
    // TODO add spells_wod
    $results = DB::connection('sqlite')->select("SELECT * FROM spells_wotlk WHERE ID = ?", [$id]);
  else
    $results = DB::connection('sqlite')->select("SELECT * FROM spells_wotlk WHERE ID = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/dbc/taxi_nodes/{id}', function($id) {

  if (isset($_GET['version']) && $_GET['version'] == 6)
    $results = DB::connection('sqlite')->select("SELECT * FROM taxi_nodes_wod WHERE id = ?", [$id]);
  else
    $results = DB::connection('sqlite')->select("SELECT * FROM taxi_nodes_wotlk WHERE id = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');


/* Search with multiple optional parameters */

Route::get('/search/creature', function() {

  if ( !isset($_GET['id']) && !isset($_GET['name']) && !isset($_GET['subname']) )
    return Response::json(array("error" => "please insert at least one parameter"));

  $query = DB::connection('world')->table('creature_template')->select('entry', 'name', 'subname');

  if (isset($_GET['id']) && $_GET['id'] != "")
    $query->where('entry', 'LIKE', '%'. $_GET['id'] .'%');

  if (isset($_GET['name']) && $_GET['name'] != "")
    $query->where('name', 'LIKE', '%'. $_GET['name'] .'%');

  if (isset($_GET['subname']) && $_GET['subname'] != "")
    $query->where('subname', 'LIKE', '%'. $_GET['subname'] .'%');

  $results = $query->orderBy('entry')->get();

  return Response::json($results);
});

Route::get('/search/quest', function() {

  if ( !isset($_GET['id']) && !isset($_GET['name']) )
    return Response::json(array("error" => "please insert at least one parameter"));

  $query = DB::connection('world')->table('quest_template')->select('ID', 'LogTitle', 'QuestDescription');

  if (isset($_GET['id']) && $_GET['id'] != "")
    $query->where('ID', 'LIKE', '%'. $_GET['id'] .'%');

  if (isset($_GET['name']) && $_GET['name'] != "")
    $query->where('LogTitle', 'LIKE', '%'. $_GET['name'] .'%');

  $results = $query->orderBy('ID')->get();

  return Response::json($results);
});

Route::get('/search/item', function() {

  if ( !isset($_GET['id']) && !isset($_GET['name']) )
    return Response::json(array("error" => "please insert at least one parameter"));

  $query = DB::connection('world')->table('item_template')->select('entry', 'name');

  if (isset($_GET['id']) && $_GET['id'] != "")
    $query->where('entry', 'LIKE', '%'. $_GET['id'] .'%');

  if (isset($_GET['name']) && $_GET['name'] != "")
    $query->where('name', 'LIKE', '%'. $_GET['name'] .'%');

  $results = $query->orderBy('entry')->get();

  return Response::json($results);
});

Route::get('/search/gameobject', function() {

  if ( !isset($_GET['id']) && !isset($_GET['name']) )
    return Response::json(array("error" => "please insert at least one parameter"));

  $query = DB::connection('world')->table('gameobject_template')->select('entry', 'name');

  if (isset($_GET['id']) && $_GET['id'] != "")
    $query->where('entry', 'LIKE', '%'. $_GET['id'] .'%');

  if (isset($_GET['name']) && $_GET['name'] != "")
    $query->where('name', 'LIKE', '%'. $_GET['name'] .'%');

  $results = $query->orderBy('entry')->get();

  return Response::json($results);
});

Route::get('/search/character', function() {

  if ( !isset($_GET['guid']) && !isset($_GET['account']) && !isset($_GET['name']) )
    return Response::json(array("error" => "please insert at least one parameter"));

  $query = DB::connection('characters')->table('characters')->select('guid', 'account', 'name');

  if (isset($_GET['guid']) && $_GET['guid'] != "")
    $query->where('guid', 'LIKE', '%'. $_GET['guid'] .'%');

  if (isset($_GET['account']) && $_GET['account'] != "")
    $query->where('account', 'LIKE', '%'. $_GET['account'] .'%');

  if (isset($_GET['name']) && $_GET['name'] != "")
    $query->where('name', 'LIKE', '%'. $_GET['name'] .'%');

  $results = $query->orderBy('guid')->get();

  return Response::json($results);
});

Route::get('/search/smart_scripts', function() {

  if (
    !isset($_GET['entryorguid']) &&
    !isset($_GET['source_type'])
  ) {
    return Response::json(array("error" => "please insert at least one parameter"));
  }

  $query = DB::connection('world')->table('smart_scripts')->select('entryorguid', 'source_type');

  if (isset($_GET['entryorguid']) && $_GET['entryorguid'] != "")
    $query->where('entryorguid', 'LIKE', '%'. $_GET['entryorguid'] .'%');

  if (isset($_GET['source_type']) && $_GET['source_type'] != "")
    $query->where('source_type', 'LIKE', '%'. $_GET['source_type'] .'%');

  if (isset($_GET['comment']) && $_GET['comment'] != "")
    $query->where('comment', 'LIKE', '%'. $_GET['comment'] .'%');

  $results = $query->orderBy('entryorguid')->groupBy('entryorguid', 'source_type')->get();

  return Response::json($results);
});


Route::get('/search/dbc/achievements', function() {

  if ( !isset($_GET['id']) && !isset($_GET['name']) )
    return Response::json(array("error" => "please insert at least one parameter"));

  if (isset($_GET['version']) && $_GET['version'] == 6)
    $query = DB::connection('sqlite')->table('achievements_wod')->select('id', 'name');
  else
    $query = DB::connection('sqlite')->table('achievements_wotlk')->select('id', 'name');

  if (isset($_GET['id']) && $_GET['id'] != "")
    $query->where('id', 'LIKE', '%'. $_GET['id'] .'%');

  if (isset($_GET['name']) && $_GET['name'] != "")
    $query->where('name', 'LIKE', '%'. $_GET['name'] .'%');

  $results = $query->orderBy('id')->get();

  return Response::json($results);
});

Route::get('/search/dbc/emotes', function() {

  if ( !isset($_GET['id']) && !isset($_GET['name']) )
    return Response::json(array("error" => "please insert at least one parameter"));

  if (isset($_GET['version']) && $_GET['version'] == 6)
    $query = DB::connection('sqlite')->table('emotes_wod')->select('id', 'emote');
  else
    $query = DB::connection('sqlite')->table('emotes_wotlk')->select('id', 'emote');

  if (isset($_GET['id']) && $_GET['id'] != "")
    $query->where('id', 'LIKE', '%'. $_GET['id'] .'%');

  if (isset($_GET['name']) && $_GET['name'] != "")
    $query->where('emote', 'LIKE', '%'. $_GET['name'] .'%');

  $results = $query->orderBy('id')->get();

  return Response::json($results);
});

Route::get('/search/dbc/factions', function() {

  if ( !isset($_GET['id']) && !isset($_GET['name']) )
    return Response::json(array("error" => "please insert at least one parameter"));

  if (isset($_GET['version']) && $_GET['version'] == 6)
    $query = DB::connection('sqlite')->table('factions_wod')->select('m_ID', 'm_name_lang_1');
  else
    $query = DB::connection('sqlite')->table('factions_wotlk')->select('m_ID', 'm_name_lang_1');

  if (isset($_GET['id']) && $_GET['id'] != "")
    $query->where('m_ID', 'LIKE', '%'. $_GET['id'] .'%');

  if (isset($_GET['name']) && $_GET['name'] != "")
    $query->where('m_name_lang_1', 'LIKE', '%'. $_GET['name'] .'%');

  $results = $query->orderBy('m_ID')->get();

  return Response::json($results);
});

Route::get('/search/dbc/languages', function() {

  if ( !isset($_GET['id']) && !isset($_GET['name']) )
    return Response::json(array("error" => "please insert at least one parameter"));

  if (isset($_GET['version']) && $_GET['version'] == 6)
    $query = DB::connection('sqlite')->table('languages_wod')->select('id', 'name');
  else
    $query = DB::connection('sqlite')->table('languages_wotlk')->select('id', 'name');

  if (isset($_GET['id']) && $_GET['id'] != "")
    $query->where('id', 'LIKE', '%'. $_GET['id'] .'%');

  if (isset($_GET['name']) && $_GET['name'] != "")
    $query->where('name', 'LIKE', '%'. $_GET['name'] .'%');

  $results = $query->orderBy('id')->get();

  return Response::json($results);
});

Route::get('/search/dbc/player_titles', function() {

  if ( !isset($_GET['id']) && !isset($_GET['title']) )
    return Response::json(array("error" => "please insert at least one parameter"));

  if (isset($_GET['version']) && $_GET['version'] == 6)
    $query = DB::connection('sqlite')->table('player_titles_wod')->select('id', 'title');
  else
    $query = DB::connection('sqlite')->table('player_titles_wotlk')->select('id', 'title');

  if (isset($_GET['id']) && $_GET['id'] != "")
    $query->where('id', 'LIKE', '%'. $_GET['id'] .'%');

  if (isset($_GET['title']) && $_GET['title'] != "")
    $query->where('title', 'LIKE', '%'. $_GET['title'] .'%');

  $results = $query->orderBy('id')->get();

  return Response::json($results);
});

Route::get('/search/dbc/sound_entries', function() {

  if ( !isset($_GET['id']) && !isset($_GET['name']) )
    return Response::json(array("error" => "please insert at least one parameter"));

  // TODO add sound_entries_wod
  $query = DB::connection('sqlite')->table('sound_entries_wotlk')->select('id', 'name');

  if (isset($_GET['id']) && $_GET['id'] != "")
    $query->where('id', 'LIKE', '%'. $_GET['id'] .'%');

  if (isset($_GET['name']) && $_GET['name'] != "")
    $query->where('name', 'LIKE', '%'. $_GET['name'] .'%');

  $results = $query->orderBy('id')->get();

  return Response::json($results);
});

Route::get('/search/dbc/taxi_nodes', function() {

  if ( !isset($_GET['id']) && !isset($_GET['name']) )
    return Response::json(array("error" => "please insert at least one parameter"));

  if (isset($_GET['version']) && $_GET['version'] == 6)
    $query = DB::connection('sqlite')->table('taxi_nodes_wod')->select('id', 'taxiName');
  else
    $query = DB::connection('sqlite')->table('taxi_nodes_wotlk')->select('id', 'taxiName');

  if (isset($_GET['id']) && $_GET['id'] != "")
    $query->where('id', 'LIKE', '%'. $_GET['id'] .'%');

  if (isset($_GET['name']) && $_GET['name'] != "")
    $query->where('taxiName', 'LIKE', '%'. $_GET['name'] .'%');

  $results = $query->orderBy('id')->get();

  return Response::json($results);
});

Route::get('/search/dbc/maps_wotlk', function() {

  if ( !isset($_GET['id']) && !isset($_GET['name']) )
    return Response::json(array("error" => "please insert at least one parameter"));

  // TODO add maps_wod
  $query = DB::connection('sqlite')->table('maps_wotlk')->select('m_ID', 'm_MapName_lang1');

  if (isset($_GET['id']) && $_GET['id'] != "")
    $query->where('m_ID', 'LIKE', '%'. $_GET['id'] .'%');

  if (isset($_GET['name']) && $_GET['name'] != "")
    $query->where('m_MapName_lang1', 'LIKE', '%'. $_GET['name'] .'%');

  $results = $query->orderBy('m_ID')->get();

  return Response::json($results);
});

Route::get('/search/dbc/skills_wotlk', function() {

  if ( !isset($_GET['id']) && !isset($_GET['name']) )
    return Response::json(array("error" => "please insert at least one parameter"));

  if (isset($_GET['version']) && $_GET['version'] == 6)
    $query = DB::connection('sqlite')->table('skills_wod')->select('id', 'name');
  else
    $query = DB::connection('sqlite')->table('skills_wotlk')->select('id', 'name');

  if (isset($_GET['id']) && $_GET['id'] != "")
    $query->where('id', 'LIKE', '%'. $_GET['id'] .'%');

  if (isset($_GET['name']) && $_GET['name'] != "")
    $query->where('name', 'LIKE', '%'. $_GET['name'] .'%');

  $results = $query->orderBy('id')->get();

  return Response::json($results);
});

Route::get('/search/dbc/spells', function() {

  if ( !isset($_GET['id']) && !isset($_GET['name']) )
    return Response::json(array("error" => "please insert at least one parameter"));

  // TODO add spells_wod
  $query = DB::connection('sqlite')->table('spells_wotlk')->select('ID', 'spellName');

  if (isset($_GET['id']) && $_GET['id'] != "")
    $query->where('ID', 'LIKE', '%'. $_GET['id'] .'%');

  if (isset($_GET['name']) && $_GET['name'] != "")
    $query->where('spellName', 'LIKE', '%'. $_GET['name'] .'%');

  $results = $query->orderBy('ID')->get();

  return Response::json($results);
});

Route::get('/search/dbc/areas_and_zones_wotlk', function() {

  if ( !isset($_GET['id']) && !isset($_GET['name']) )
    return Response::json(array("error" => "please insert at least one parameter"));

  if (isset($_GET['version']) && $_GET['version'] == 6)
    $query = DB::connection('sqlite')->table('areas_and_zones_wod')->select('m_ID', 'm_AreaName_lang');
  else
    $query = DB::connection('sqlite')->table('areas_and_zones_wotlk')->select('m_ID', 'm_AreaName_lang');

  if (isset($_GET['id']) && $_GET['id'] != "")
    $query->where('m_ID', 'LIKE', '%'. $_GET['id'] .'%');

  if (isset($_GET['name']) && $_GET['name'] != "")
    $query->where('m_AreaName_lang', 'LIKE', '%'. $_GET['name'] .'%');

  $results = $query->orderBy('m_ID')->get();

  return Response::json($results);
});


/* Smart AI */

Route::get('/smart_scripts/{source_type}/{entryorguid}', function($source_type, $entryorguid) {
  $results = DB::connection('world')->select("SELECT * FROM smart_scripts WHERE source_type = ? AND entryorguid = ?", [$source_type, $entryorguid]);

  return Response::json($results);
})
  ->where('source_type', '[0-9]+')->where('entryorguid', '[\-]{0,1}[0-9]+');


/* Creatures */

Route::get('/creature/template/{id}', function($id) {
  $results = DB::connection('world')->select("SELECT * FROM creature_template WHERE entry = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/creature/template/name/{id}', function($id) {
  $results = DB::connection('world')->select("SELECT entry, name FROM creature_template WHERE entry = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/creature/template/{name}/{subname?}', function($name, $subname = null) {
  if (strlen($name) < 4) return json_encode(array("error" => "min search length 4 characters"));

  $name = DB::connection()->getPdo()->quote("%" . $name . "%");

  if ($subname == null)
    $query = sprintf("SELECT * FROM creature_template WHERE name LIKE %s", $name);
  else
  {
    if (strlen($subname) < 4) return json_encode(array("error" => "min search length 4 characters"));

    $subname = DB::connection()->getPdo()->quote("%" . $subname . "%");

    $query = sprintf("SELECT * FROM creature_template WHERE name LIKE %s AND subname LIKE %s", $name, $subname);
  }

  $results = DB::connection('world')->select($query);

  return Response::json($results);
});

Route::get('/creature/equip_template/{id}', function($id) {
  $results = DB::connection('world')->select("SELECT * FROM creature_equip_template WHERE CreatureID = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/creature/template/name/{id}', function($id) {
  $results = DB::connection('world')->select("SELECT entry, name FROM creature_template WHERE entry = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/creature/template_addon/{id}', function($id) {
  $results = DB::connection('world')->select("SELECT * FROM creature_template_addon WHERE entry = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/creature/onkill_reputation/{id}', function($id) {
  $results = DB::connection('world')->select("SELECT * FROM creature_onkill_reputation WHERE creature_id = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/creature/spawn/id/{id}', function($id) {
  $results = DB::connection('world')->select("SELECT * FROM creature WHERE id = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/creature/spawn/guid/{guid}', function($guid) {
  $results = DB::connection('world')->select("SELECT * FROM creature WHERE guid = ?", [$guid]);

  return Response::json($results);
})
  ->where('guid', '[0-9]+');

Route::get('/creature/spawn/addon/id/{id}', function($id) {
  $results = DB::connection('world')->select("SELECT t2.guid, t2.path_id, t2.mount, t2.bytes1, t2.bytes2, t2.emote, t2.auras FROM creature AS t1 RIGHT JOIN creature_addon AS t2 ON t1.guid = t2.guid WHERE t1.id = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/creature/spawn/addon/guid/{guid}', function($guid) {
  $results = DB::connection('world')->select("SELECT * FROM creature_addon WHERE guid = ?", [$guid]);

  return Response::json($results);
})
  ->where('guid', '[0-9]+');

Route::get('/creature/queststarter/id/{id}', function($id) {

  if  (isset($_GET['names']) && $_GET['names'] == 0)
    $results = DB::connection('world')->select("SELECT * FROM creature_queststarter WHERE id = ?", [$id]);
  else
    $results = DB::connection('world')->select("SELECT t1.id, t1.quest, t2.LogTitle FROM creature_queststarter AS t1 LEFT JOIN quest_template AS t2 ON t1.quest = t2.ID WHERE t1.id = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/creature/queststarter/quest/{id}', function($id) {

  if  (isset($_GET['names']) && $_GET['names'] == 0)
    $results = DB::connection('world')->select("SELECT * FROM creature_queststarter WHERE quest = ?", [$id]);
  else
    $results = DB::connection('world')->select("SELECT t1.id, t2.name, t1.quest FROM creature_queststarter AS t1 LEFT JOIN creature_template AS t2 ON t1.id = t2.entry WHERE t1.quest = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/creature/questender/id/{id}', function($id) {

  if  (isset($_GET['names']) && $_GET['names'] == 0)
    $results = DB::connection('world')->select("SELECT * FROM creature_questender WHERE id = ?", [$id]);
  else
    $results = DB::connection('world')->select("SELECT t1.id, t1.quest, t2.LogTitle FROM creature_questender AS t1 LEFT JOIN quest_template AS t2 ON t1.quest = t2.ID WHERE t1.id = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/creature/questender/quest/{id}', function($id) {

  if  (isset($_GET['names']) && $_GET['names'] == 0)
    $results = DB::connection('world')->select("SELECT * FROM creature_questender WHERE quest = ?", [$id]);
  else
    $results = DB::connection('world')->select("SELECT t1.id, t2.name, t1.quest FROM creature_questender AS t1 LEFT JOIN creature_template AS t2 ON t1.id = t2.entry WHERE t1.quest = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');


/* Gameobjects */

Route::get('/gameobject/template/{id}', function($id) {
  $results = DB::connection('world')->select("SELECT * FROM gameobject_template WHERE entry = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/gameobject/template/name/{id}', function($id) {
  $results = DB::connection('world')->select("SELECT entry, name FROM gameobject_template WHERE entry = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/gameobject/template/{name}', function($name) {

  if (strlen($name) < 4) return json_encode(array("error" => "min search length 4 characters"));

  $name = DB::connection()->getPdo()->quote("%" . $name . "%");

  $query = sprintf("SELECT * FROM gameobject_template WHERE name LIKE %s", $name);

  $results = DB::connection('world')->select($query);

  return Response::json($results);
});

Route::get('/gameobject/spawn/id/{id}', function($id) {
  $results = DB::connection('world')->select("SELECT * FROM gameobject WHERE id = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/gameobject/spawn/guid/{guid}', function($guid) {
  $results = DB::connection('world')->select("SELECT * FROM gameobject WHERE guid = ?", [$guid]);

  return Response::json($results);
})
  ->where('guid', '[0-9]+');

Route::get('/gameobject/queststarter/id/{id}', function($id) {

  if  (isset($_GET['names']) && $_GET['names'] == 0)
    $results = DB::connection('world')->select("SELECT * FROM gameobject_queststarter WHERE id = ?", [$id]);
  else
    $results = DB::connection('world')->select("SELECT t1.id, t1.quest, t2.LogTitle FROM gameobject_queststarter AS t1 LEFT JOIN quest_template AS t2 ON t1.quest = t2.ID WHERE t1.id = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/gameobject/queststarter/quest/{id}', function($id) {

  if  (isset($_GET['names']) && $_GET['names'] == 0)
    $results = DB::connection('world')->select("SELECT * FROM gameobject_queststarter WHERE quest = ?", [$id]);
  else
    $results = DB::connection('world')->select("SELECT t1.id, t2.name, t1.quest FROM gameobject_queststarter AS t1 LEFT JOIN gameobject_template AS t2 ON t1.id = t2.entry WHERE t1.quest = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/gameobject/questender/id/{id}', function($id) {

  if  (isset($_GET['names']) && $_GET['names'] == 0)
    $results = DB::connection('world')->select("SELECT * FROM gameobject_questender WHERE id = ?", [$id]);
  else
    $results = DB::connection('world')->select("SELECT t1.id, t1.quest, t2.LogTitle FROM gameobject_questender AS t1 LEFT JOIN quest_template AS t2 ON t1.quest = t2.ID WHERE t1.id = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/gameobject/questender/quest/{id}', function($id) {

  if  (isset($_GET['names']) && $_GET['names'] == 0)
    $results = DB::connection('world')->select("SELECT * FROM gameobject_questender WHERE quest = ?", [$id]);
  else
    $results = DB::connection('world')->select("SELECT t1.id, t2.name, t1.quest FROM gameobject_questender AS t1 LEFT JOIN gameobject_template AS t2 ON t1.id = t2.entry WHERE t1.quest = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');


/* Items */

Route::get('/item/template/{id}', function($id) {
  $results = DB::connection('world')->select("SELECT * FROM item_template WHERE entry = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/item/template/name/{id}', function($id) {
  $results = DB::connection('world')->select("SELECT entry, name FROM item_template WHERE entry = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/item/template/{name}', function($name) {

  if (strlen($name) < 4) return json_encode(array("error" => "min search length 4 characters"));

  $name = DB::connection()->getPdo()->quote("%" . $name . "%");

  $query = sprintf("SELECT * FROM item_template WHERE name LIKE %s", $name);

  $results = DB::connection('world')->select($query);

  return Response::json($results);

});

Route::get('/item/enchantment/{id}', function($id) {
  $results = DB::connection('world')->select("SELECT * FROM item_enchantment_template WHERE entry = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');


/* Quests */

Route::get('/quest/template/{id}', function($id) {
  $results = DB::connection('world')->select("SELECT * FROM quest_template WHERE ID = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/quest/template/title/{id}', function($id) {
  $results = DB::connection('world')->select("SELECT ID, LogTitle FROM quest_template WHERE ID = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/quest/template/{name}', function($name) {

  if (strlen($name) < 4) return json_encode(array("error" => "min search length 4 characters"));

  $name = DB::connection()->getPdo()->quote("%" . $name . "%");

  $query = sprintf("SELECT * FROM quest_template WHERE LogTitle LIKE %s", $name);

  $results = DB::connection('world')->select($query);

  return Response::json($results);
});


/* Vendors */

Route::get('/vendor/creature/{id}', function($id) {
  $results = DB::connection('world')->select("SELECT t1.entry, t1.slot, t1.item, t2.name, t1.maxcount, t1.incrtime, t1.ExtendedCost, t1.VerifiedBuild FROM npc_vendor AS t1 LEFT JOIN item_template AS t2 ON t1.item =  t2.entry WHERE t1.entry = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/vendor/item/{id}', function($id) {
  $results = DB::connection('world')->select("SELECT t1.entry, t2.name, t1.slot, t1.item, t1.maxcount, t1.incrtime, t1.ExtendedCost, t1.VerifiedBuild FROM npc_vendor AS t1 LEFT JOIN creature_template AS t2 ON t1.entry =  t2.entry WHERE t1.item = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/npc_vendor/creature/{id}', function($id) {
  $results = DB::connection('world')->select("SELECT * FROM npc_vendor WHERE entry = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/npc_vendor/item/{id}', function($id) {
  $results = DB::connection('world')->select("SELECT * FROM npc_vendor WHERE item = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');


/* Trainer */

Route::get('/npc_trainer/creature/{id}', function($id) {
  $results = DB::connection('world')->select("SELECT * FROM npc_trainer WHERE ID = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/npc_trainer/spell/{id}', function($id) {
  $results = DB::connection('world')->select("SELECT * FROM npc_trainer WHERE SpellID = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9\-]+');

/* Loot templates */

Route::get('/loot/creature/{id}', function($id) {
  $results = DB::connection('world')->select('SELECT t1.Entry, t1.Item, t2.name, t1.Reference, t1.Chance, t1.QuestRequired, t1.LootMode, t1.GroupId, t1.MinCount, t1.MaxCount FROM creature_loot_template as t1 LEFT JOIN item_template AS t2 ON t1.item = t2.entry WHERE t1.entry = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/reference/{id}', function($id) {
  $results = DB::connection('world')->select('SELECT t1.Entry, t1.Item, t2.name, t1.Reference, t1.Chance, t1.QuestRequired, t1.LootMode, t1.GroupId, t1.MinCount, t1.MaxCount FROM reference_loot_template as t1 LEFT JOIN item_template AS t2 ON t1.item = t2.entry WHERE t1.entry = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/gameobject/{id}', function($id) {
  $results = DB::connection('world')->select('SELECT t1.Entry, t1.Item, t2.name, t1.Reference, t1.Chance, t1.QuestRequired, t1.LootMode, t1.GroupId, t1.MinCount, t1.MaxCount FROM gameobject_loot_template as t1 LEFT JOIN item_template AS t2 ON t1.item = t2.entry WHERE t1.entry = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/item/{id}', function($id) {
  $results = DB::connection('world')->select('SELECT t1.Entry, t1.Item, t2.name, t1.Reference, t1.Chance, t1.QuestRequired, t1.LootMode, t1.GroupId, t1.MinCount, t1.MaxCount FROM item_loot_template as t1 LEFT JOIN item_template AS t2 ON t1.item = t2.entry WHERE t1.entry = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/fishing/{id}', function($id) {
  $results = DB::connection('world')->select('SELECT t1.Entry, t1.Item, t2.name, t1.Reference, t1.Chance, t1.QuestRequired, t1.LootMode, t1.GroupId, t1.MinCount, t1.MaxCount FROM fishing_loot_template as t1 LEFT JOIN item_template AS t2 ON t1.item = t2.entry WHERE t1.entry = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/disenchant/{id}', function($id) {
  $results = DB::connection('world')->select('SELECT t1.Entry, t1.Item, t2.name, t1.Reference, t1.Chance, t1.QuestRequired, t1.LootMode, t1.GroupId, t1.MinCount, t1.MaxCount FROM disenchant_loot_template as t1 LEFT JOIN item_template AS t2 ON t1.item = t2.entry WHERE t1.entry = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/prospecting/{id}', function($id) {
  $results = DB::connection('world')->select('SELECT t1.Entry, t1.Item, t2.name, t1.Reference, t1.Chance, t1.QuestRequired, t1.LootMode, t1.GroupId, t1.MinCount, t1.MaxCount FROM prospecting_loot_template as t1 LEFT JOIN item_template AS t2 ON t1.item = t2.entry WHERE t1.entry = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/milling/{id}', function($id) {
  $results = DB::connection('world')->select('SELECT t1.Entry, t1.Item, t2.name, t1.Reference, t1.Chance, t1.QuestRequired, t1.LootMode, t1.GroupId, t1.MinCount, t1.MaxCount FROM milling_loot_template as t1 LEFT JOIN item_template AS t2 ON t1.item = t2.entry WHERE t1.entry = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/pickpocketing/{id}', function($id) {
  $results = DB::connection('world')->select('SELECT t1.Entry, t1.Item, t2.name, t1.Reference, t1.Chance, t1.QuestRequired, t1.LootMode, t1.GroupId, t1.MinCount, t1.MaxCount FROM pickpocketing_loot_template as t1 LEFT JOIN item_template AS t2 ON t1.item = t2.entry WHERE t1.entry = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/skinning/{id}', function($id) {
  $results = DB::connection('world')->select('SELECT t1.Entry, t1.Item, t2.name, t1.Reference, t1.Chance, t1.QuestRequired, t1.LootMode, t1.GroupId, t1.MinCount, t1.MaxCount FROM skinning_loot_template as t1 LEFT JOIN item_template AS t2 ON t1.item = t2.entry WHERE t1.entry = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/spell/{id}', function($id) {
  $results = DB::connection('world')->select('SELECT t1.Entry, t1.Item, t2.name, t1.Reference, t1.Chance, t1.QuestRequired, t1.LootMode, t1.GroupId, t1.MinCount, t1.MaxCount FROM spell_loot_template as t1 LEFT JOIN item_template AS t2 ON t1.item = t2.entry WHERE t1.entry = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');


Route::get('/loot/creature/item/{id}', function($id) {
  $results = DB::connection('world')->select('SELECT t1.Entry, t2.name, t1.Reference, t1.Chance, t1.QuestRequired, t1.LootMode, t1.GroupId, t1.MinCount, t1.MaxCount FROM creature_loot_template AS t1 LEFT JOIN creature_template as t2 ON t1.Entry = t2.entry WHERE item = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/reference/item/{id}', function($id) {
  $results = DB::connection('world')->select('SELECT * FROM reference_loot_template WHERE item = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/gameobject/item/{id}', function($id) {
  $results = DB::connection('world')->select('SELECT t1.Entry, t2.name, t1.Reference, t1.Chance, t1.QuestRequired, t1.LootMode, t1.GroupId, t1.MinCount, t1.MaxCount FROM gameobject_loot_template AS t1 LEFT JOIN gameobject_template as t2 ON t1.Entry = t2.entry WHERE item = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/item/item/{id}', function($id) {
  $results = DB::connection('world')->select('SELECT t1.Entry, t2.name, t1.Item, t1.Reference, t1.Chance, t1.QuestRequired, t1.LootMode, t1.GroupId, t1.MinCount, t1.MaxCount FROM item_loot_template AS t1 LEFT JOIN item_template as t2 ON t1.Entry = t2.entry WHERE item = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/fishing/item/{id}', function($id) {
  $results = DB::connection('world')->select('SELECT * FROM fishing_loot_template WHERE item = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/disenchant/item/{id}', function($id) {
  $results = DB::connection('world')->select('SELECT t1.Entry, t2.name, t1.Item, t1.Reference, t1.Chance, t1.QuestRequired, t1.LootMode, t1.GroupId, t1.MinCount, t1.MaxCount FROM disenchant_loot_template AS t1 LEFT JOIN item_template as t2 ON t1.Entry = t2.entry WHERE item = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/prospecting/item/{id}', function($id) {
  $results = DB::connection('world')->select('SELECT * FROM prospecting_loot_template WHERE item = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/milling/item/{id}', function($id) {
  $results = DB::connection('world')->select('SELECT * FROM milling_loot_template WHERE item = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/pickpocketing/item/{id}', function($id) {
  $results = DB::connection('world')->select('SELECT t1.Entry, t2.name, t1.Reference, t1.Chance, t1.QuestRequired, t1.LootMode, t1.GroupId, t1.MinCount, t1.MaxCount FROM pickpocketing_loot_template AS t1 LEFT JOIN creature_template as t2 ON t1.Entry = t2.entry WHERE item = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/skinning/item/{id}', function($id) {
  $results = DB::connection('world')->select('SELECT t1.Entry, t2.name, t1.Reference, t1.Chance, t1.QuestRequired, t1.LootMode, t1.GroupId, t1.MinCount, t1.MaxCount FROM skinning_loot_template AS t1 LEFT JOIN creature_template as t2 ON t1.Entry = t2.entry WHERE item = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/spell/item/{id}', function($id) {
  $results = DB::connection('world')->select('SELECT * FROM spell_loot_template WHERE item = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');


/* All *_loot_template with no extra fields */

Route::get('/loot/template/creature/{id}', function($id) {
  $results = DB::connection('world')->select('SELECT * FROM creature_loot_template WHERE Entry = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/template/reference/{id}', function($id) {
  $results = DB::connection('world')->select('SELECT * FROM reference_loot_template WHERE Entry = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/template/gameobject/{id}', function($id) {
  $results = DB::connection('world')->select('SELECT * FROM gameobject_loot_template WHERE Entry = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/template/item/{id}', function($id) {
  $results = DB::connection('world')->select('SELECT * FROM item_loot_template WHERE Entry = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/template/fishing/{id}', function($id) {
  $results = DB::connection('world')->select('SELECT * FROM fishing_loot_template WHERE Entry = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/template/disenchant/{id}', function($id) {
  $results = DB::connection('world')->select('SELECT * FROM disenchant_loot_template WHERE Entry = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/template/prospecting/{id}', function($id) {
  $results = DB::connection('world')->select('SELECT * FROM prospecting_loot_template WHERE Entry = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/template/milling/{id}', function($id) {
  $results = DB::connection('world')->select('SELECT * FROM milling_loot_template WHERE Entry = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/template/pickpocketing/{id}', function($id) {
  $results = DB::connection('world')->select('SELECT * FROM pickpocketing_loot_template WHERE Entry = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/template/skinning/{id}', function($id) {
  $results = DB::connection('world')->select('SELECT * FROM skinning_loot_template WHERE Entry = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/template/spell/{id}', function($id) {
  $results = DB::connection('world')->select('SELECT * FROM spell_loot_template WHERE Entry = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');


/* Characters */

Route::get('/characters/{guid}', function($guid) {

  if (isset($_GET['no_extra_fields']) && $_GET['no_extra_fields'] == 1)
    $results = DB::connection('characters')->select("SELECT * FROM characters WHERE guid = ?", [$guid]);
  else
    $results = DB::connection('characters')->select("SELECT t1.guid, t1.name, t3.guildid as guildId, t3.name AS guildName, t1.race, t1.class, t1.gender, t1.level, t1.xp, t1.money, t1.playerBytes, t1.playerBytes2, t1.playerFlags, t1.map, t1.instance_id, t1.online, t1.is_logout_resting, t1.arenaPoints, t1.totalHonorPoints, t1.todayHonorPoints, t1.yesterdayHonorPoints, t1.totalKills, t1.todayKills, t1.yesterdayKills, t1.chosenTitle FROM characters AS t1 LEFT JOIN guild_member AS t2 ON t1.guid = t2.guid LEFT JOIN guild AS t3 ON t2.guildid = t3.guildid WHERE t1.guid = ?", [$guid]);

  return Response::json($results);
})
  ->where('guid', '[0-9]+');

Route::get('/characters/{name}', function($name) {

  $name = DB::connection()->getPdo()->quote("%" . $name . "%");

  $query = sprintf("SELECT t1.guid, t1.name, t3.guildid as guildId, t3.name AS guildName, t1.race, t1.class, t1.gender, t1.level, t1.xp, t1.money, t1.playerBytes, t1.playerBytes2, t1.playerFlags, t1.map, t1.instance_id, t1.online, t1.is_logout_resting, t1.arenaPoints, t1.totalHonorPoints, t1.todayHonorPoints, t1.yesterdayHonorPoints, t1.totalKills, t1.todayKills, t1.yesterdayKills, t1.chosenTitle FROM characters AS t1 LEFT JOIN guild_member AS t2 ON t1.guid = t2.guid LEFT JOIN guild AS t3 ON t2.guildid = t3.guildid WHERE t1.name LIKE %s", $name);

  $results = DB::connection('characters')->select($query);

  return Response::json($results);
});

Route::get('/online', function() {

  $results = DB::connection('characters')->select("SELECT t1.guid, t1.name, t3.guildid as guildId, t3.name AS guildName, t1.race, t1.class, t1.gender, t1.level, t1.map, t1.instance_id FROM characters AS t1 LEFT JOIN guild_member AS t2 ON t1.guid = t2.guid LEFT JOIN guild AS t3 ON t2.guildid = t3.guildid WHERE t1.online = 1");

  return Response::json($results);
});


/* Custom queries for specific applications */

Route::get('/custom/GetQuestTitleByCriteria/', function() {

  // See https://github.com/Discover-/SAI-Editor/blob/master/SAI-Editor/Classes/Database/WorldDatabase.cs#L344

  if (
    !isset($_GET['RequiredNpcOrGo1']) &&
    !isset($_GET['RequiredNpcOrGo2']) &&
    !isset($_GET['RequiredNpcOrGo3']) &&
    !isset($_GET['RequiredNpcOrGo4']) &&
    !isset($_GET['RequiredSpellCast1'])
  ) {
    return Response::json(array("error" => "please insert at least one parameter"));
  }

  $query = DB::connection('world')->table('quest_template')->select('LogTitle');

  if (isset($_GET['RequiredNpcOrGo1']) && $_GET['RequiredNpcOrGo1'] != "") {
    $query->orWhere('RequiredNpcOrGo1', 'LIKE', '%'. $_GET['RequiredNpcOrGo1'] .'%');
  }
  if (isset($_GET['RequiredNpcOrGo2']) && $_GET['RequiredNpcOrGo2'] != "") {
    $query->orWhere('RequiredNpcOrGo1', 'LIKE', '%'. $_GET['RequiredNpcOrGo2'] .'%');
  }
  if (isset($_GET['RequiredNpcOrGo3']) && $_GET['RequiredNpcOrGo3'] != "") {
    $query->orWhere('RequiredNpcOrGo2', 'LIKE', '%'. $_GET['RequiredNpcOrGo3'] .'%');
    $query->orWhere('RequiredNpcOrGo3', 'LIKE', '%'. $_GET['RequiredNpcOrGo3'] .'%');
  }
  if (isset($_GET['RequiredNpcOrGo4']) && $_GET['RequiredNpcOrGo4'] != "") {
    $query->orWhere('RequiredNpcOrGo4', 'LIKE', '%'. $_GET['RequiredNpcOrGo4'] .'%');
  }
  if (isset($_GET['RequiredSpellCast1']) && $_GET['RequiredSpellCast1'] != "") {
    $query->orWhere('RequiredSpellCast1', 'LIKE', '%'. $_GET['RequiredSpellCast1'] .'%');
  }

  $results = $query->get();

  return Response::json($results);
});


/* Other */

Route::get('/version', function() {
  $results = DB::connection('world')->select('SELECT * FROM version');

  return Response::json($results);
});

Route::get('/api', function() {
  return Response::json(array("api_version" => "0.5", "api_branch" => "3.3.5"));
});


Route::get('/', 'WelcomeController@index');

