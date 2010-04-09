<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Base extends Controller_Template
{
	public $user;
	public $auth_required  = FALSE;
	public $auth_role      = array('login');
	public $secure_actions = array();
	
	public $auto_render = TRUE;
	public $template = 'template/template';
	protected $session;
	
	
	public function __construct(Request $request)
	{
		if (Request::$is_ajax)
		{
			$this->profiler = NULL;
			$this->auto_render = FALSE;
		}
		
		$this->session = Session::instance();
		parent::__construct($request);
	}

	public function before()
	{
		parent::before();
		
		$this->session= Session::instance();
		$action_name = Request::instance()->action;
		
		
		if ( ($this->auth_required == TRUE || in_array( $action_name, $this->secure_actions) )
				AND Auth::instance()->logged_in($this->auth_role) == FALSE)
		{
			if (Auth::instance()->logged_in())
			{
				Request::instance()->redirect('account/noaccess');
			}
			else
			{
				Request::instance()->redirect('account/login');
			}
		}
		
		if ($this->auto_render)
		{
			$this->template->content = '';
			$this->template->styles = array();
			$this->template->scripts = array();
		}
	}
	
	public function after()
	{
		if ($this->auto_render)
		{
			$styles = array(
				'base.css',
				'master.css'
			);
			$scripts = array(
				'jquery-1.4.1.js'
			);
			
			$this->template->styles = array_merge($styles, $this->template->styles);
			$this->template->scripts = array_merge($scripts, $this->template->scripts);
			
			$this->template->styles = Minify::factory('css')->minify($this->template->styles);
			$this->template->scripts = Minify::factory('js')->minify($this->template->scripts);
			
		}
		parent::after();
	}
	
}


