<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class dbcController extends Controller
{

	public function getFactionById($id) {

		if (\App\Helpers\TCAPI::is("wod"))
				$results = DB::connection('sqlite')->select("SELECT * FROM factions_wod WHERE m_ID = ?", [$id]);
		else
				$results = DB::connection('sqlite')->select("SELECT * FROM factions_wotlk WHERE m_ID = ?", [$id]);

		return response()->json($results);
	}

}
