<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Base extends Controller_Base
{
	
	public $auth_required = TRUE; //Auth is required to access this controller
	public $auth_role     = array('login', 'admin'); //required roles

	public function after()
	{
		if ($this->auto_render)
		{
			$styles = array(
				'admin.css'
			);
		
			$scripts = array();
			
			$this->template->styles = array_merge($styles, $this->template->styles);
			$this->template->scripts = array_merge($scripts, $this->template->scripts);
		}
		parent::after();
	}
	
}