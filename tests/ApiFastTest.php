<?php

class ApiFastTest extends TestCase
{
	protected $baseUrl = '';

	/**
	 * ApiFastTest constructor.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testEmotes()
	{
		// WoTlk
		$this->json('GET', '/api/v1/dbc/emotes/')->seeJson(
			["id" => 0, "emote" => "ONESHOT_NONE"]
		);

		$this->json('GET', '/api/v1/dbc/emotes/3')->seeJson(
			["id" => 3, "emote" => "ONESHOT_WAVE(DNR)"]
		);

		// Wod
		$this->json('GET', '/api/v1/dbc/emotes/?version=wod')->seeJson(
			["id" => 577, "emote" => "ONESHOT_ATTACK1H"]
		);

		$this->json('GET', '/api/v1/dbc/emotes//?version=wod')->seeJson(
			["id" => 619, "emote" => "STATE_PARRY_UNARMED"]
		);
	}
}
