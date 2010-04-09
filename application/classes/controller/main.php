<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Main extends Controller_Base {

	public function action_index()
	{
		$this->template->title = "KOBASE";
		$this->template->content = View::factory('main/index');
	}

} // End Welcome
