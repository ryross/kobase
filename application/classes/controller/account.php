<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Account extends Controller_Base 
{

   public $auth_role      = array('login'); //required role for secured pages
	public $secure_actions = array('index'); //secured pages
	
	public function action_index()
	{
		$this->template->title = "Account";
		$this->template->content = View::factory('account/index');
	}

	public function action_register()
	{	
		
		#If user already signed-in
		if(Auth::instance()->logged_in() != 0)
		{
			#redirect to the user account
			Request::instance()->redirect('account');
		}
		
		$this->template->title = "Register";
		#Load the view
		$content = $this->template->content = View::factory('account/register');
		$content->post = array();
		#If there is a post and $_POST is not empty
		if ($_POST)
		{
			#Instantiate a new user
			$user = ORM::factory('user');	
			
			#Load the validation rules, filters etc...
			$post = $user->validate_create($_POST);
			
			#If the post data validates using the rules setup in the user model
			if ($post->check())
			{
				#Affects the sanitized vars to the user object
				$user->values($post);
				
				#create the account
				$user->save();
				
				#Add the login role to the user
				$login_role = new Model_Role(array('name' =>'login'));
				$user->add('roles',$login_role);
				
				#sign the user in
				Auth::instance()->login($post['username'], $post['password']);
				
				#redirect to the user account
				Request::instance()->redirect('account');
			}
			else
			{
				#Get errors for display in view
				$content->errors = $post->errors('register');
			}			
		}		
	}

	public function action_login()
	{
		#If user already signed-in
		if(Auth::instance()->logged_in() != 0)
		{
			#redirect to the user account
			Request::instance()->redirect('account');
		}
		
		$this->template->title = "Login";
		$content = $this->template->content = View::factory('account/login');	
		$content->post = array();
		
		#If there is a post and $_POST is not empty
		if ($_POST)
		{
			#Instantiate a new user
			$user = ORM::factory('user');
			
			#Check Auth
			$status = $user->login($_POST);
			
			#If the post data validates using the rules setup in the user model
			if ($status)
			{
				$role = $user->roles->where('name', '=', 'admin')->find();
				if($role->loaded())
				{
					Request::instance()->redirect('admin');
				}
				
				#redirect to the user account
				Request::instance()->redirect('account');
			}
			else
			{
				#Get errors for display in view
				$content->errors = $_POST->errors('login');
			}
		}
	}

	public function action_logout()
	{
		#Sign out the user
		Auth::instance()->logout();
		
		#redirect to the user account and then the signin page if logout worked as expected
		Request::instance()->redirect('account');		
	}
	
}