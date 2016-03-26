<?php

/* DBC */

Route::get('/achievement', function() {

  $query = DB::connection('achievement')->table('achievement');

  if (!isset($_GET['no_extra_fields']))
    $query->select('ID', 'Faction', 'Map', 'Name', 'Description', 'Category', 'Points', 'Flags', 'SpellIcon', 'icon');

  if (isset($_GET['category']) && $_GET['category'] != "")
    $query->where('category', '=', $_GET['category']);

  if (isset($_GET['faction']) && $_GET['faction'] != "") {
    if ($_GET['faction'] == "horde") {
      $query->where('Faction', '!=', '1');
    }

    if ($_GET['faction'] == "alliance")
      $query->where('Faction', '!=', '0');
  }

  $result = $query->get();

  return Response::json($result);
});

Route::get('/achievement_category', function() {

  $query = DB::connection('achievement')->table('achievementcategory');

  if (isset($_GET['no_extra_fields']) && $_GET['no_extra_fields'] != "" && $_GET['no_extra_fields'] == 0)
    $query->select('*');
  else
    $query->select('ID', 'ParentID', 'Name');

  if (isset($_GET['id']) && $_GET['id'] != "")
    $query->where('ID', '=', $_GET['id']);

  $result = $query->get();

  return Response::json($result);
});

