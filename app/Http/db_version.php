<?php

function db_parsing($version,$name)
{
   if(is_array($db_version[$version]))
   {return array_values($db_version[$version][$name]);}
   else
   {return false;}    
}


// Vanilla
$db_version[1] = array(
		"dbc_achievements"						=> "achievements_vanilla",
		"dbc_areas_and_zones"						=> "areas_and_zones_vanilla"	
);

// TBC
$db_version[2] = array(
		"dbc_achievements"						=> "achievements_tbc",
		"dbc_areas_and_zones"						=> "areas_and_zones_tbc"	
);

// WOTLK
$db_version[3] = array(
		"dbc_achievements"						=> "achievements_wotlk",
		"dbc_areas_and_zones"						=> "areas_and_zones_wotlk"	
);

// Cataclysm
$db_version[4] = array(
		"dbc_achievements"						=> "achievements_cata",
		"dbc_areas_and_zones"						=> "areas_and_zones_cata"	
);

// Mists of Pandaria
$db_version[5] = array(
		"dbc_achievements"						=> "achievements_mop",
		"dbc_areas_and_zones"						=> "areas_and_zones_mop"	
);

// Warlords of Darkness
$db_version[6] = array(
		"dbc_achievements"						=> "achievements_wod",
		"dbc_areas_and_zones"						=> "areas_and_zones_wod"	
);