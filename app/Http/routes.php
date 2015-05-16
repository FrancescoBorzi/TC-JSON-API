<?php

/* Search with multiple optional parameters */

Route::get('/search/creature', function() {

  if ( !isset($_GET['id']) && !isset($_GET['name']) && !isset($_GET['subname']) )
    return Response::json(array("error" => "please insert at least one parameter"));

  $query = DB::connection('world')->table('creature_template')->select('entry', 'name', 'subname');

  if (isset($_GET['id']) && $_GET['id'] != "")
    $query->where('entry', 'LIKE', "%". $_GET['id'] ."%");

  if (isset($_GET['name']) && $_GET['name'] != "")
    $query->where('name', 'LIKE', "%". $_GET['name'] ."%");

  if (isset($_GET['subname']) && $_GET['subname'] != "")
    $query->where('subname', 'LIKE', "%". $_GET['subname'] ."%");

  $results = $query->orderBy('entry')->get();

  return Response::json($results);
});

Route::get('/search/quest', function() {

  if ( !isset($_GET['id']) && !isset($_GET['name']) )
    return Response::json(array("error" => "please insert at least one parameter"));

  $query = DB::connection('world')->table('quest_template')->select('Id', 'Title', 'Details');

  if (isset($_GET['id']) && $_GET['id'] != "")
    $query->where('Id', 'LIKE', "%". $_GET['id'] ."%");

  if (isset($_GET['name']) && $_GET['name'] != "")
    $query->where('Title', 'LIKE', "%". $_GET['name'] ."%");

  $results = $query->orderBy('Id')->get();

  return Response::json($results);
});

Route::get('/search/item', function() {

  if ( !isset($_GET['id']) && !isset($_GET['name']) )
    return Response::json(array("error" => "please insert at least one parameter"));

  $query = DB::connection('world')->table('item_template')->select('entry', 'name');

  if (isset($_GET['id']) && $_GET['id'] != "")
    $query->where('entry', 'LIKE', "%". $_GET['id'] ."%");

  if (isset($_GET['name']) && $_GET['name'] != "")
    $query->where('name', 'LIKE', "%". $_GET['name'] ."%");

  $results = $query->orderBy('entry')->get();

  return Response::json($results);
});

Route::get('/search/gameobject', function() {

  if ( !isset($_GET['id']) && !isset($_GET['name']) )
    return Response::json(array("error" => "please insert at least one parameter"));

  $query = DB::connection('world')->table('gameobject_template')->select('entry', 'name');

  if (isset($_GET['id']) && $_GET['id'] != "")
    $query->where('entry', 'LIKE', "%". $_GET['id'] ."%");

  if (isset($_GET['name']) && $_GET['name'] != "")
    $query->where('name', 'LIKE', "%". $_GET['name'] ."%");

  $results = $query->orderBy('entry')->get();

  return Response::json($results);
});

Route::get('/search/character', function() {

  if ( !isset($_GET['guid']) && !isset($_GET['account']) && !isset($_GET['name']) )
    return Response::json(array("error" => "please insert at least one parameter"));

  $query = DB::connection('characters')->table('characters')->select('guid', 'account', 'name');

  if (isset($_GET['guid']) && $_GET['guid'] != "")
    $query->where('guid', 'LIKE', "%". $_GET['guid'] ."%");

  if (isset($_GET['account']) && $_GET['account'] != "")
    $query->where('account', 'LIKE', "%". $_GET['account'] ."%");

  if (isset($_GET['name']) && $_GET['name'] != "")
    $query->where('name', 'LIKE', "%". $_GET['name'] ."%");

  $results = $query->orderBy('guid')->get();

  return Response::json($results);
});


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
  $results = DB::connection('world')->select("SELECT * FROM creature_equip_template WHERE entry = ?", [$id]);

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

Route::get('/creature/spawn/addon/{guid}', function($guid) {
  $results = DB::connection('world')->select("SELECT * FROM creature_addon WHERE guid = ?", [$guid]);

  return Response::json($results);
})
  ->where('guid', '[0-9]+');

Route::get('/creature/queststarter/id/{id}', function($id) {
  $results = DB::connection('world')->select("SELECT t1.id, t1.quest, t2.Title FROM creature_queststarter AS t1 LEFT JOIN quest_template AS t2 ON t1.quest = t2.id WHERE t1.id = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/creature/queststarter/quest/{id}', function($id) {
  $results = DB::connection('world')->select("SELECT t1.id, t2.name, t1.quest FROM creature_queststarter AS t1 LEFT JOIN creature_template AS t2 ON t1.id = t2.entry WHERE t1.quest = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/creature/questender/id/{id}', function($id) {
  $results = DB::connection('world')->select("SELECT t1.id, t1.quest, t2.Title FROM creature_questender AS t1 LEFT JOIN quest_template AS t2 ON t1.quest = t2.id WHERE t1.id = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/creature/questender/quest/{id}', function($id) {
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
  $results = DB::connection('world')->select("SELECT t1.id, t1.quest, t2.Title FROM gameobject_queststarter AS t1 LEFT JOIN quest_template AS t2 ON t1.quest = t2.id WHERE t1.id = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/gameobject/queststarter/quest/{id}', function($id) {
  $results = DB::connection('world')->select("SELECT t1.id, t2.name, t1.quest FROM gameobject_queststarter AS t1 LEFT JOIN gameobject_template AS t2 ON t1.id = t2.entry WHERE t1.quest = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/gameobject/questender/id/{id}', function($id) {
  $results = DB::connection('world')->select("SELECT t1.id, t1.quest, t2.Title FROM gameobject_questender AS t1 LEFT JOIN quest_template AS t2 ON t1.quest = t2.id WHERE t1.id = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/gameobject/questender/quest/{id}', function($id) {
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


/* Quests */

Route::get('/quest/template/{id}', function($id) {
  $results = DB::connection('world')->select("SELECT * FROM quest_template WHERE id = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/quest/template/title/{id}', function($id) {
  $results = DB::connection('world')->select("SELECT Id, Title FROM quest_template WHERE id = ?", [$id]);

  return Response::json($results);
})
  ->where('id', '[0-9]+');

Route::get('/quest/template/{name}', function($name) {

  if (strlen($name) < 4) return json_encode(array("error" => "min search length 4 characters"));

  $name = DB::connection()->getPdo()->quote("%" . $name . "%");

  $query = sprintf("SELECT * FROM quest_template WHERE title LIKE %s", $name);

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


/* Characters */

Route::get('/characters/{guid}', function($guid) {
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


/* Other */

Route::get('/version', function() {
  $results = DB::connection('world')->select('SELECT * FROM version');

  return Response::json($results);
});

Route::get('/api', function() {
  return Response::json(array("api_version" => "0.3", "api_branch" => "3.3.5"));
});


Route::get('/', 'WelcomeController@index');