Route::get('/dbc/achievements/{id}', function($id) {

  if (isset($_GET['version']))
    $results = DB::connection('sqlite')->select("SELECT * FROM  id = ?", [$id]);
  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/dbc/areas_and_zones/{id}', function($id) {

  if (isset($_GET['version']))
    $results = DB::connection('sqlite')->select("SELECT * FROM ".db_parsing($_GET['version'],'dbc_areas_and_zones')." WHERE m_ID = ?", [$id]);

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

Route::get('/dbc/maps/{id}', function($id) {

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
    $results = DB::connection('sqlite')->select("SELECT * FROM sound_entries_wod WHERE id = ?", [$id]);
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

  if (isset($_GET['version']) && $_GET['version'] == 6)
  {
    $query = DB::connection('hotfixes')->table('item_sparse')->select('ID', 'Name');

    if (isset($_GET['id']) && $_GET['id'] != "")
      $query->where('ID', 'LIKE', '%'. $_GET['id'] .'%');

    if (isset($_GET['name']) && $_GET['name'] != "")
      $query->where('Name', 'LIKE', '%'. $_GET['name'] .'%');

    $results = $query->orderBy('ID')->get();
  }
  else
  {
    $query = DB::connection('world')->table('item_template')->select('entry', 'name');

    if (isset($_GET['id']) && $_GET['id'] != "")
      $query->where('entry', 'LIKE', '%'. $_GET['id'] .'%');

    if (isset($_GET['name']) && $_GET['name'] != "")
      $query->where('name', 'LIKE', '%'. $_GET['name'] .'%');

    $results = $query->orderBy('entry')->get();
  }

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

Route::get('/search/tickets', function() {

  $query = DB::connection('characters')->table('gm_ticket');

  if (isset($_GET['version']) && $_GET['version'] == 6)
  {
    // TODO
    return;
  }
  else
  {
    $query->join('characters AS player', 'player.guid', '=', 'gm_ticket.playerGuid');
    $query->leftJoin('characters AS assign', 'assign.guid', '=', 'gm_ticket.assignedTo');

    if (isset($_GET['unresolved']) && $_GET['unresolved'] == 1)
      $query->where('gm_ticket.closedBy', '=', 0)->where('gm_ticket.completed', '=', 0);

    if (isset($_GET['online']) && $_GET['online'] != "")
      $query->where('characters.online', '=', $_GET['online']);

    if (isset($_GET['closedBy']) && $_GET['closedBy'] != "")
      $query->where('gm_ticket.closedBy', '=', $_GET['closedBy']);

    if (isset($_GET['createTime']) && $_GET['createTime'] != "")
      $query->where('gm_ticket.createTime', '=', $_GET['createTime']);

    if (isset($_GET['lastModifiedTime']) && $_GET['lastModifiedTime'] != "")
      $query->where('gm_ticket.lastModifiedTime', '=', $_GET['lastModifiedTime']);

    if (isset($_GET['id']) && $_GET['id'] != "")
      $query->where('gm_ticket.id', 'LIKE', '%'. $_GET['id'] .'%');

    if (isset($_GET['playerGuid']) && $_GET['playerGuid'] != "")
      $query->where('gm_ticket.playerGuid', 'LIKE', '%'. $_GET['playerGuid'] .'%');

    if (isset($_GET['name']) && $_GET['name'] != "")
      $query->where('gm_ticket.name', 'LIKE', '%'. $_GET['name'] .'%');

    if (isset($_GET['description']) && $_GET['description'] != "")
      $query->where('gm_ticket.description', 'LIKE', '%'. $_GET['description'] .'%');

    if (isset($_GET['assignedTo']) && $_GET['assignedTo'] != "")
      $query->where('gm_ticket.assignedTo', 'LIKE', '%'. $_GET['assignedTo'] .'%');

    if (isset($_GET['comment']) && $_GET['comment'] != "")
      $query->where('gm_ticket.comment', 'LIKE', '%'. $_GET['comment'] .'%');

    if (isset($_GET['response']) && $_GET['response'] != "")
      $query->where('gm_ticket.response', 'LIKE', '%'. $_GET['response'] .'%');

    $results = $query->select('gm_ticket.*', 'player.name AS playerCurrentName', 'player.online', 'assign.name AS assignedToName')->orderBy('gm_ticket.id')->get();
  }

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

Route::get('/search/worldstates', function() {

  if (
    !isset($_GET['comment'])
  ) {
    return Response::json(array("error" => "please insert at least one parameter"));
  }

  $query = DB::connection('characters')->table('worldstates')->select('entry', 'value', 'comment');

  if (isset($_GET['comment']) && $_GET['comment'] != "")
    $query->where('comment', 'LIKE', '%'. $_GET['comment'] .'%');

  $results = $query->orderBy('value')->get();

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

Route::get('/search/dbc/maps', function() {

  if ( !isset($_GET['id']) && !isset($_GET['name']) )
    return Response::json(array("error" => "please insert at least one parameter"));

  if (isset($_GET['version']) && $_GET['version'] == 6)
    $query = DB::connection('sqlite')->table('maps_wod')->select('m_ID', 'm_MapName_lang1');
  else
    $query = DB::connection('sqlite')->table('maps_wotlk')->select('m_ID', 'm_MapName_lang1');

  if (isset($_GET['id']) && $_GET['id'] != "")
    $query->where('m_ID', 'LIKE', '%'. $_GET['id'] .'%');

  if (isset($_GET['name']) && $_GET['name'] != "")
    $query->where('m_MapName_lang1', 'LIKE', '%'. $_GET['name'] .'%');

  $results = $query->orderBy('m_ID')->get();

  return Response::json($results);
});

Route::get('/search/dbc/skills', function() {

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

  if (isset($_GET['version']) && $_GET['version'] == 6)
    $query = DB::connection('sqlite')->table('spells_wod')->select('ID', 'spellName');
  else
    $query = DB::connection('sqlite')->table('spells_wotlk')->select('ID', 'spellName');

  if (isset($_GET['id']) && $_GET['id'] != "")
    $query->where('ID', 'LIKE', '%'. $_GET['id'] .'%');

  if (isset($_GET['name']) && $_GET['name'] != "")
    $query->where('spellName', 'LIKE', '%'. $_GET['name'] .'%');

  $results = $query->orderBy('ID')->get();

  return Response::json($results);
});

Route::get('/search/dbc/areas_and_zones', function() {

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

Route::get('/creature/questitem/{id}', function($id) {

  $results = DB::connection('world')->select("SELECT * FROM creature_questitem WHERE CreatureEntry = ?", [$id]);

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

Route::get('/gameobject/questitem/{id}', function($id) {

  $results = DB::connection('world')->select("SELECT * FROM gameobject_questitem WHERE GameObjectEntry = ?", [$id]);

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

Route::get('/item/template/icon/{entries}', function($entries) {

  // Check if multiple entries
  if (strpos($entries, ",") > -1)
  {
    $items = DB::connection('world')->select("SELECT entry,displayid AS icon FROM item_template WHERE entry IN (" . $entries . ")");

    if ($items == NULL)
      return Response::json(array("error" => "please insert a valid item entry"));

    $ids = "";

    for ($i = 0; $i < count($items)-1; $i++)
      $ids .= $items[$i]->{'icon'}.",";

    $ids .= $items[count($items)-1]->{'icon'};

    $icons = DB::connection('itemdisplaydb')->select("SELECT ID AS displayid,icon FROM itemdisplay WHERE ID IN (".$ids.");");

    for ($i = 0; $i < count($items); $i++)
      for ($j = 0; $j < count($icons); $j++)
        if ($items[$i]->{'icon'} == $icons[$j]->{'displayid'})
          $items[$i]->{'icon'} = $icons[$j]->{'icon'};

    $results = $items;
  }
  else
  {
    $displayid = DB::connection('world')->select("SELECT displayid FROM item_template WHERE entry = ?", [$entries]);

    if ($displayid == NULL)
      return Response::json(array("error" => "please insert a valid item entry"));

    $displayid = $displayid[0]->{'displayid'};
    $results = DB::connection('itemdisplaydb')->select("SELECT icon FROM itemdisplay WHERE ID = ?", [$displayid]);
  }

  return Response::json($results);
})
  ->where('entries', '[0-9-,]+');


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

Route::get('/quest/template/addon/{id}', function($id) {
  $results = DB::connection('world')->select("SELECT * FROM quest_template_addon WHERE ID = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/quest/details/{id}', function($id) {
  $results = DB::connection('world')->select("SELECT * FROM quest_details WHERE ID = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/quest/objectives/{id}', function($id) {
  $results = DB::connection('world')->select("SELECT * FROM quest_objectives WHERE QuestID = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/quest/offer_reward/{id}', function($id) {
  $results = DB::connection('world')->select("SELECT * FROM quest_offer_reward WHERE ID = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/quest/poi/{id}', function($id) {
  $results = DB::connection('world')->select("SELECT * FROM quest_poi WHERE QuestID = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/quest/poi/points/{id}', function($id) {
  $results = DB::connection('world')->select("SELECT * FROM quest_poi_points WHERE QuestID = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/quest/request_items/{id}', function($id) {
  $results = DB::connection('world')->select("SELECT * FROM quest_request_items WHERE ID = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');


/* Vendors */

Route::get('/vendor/creature/{id}', function($id) {
  if (isset($_GET['version']) && $_GET['version'] == 6)
    $results = DB::connection('world')->select("SELECT * FROM npc_vendor WHERE entry = ?", [$id]);
  else
    $results = DB::connection('world')->select("SELECT t1.entry, t1.slot, t1.item, t2.name, t1.maxcount, t1.incrtime, t1.ExtendedCost, t1.VerifiedBuild FROM npc_vendor AS t1 LEFT JOIN item_template AS t2 ON t1.item = t2.entry WHERE t1.entry = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/vendor/item/{id}', function($id) {
  $results = DB::connection('world')->select("SELECT t1.entry, t2.name, t1.slot, t1.item, t1.maxcount, t1.incrtime, t1.ExtendedCost, t1.VerifiedBuild FROM npc_vendor AS t1 LEFT JOIN creature_template AS t2 ON t1.entry = t2.entry WHERE t1.item = ?", [$id]);

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
  if (isset($_GET['version']) && $_GET['version'] == 6)
    $results = DB::connection('world')->select("SELECT * FROM creature_loot_template WHERE Entry = ?", [$id]);
  else
    $results = DB::connection('world')->select('SELECT t1.Entry, t1.Item, t2.name, t1.Reference, t1.Chance, t1.QuestRequired, t1.LootMode, t1.GroupId, t1.MinCount, t1.MaxCount FROM creature_loot_template as t1 LEFT JOIN item_template AS t2 ON t1.item = t2.entry WHERE t1.entry = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/reference/{id}', function($id) {
  if (isset($_GET['version']) && $_GET['version'] == 6)
    $results = DB::connection('world')->select("SELECT * FROM reference_loot_template WHERE Entry = ?", [$id]);
  else
    $results = DB::connection('world')->select('SELECT t1.Entry, t1.Item, t2.name, t1.Reference, t1.Chance, t1.QuestRequired, t1.LootMode, t1.GroupId, t1.MinCount, t1.MaxCount FROM reference_loot_template as t1 LEFT JOIN item_template AS t2 ON t1.item = t2.entry WHERE t1.entry = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/gameobject/{id}', function($id) {
  if (isset($_GET['version']) && $_GET['version'] == 6)
    $results = DB::connection('world')->select("SELECT * FROM gameobject_loot_template WHERE Entry = ?", [$id]);
  else
    $results = DB::connection('world')->select('SELECT t1.Entry, t1.Item, t2.name, t1.Reference, t1.Chance, t1.QuestRequired, t1.LootMode, t1.GroupId, t1.MinCount, t1.MaxCount FROM gameobject_loot_template as t1 LEFT JOIN item_template AS t2 ON t1.item = t2.entry WHERE t1.entry = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/item/{id}', function($id) {
  if (isset($_GET['version']) && $_GET['version'] == 6)
    $results = DB::connection('world')->select("SELECT * FROM item_loot_template WHERE Entry = ?", [$id]);
  else
    $results = DB::connection('world')->select('SELECT t1.Entry, t1.Item, t2.name, t1.Reference, t1.Chance, t1.QuestRequired, t1.LootMode, t1.GroupId, t1.MinCount, t1.MaxCount FROM item_loot_template as t1 LEFT JOIN item_template AS t2 ON t1.item = t2.entry WHERE t1.entry = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/fishing/{id}', function($id) {
  if (isset($_GET['version']) && $_GET['version'] == 6)
    $results = DB::connection('world')->select("SELECT * FROM fishing_loot_template WHERE Entry = ?", [$id]);
  else
    $results = DB::connection('world')->select('SELECT t1.Entry, t1.Item, t2.name, t1.Reference, t1.Chance, t1.QuestRequired, t1.LootMode, t1.GroupId, t1.MinCount, t1.MaxCount FROM fishing_loot_template as t1 LEFT JOIN item_template AS t2 ON t1.item = t2.entry WHERE t1.entry = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/disenchant/{id}', function($id) {
  if (isset($_GET['version']) && $_GET['version'] == 6)
    $results = DB::connection('world')->select("SELECT * FROM disenchant_loot_template WHERE Entry = ?", [$id]);
  else
    $results = DB::connection('world')->select('SELECT t1.Entry, t1.Item, t2.name, t1.Reference, t1.Chance, t1.QuestRequired, t1.LootMode, t1.GroupId, t1.MinCount, t1.MaxCount FROM disenchant_loot_template as t1 LEFT JOIN item_template AS t2 ON t1.item = t2.entry WHERE t1.entry = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/prospecting/{id}', function($id) {
  if (isset($_GET['version']) && $_GET['version'] == 6)
    $results = DB::connection('world')->select("SELECT * FROM prospecting_loot_template WHERE Entry = ?", [$id]);
  else
    $results = DB::connection('world')->select('SELECT t1.Entry, t1.Item, t2.name, t1.Reference, t1.Chance, t1.QuestRequired, t1.LootMode, t1.GroupId, t1.MinCount, t1.MaxCount FROM prospecting_loot_template as t1 LEFT JOIN item_template AS t2 ON t1.item = t2.entry WHERE t1.entry = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/milling/{id}', function($id) {
  if (isset($_GET['version']) && $_GET['version'] == 6)
    $results = DB::connection('world')->select("SELECT * FROM milling_loot_template WHERE Entry = ?", [$id]);
  else
    $results = DB::connection('world')->select('SELECT t1.Entry, t1.Item, t2.name, t1.Reference, t1.Chance, t1.QuestRequired, t1.LootMode, t1.GroupId, t1.MinCount, t1.MaxCount FROM milling_loot_template as t1 LEFT JOIN item_template AS t2 ON t1.item = t2.entry WHERE t1.entry = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/pickpocketing/{id}', function($id) {
  if (isset($_GET['version']) && $_GET['version'] == 6)
    $results = DB::connection('world')->select("SELECT * FROM pickpocketing_loot_template WHERE Entry = ?", [$id]);
  else
    $results = DB::connection('world')->select('SELECT t1.Entry, t1.Item, t2.name, t1.Reference, t1.Chance, t1.QuestRequired, t1.LootMode, t1.GroupId, t1.MinCount, t1.MaxCount FROM pickpocketing_loot_template as t1 LEFT JOIN item_template AS t2 ON t1.item = t2.entry WHERE t1.entry = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/skinning/{id}', function($id) {
  if (isset($_GET['version']) && $_GET['version'] == 6)
    $results = DB::connection('world')->select("SELECT * FROM skinning_loot_template WHERE Entry = ?", [$id]);
  else
    $results = DB::connection('world')->select('SELECT t1.Entry, t1.Item, t2.name, t1.Reference, t1.Chance, t1.QuestRequired, t1.LootMode, t1.GroupId, t1.MinCount, t1.MaxCount FROM skinning_loot_template as t1 LEFT JOIN item_template AS t2 ON t1.item = t2.entry WHERE t1.entry = ?', [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/loot/spell/{id}', function($id) {
  if (isset($_GET['version']) && $_GET['version'] == 6)
    $results = DB::connection('world')->select("SELECT * FROM spell_loot_template WHERE Entry = ?", [$id]);
  else
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
  if (isset($_GET['version']) && $_GET['version'] == 6)
    $results = DB::connection('world')->select("SELECT * FROM item_loot_template WHERE Entry = ?", [$id]);
  else
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
  if (isset($_GET['version']) && $_GET['version'] == 6)
    $results = DB::connection('world')->select("SELECT * FROM disenchant_loot_template WHERE Entry = ?", [$id]);
  else
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

Route::get('/battleground/deserters/recent/{count}', function($count) {
  $results = DB::connection('characters')->select('SELECT t1.guid, t2.name, t2.level, t1.type, t1.datetime FROM battleground_deserters AS t1 INNER JOIN characters AS t2 ON t1.guid = t2.guid ORDER BY datetime DESC LIMIT 0,?', [$count]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

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

  $results = DB::connection('characters')->select("SELECT t1.guid, t1.name, t3.guildid as guildId, t3.name AS guildName, t1.race, t1.class, t1.gender, t1.level, t1.map, t1.instance_id, t1.zone FROM characters AS t1 LEFT JOIN guild_member AS t2 ON t1.guid = t2.guid LEFT JOIN guild AS t3 ON t2.guildid = t3.guildid WHERE t1.online = 1");

  return Response::json($results);
});


Route::get('/auction', function() {

  if (isset($_GET['itemfrom']) && $_GET['itemfrom'] != "")
    $itemFrom = $_GET['itemfrom'];
  else
    $itemFrom = 0;

  if (isset($_GET['numitem']) && $_GET['numitem'] != "")
    $numItem = $_GET['numitem'];
  else
    $numItem = 100;

  if (isset($_GET['version']) && $_GET['version'] == 6)
  {
    $result = DB::select('SELECT ah.id,ah.houseid,c.name AS owner,owner_guid,c2.name AS buyname,buyguid,itemEntry,count,lastbid,startbid,buyoutprice,deposit,time
    FROM ' . env('DB_CHARACTERS') . '.auctionhouse AS ah
    LEFT JOIN ' . env('DB_CHARACTERS') . '.item_instance AS ins ON ah.itemguid = ins.guid
    LEFT JOIN ' . env('DB_CHARACTERS') . '.characters AS c ON ah.itemowner = c.guid
    LEFT JOIN ' . env('DB_CHARACTERS') . '.characters AS c2 ON ah.buyguid = c2.guid LIMIT ' . $itemFrom . ' , ' . $numItem);    
  }
  else
  {
    $result = DB::select('SELECT ah.id,ah.houseid,c.name AS owner,owner_guid,c2.name AS buyname,buyguid,itemEntry,n.name,n.displayid AS icon,count,lastbid,startbid,buyoutprice,deposit,time
    FROM ' . env('DB_CHARACTERS') . '.auctionhouse AS ah
    LEFT JOIN ' . env('DB_CHARACTERS') . '.item_instance AS ins ON ah.itemguid = ins.guid
    LEFT JOIN ' . env('DB_WORLD') .'.item_template AS n ON ins.itemEntry = n.entry
    LEFT JOIN ' . env('DB_CHARACTERS') . '.characters AS c ON ah.itemowner = c.guid
    LEFT JOIN ' . env('DB_CHARACTERS') . '.characters AS c2 ON ah.buyguid = c2.guid LIMIT ' . $itemFrom . ' , ' . $numItem);

    /* Get icon name */
    $ids = "";

    for ($i = 0; $i < count($result)-1; $i++)
      $ids .= $result[$i]->{'icon'}.",";

    $ids .= $result[count($result)-1]->{'icon'};

    $icons = DB::connection('itemdisplaydb')->select("SELECT ID AS displayid,icon FROM itemdisplay WHERE ID IN (".$ids.");");

    for ($i = 0; $i < count($result); $i++)
      for ($j = 0; $j < count($icons); $j++)
        if ($result[$i]->{'icon'} == $icons[$j]->{'displayid'})
          $result[$i]->{'icon'} = $icons[$j]->{'icon'};
  }


  for ($i = 0; $i < count($result); $i++)
  {
    /* Get buyname if the bidder exists */
    $result[$i]->{'buyname'} == null ? $result[$i]->{'buyname'} = "No bid" : '';


    /* Convert money value to gold,copper,silver */
    $buyoutprice = $result[$i]->{'buyoutprice'};
    $startbid    = $result[$i]->{'startbid'};
    $lastbid     = $result[$i]->{'lastbid'};

    if ($startbid > 9999)
    {
      $startbid = substr($startbid, 0, -4) . " gold " . substr($startbid, -4, 2) . " silver " . substr($startbid, -2) . " copper";

      if ($buyoutprice == "0")
        $buyoutprice = "";
      else
        $buyoutprice = substr($buyoutprice, 0, -4) . " gold " . substr($buyoutprice, -4, 2) . " silver " . substr($buyoutprice, -2) . " copper";

      if ($lastbid != "0")
        $lastbid = substr($lastbid, 0, -4) . " gold " . substr($lastbid, -4, 2) . " silver " . substr($lastbid, -2) . " copper";
    }
    elseif ($startbid > 99)
    {
      $startbid    = "00 gold " . substr($startbid, -4, 2) . " silver " . substr($startbid, -2) . " copper";

      if ($buyoutprice == "0")
        $buyoutprice = "";
      else
        $buyoutprice = "00 gold " . substr($buyoutprice, -4, 2) . " silver " . substr($buyoutprice, -2) . " copper";

      if ($lastbid != "0")
        $lastbid     = "00 gold " . substr($lastbid, -4, 2) . " silver " . substr($lastbid, -2) . " copper";
    }
    else
    {
      $startbid    = "00 gold 00 silver " . substr($startbid, -2) . " copper";

      if ($buyoutprice == "0")
        $buyoutprice = "";
      else
        $buyoutprice = "00 gold 00 silver " . substr($buyoutprice, -2) . " copper";

      if ($lastbid != "0")
        $lastbid     = "00 gold 00 silver " . substr($lastbid, -2) . " copper";
    }

    $result[$i]->{'buyoutprice'} = $buyoutprice;
    $result[$i]->{'startbid'}    = $startbid;
    $result[$i]->{'lastbid'}     = $lastbid;

    /* Converting timestamp in time dd hh mm  */
    $datetime1 = new DateTime();
    $datetime2 = new DateTime('@'.$result[$i]->{'time'});
    $interval = $datetime1->diff($datetime2);
    $timeleft = $interval->format('%a days %h hours %i minutes %S seconds');

    $empties = array('0 days ', '0 hours ', '0 minutes ', '0 seconds ');
    $timeleft = str_replace($empties, '', $timeleft);

    $result[$i]->{'time'} = $timeleft;
  }

  return Response::json($result);
})
  ->where('entries', '[0-9-,]+');;


/* Top Honor */

Route::get('/tophonor', function() {

  if (isset($_GET['startplayer']) && $_GET['startplayer'] != "")
    $startPlayer = $_GET['startplayer'];
  else
    $startPlayer = 0;

  if (isset($_GET['numplayer']) && $_GET['numplayer'] != "")
    $numPlayer = $_GET['numplayer'];
  else
    $numPlayer = 100;

  if (isset($_GET['level']) && $_GET['level'] != "")
    $level = $_GET['level'];
  else
    $level = "level";

  $query = sprintf("SELECT name,race,class,level,totalKills FROM characters WHERE level = %s ORDER BY totalKills DESC LIMIT %d , %d", $level, $startPlayer, $numPlayer);

  $result = DB::connection('characters')->select($query);

  return Response::json($result);
});


/* Arena routes */

Route::get('/arena_team/id/{arenaTeamId}', function($arenaTeamId) {
  $results = DB::connection('characters')->select("SELECT t1.*, t2.name AS captainName, t2.race AS captainRace FROM arena_team AS t1 INNER JOIN characters AS t2 ON t1.captainGuid = t2.guid WHERE t1.arenaTeamId = ?", [$arenaTeamId]);

  return Response::json($results);
})
  ->where('arenaTeamId', '[0-9]+');

Route::get('/arena_team/type/{type}/', function($type) {
  $results = DB::connection('characters')->select("SELECT t1.*, t2.name AS captainName, t2.race AS captainRace FROM arena_team AS t1 INNER JOIN characters AS t2 ON t1.captainGuid = t2.guid WHERE t1.type = ? ORDER BY rating DESC", [$type]);

  return Response::json($results);
})
  ->where('type', '[0-9]+');

Route::get('/arena_team_member/{arenaTeamId}', function($arenaTeamId) {
  $results = DB::connection('characters')->select("
  SELECT t1.*, t4.matchmakerRating AS matchmakerRating, t2.name AS name, t2.class AS class, t2.race AS race, t2.gender as gender
  FROM arena_team_member AS t1 INNER JOIN characters AS t2 ON t1.guid = t2.guid
  INNER JOIN arena_team AS t3 ON t1.arenaTeamId = t3.arenaTeamId
  LEFT JOIN character_arena_stats AS t4 ON
  (t1.guid = t4.guid AND t3.type =
    (CASE t4.slot
      WHEN 0 THEN 2
      WHEN 1 THEN 3
      WHEN 2 THEN 5
    END)
  )
  WHERE t1.arenaTeamId = ?", [$arenaTeamId]);

  return Response::json($results);
})
  ->where('arenaTeamId', '[0-9]+');

/* Achievements */

Route::get('/character_achievement/{guid}', function($guid) {

  $query = DB::connection('characters')->table('character_achievement');
  $query->where('guid', '=', $guid);

  $results = $query->get();

  if (isset($_GET['category']) && $_GET['category'] != "") {
    $results = $query->get();

    $ids = "";
    for ($i = 0; $i < count($results); $i++)
      $ids .= $results[$i]->{'achievement'} . ",";

    $ids = substr($ids, 0, strlen($ids)-1);

    $results = DB::connection('achievement')->select("SELECT ID, Name, Description, Category, Points, icon FROM achievement WHERE ID IN (" . $ids . ") AND category = " . $_GET['category']);
  }

  return Response::json($results);
})
  ->where('guid', '[0-9]+');

Route::get('/achievement_progress', function() {

  if (isset($_GET['from']) && $_GET['from'] != "")
    $from = $_GET['from'];
  else
    $from = 0;

  if (isset($_GET['to']) && $_GET['to'] != "")
    $to = $_GET['to'];
  else
    $to = 20;

  if (isset($_GET['guid']) && $_GET['guid'] != "" && isset($_GET['category']) && $_GET['category'] != "") {
    $ach_category = DB::connection('achievement')->select("SELECT ach.ID AS ID, acc.ID AS criteria, ach.Name, ach.Description, ach.Points, ach.Category, ach.icon, acc.Quantity
    FROM achievement AS ach
    JOIN achievementcriteria AS acc ON ach.ID = acc.Achievement
    WHERE ach.category=" . $_GET['category']);

    /* take criteria values */
    $ids = "";
    for ($i = 0; $i < count($ach_category); $i++)
      $ids .= $ach_category[$i]->{'criteria'} . ",";
    $ids = substr($ids, 0, strlen($ids)-1);

    $ach_progress = DB::connection('characters')->select("SELECT criteria, counter FROM character_achievement_progress WHERE guid=" . $_GET['guid'] . " AND criteria IN (" . $ids . ")");
    
    $result = [];
    $k = 0;
    
    for ($i = 0; $i < count($ach_category); $i++) {
      for ($j = 0; $j < count($ach_progress); $j++) {

        if ($ach_category[$i]->{'criteria'} == $ach_progress[$j]->{'criteria'}) {
          $ach_category[$i]->{'counter'} = $ach_progress[$j]->{'counter'};

          $result[$k] = $ach_category[$i];
          $k++;
        }

      }
    }

  }
  else if (isset($_GET['guid']) && $_GET['guid'] != "") {
    $result = DB::select('SELECT ac.guid, ac.criteria, ac.counter, ac.date, c.account, c.name, c.level, c.race, c.class, c.gender
FROM ' . env('DB_CHARACTERS') . '.character_achievement_progress AS ac
JOIN ' . env('DB_CHARACTERS') . '.characters AS c ON ac.guid = c.guid
WHERE ac.guid = ' . $_GET['guid']);

    /* take criteria values */
    $ids = "";
    for ($i = 0; $i < count($result); $i++)
      $ids .= $result[$i]->{'criteria'} . ",";
    $ids = substr($ids, 0, strlen($ids)-1);

    $ach = DB::connection('achievement')->select("SELECT acc.ID AS criteria, Achievement AS ID, aca.ID as CategoryID, aca.parentID, aca.Name as Category, aca2.Name as ParentCategory, ac.Name, ac.Description, acc.Description, Faction, Map, icon
FROM achievementcriteria as acc
JOIN achievement AS ac ON acc.Achievement = ac.ID
JOIN achievementcategory AS aca ON ac.category = aca.ID
JOIN achievementcategory AS aca2 ON aca.ParentID= aca2.ID
WHERE acc.ID IN (" . $ids . ") LIMIT 50");

    $result = $ach;
  }
  else {

    /* Underworking */
    /*
$result = DB::select('SELECT ac.guid, ac.criteria, SUM(ac.counter) AS counter, ac.date, c.account, c.name, c.level, c.race, c.class, c.gender
FROM ' . env('DB_CHARACTERS') . '.character_achievement_progress AS ac
JOIN ' . env('DB_CHARACTERS') . '.characters AS c ON ac.guid = c.guid
WHERE c.account NOT IN
(SELECT id FROM ' . env('DB_AUTH') . '.account_access WHERE gmlevel > 0)
LIMIT ' . $from . ' , ' . $to);
*/
    
    $result = DB::select('SELECT ac.guid, ac.criteria, SUM(ac.counter) AS counter, ac.date, c.account, c.name, c.level, c.race, c.class, c.gender
FROM ' . env('DB_CHARACTERS') . '.character_achievement_progress AS ac
JOIN ' . env('DB_CHARACTERS') . '.characters AS c ON ac.guid = c.guid
GROUP BY (guid)');

  }

  return Response::json($result);
});



/* Auth */

Route::get('/uptime', function() {

  if (isset($_GET['realmid']) && $_GET['realmid'] != "")
    $realmid = $_GET['realmid'];
  else
    $realmid = 1;

  $query = sprintf("SELECT * FROM uptime WHERE realmid = %d ORDER BY starttime DESC LIMIT 1", $realmid);

  $result = DB::connection('auth')->select($query);

  if (isset($_GET['time']))
  {
    $uptime = $result[0]->{'uptime'};

    $Days  = floor(($uptime / 24 / 60 / 60));
    $Hours = floor(($uptime / 60 / 60));
    $Min   = floor(($uptime / 60));

    if ($uptime > 86400)
      $uptime = $Days . " Days " . ( $Hours - ($Days*24) )  . " Hours " . ($Min - ( ($Days*24*60) + ( ( $Hours - ($Days*24) ) * 60 ) ) ) . " Min";
    elseif ($uptime > 3600)
      $uptime = $Hours . " Hours " . ( $Min - ($Hours*60) ) . " Min";
    else
      $uptime = $Min . " Min";

    $result[0]->{'uptime'} = $uptime;
  }

  return Response::json($result);
});


Route::get('/pulse/{days}', function($days) {
  $results = DB::connection('auth')->select("SELECT COUNT(*) as accounts, COUNT(DISTINCT(last_ip)) AS IPs FROM account WHERE DATEDIFF(NOW(), last_login) < ?", [$days]);

  return Response::json($results);
})
  ->where('days', '[0-9]+');


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


/* Unusued Guid Search */

Route::get('/search/guid/', function() {

  if ( !isset($_GET['startid']) && !isset($_GET['numguid']) && !isset($_GET['table']))
    return Response::json(array("error" => "please insert the parameter startid, numguid and table"));

  if (isset($_GET['startid']) && $_GET['startid'] != "" && isset($_GET['numguid']) && $_GET['numguid'] != "" && isset($_GET['table']) && $_GET['table'] != "")
  {
    $table = $_GET['table'];
    switch ($table)
    {
      case 'creature':
        $param = "guid";
        break;

      case 'gameobject':
        $param = "guid";
        break;

      case 'waypoint_scripts':
        $param = "guid";
        break;

      case 'pool_template':
        $param = "entry";
        break;

      case 'game_event':
        $param = "eventEntry";
        break;

      case 'creature_equip_template':
        $param = "CreatureID";
        break;

      case 'trinity_string':
        $param = "entry";
        break;
    }

    if (isset($_GET['continuous']) and $_GET['continuous'] == "1")
      $continuous = true;
    else
      $continuous = false;

    $query_max_min = sprintf("SELECT MAX(%s), MIN(%s) FROM %s", $param, $param, $table);

    $row = DB::connection('world')->select($query_max_min);

    $MAX_GUID = $row[0]->{'MAX('.$param.')'};
    $MIN_GUID = $row[0]->{'MIN('.$param.')'};

    $query = sprintf("SELECT %s FROM `%s` WHERE %s >= %d ORDER BY %s ASC", $param, $table, $param, $_GET['startid'], $param);
    $row = DB::connection('world')->select($query);

    $last = $row[0]->$param;

    $count = 0;

    $json = new ArrayObject(array(), ArrayObject::STD_PROP_LIST);
    $guid = [];

    if ($continuous)
    {
      for ($j = 0; $j < count($row); $j++)
      {
        if ($count >= $_GET['numguid'])
          break;

        $current = $row[$j]->$param;

        if ($current - $last - 1 >= $_GET['numguid'])
        {
          for ($i = $last + 1; $i < $current; $i++)
          {

            $guid[$count] = $i;

            $count++;

            if ($count >= $_GET['numguid'])
              break;
          }

          break;
        }

        $last = $current;
      }
    }
    else
    {
      for ($j = 0; $j < count($row); $j++)
      {
        if ($count >= $_GET['numguid'])
          break;

        $current = $row[$j]->$param;

        if ($current != $last + 1)
        {
          for ($i = $last + 1; $i < $current; $i++)
          {
            $guid[$count] = $i;

            $count++;

            if ($count >= $_GET['numguid'])
              break;
          }
        }
        $last = $current;
      }
    }

    $json->guid = $guid;
    return Response::json($json);
  }

});


/* Other */

Route::get('/version', function() {
  $results = DB::connection('world')->select('SELECT * FROM version');

  return Response::json($results);
});

Route::get('/api', function() {
  return Response::json(array("api_version" => "0.7", "api_branch" => "master"));
});

Route::get('topgm/ticket/account', function() {
  $results = DB::select('SELECT t3.username AS account, COUNT(*) AS count FROM `' . env('DB_CHARACTERS') . '`.gm_ticket AS t1 INNER JOIN `' . env('DB_CHARACTERS') . '`.characters AS t2 ON t1.resolvedBy = t2.guid INNER JOIN `' . env('DB_AUTH') . '`.account AS t3 ON t2.account = t3.id GROUP BY t3.username ORDER BY count DESC;');

  return Response::json($results);
});

Route::get('topgm/ticket/account/month/{diff}', function($diff) {
  $results = DB::select('SELECT t3.username AS account, COUNT(*) AS count FROM `' . env('DB_CHARACTERS') . '`.gm_ticket AS t1 INNER JOIN `' . env('DB_CHARACTERS') . '`.characters AS t2 ON t1.resolvedBy = t2.guid INNER JOIN `' . env('DB_AUTH') . '`.account AS t3 ON t2.account = t3.id WHERE MONTH(FROM_UNIXTIME(t1.lastModifiedTime)) = MONTH(NOW() + INTERVAL -? MONTH) GROUP BY t3.username ORDER BY count DESC;', [$diff]);

  return Response::json($results);
})
  ->where('diff', '[0-9]+');

Route::get('topgm/ticket/character', function() {
  $results = DB::select('SELECT t2.name, t3.username AS account, COUNT(*) AS count FROM `' . env('DB_CHARACTERS') . '`.gm_ticket AS t1 INNER JOIN `' . env('DB_CHARACTERS') . '`.characters AS t2 ON t1.resolvedBy = t2.guid INNER JOIN `' . env('DB_AUTH') . '`.account AS t3 ON t2.account = t3.id GROUP BY t2.guid ORDER BY count DESC;');

  return Response::json($results);
});

Route::get('ticket/recent/{count}', function($count) {

  $query = DB::connection('characters')->table('gm_ticket');

  $query->leftJoin('characters AS player', 'player.guid', '=', 'gm_ticket.playerGuid');
  $query->leftJoin('characters AS resolv', 'resolv.guid', '=', 'gm_ticket.resolvedBy');
  $query->leftJoin('characters AS assign', 'assign.guid', '=', 'gm_ticket.assignedTo');

  $results = $query->select('gm_ticket.*', 'player.name AS playerCurrentName', 'resolv.name AS resolvedByName', 'assign.name AS assignedToName')->where('gm_ticket.closedBy', '!=', 0)->orWhere('gm_ticket.completed', '!=', 0)->orderBy('gm_ticket.id', 'desc')->take($count)->get();

  return Response::json($results);
});

Route::get('/', 'WelcomeController@index');

