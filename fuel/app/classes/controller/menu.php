<?php
class Controller_Menu extends Controller_Mybase{

	public function action_index()
	{
		$this->template->is_menu = true;
		$this->template->title = "メニュー";
		$this->template->content = View::forge('menu/index');
	}
	
	public function action_login()
	{
		Auth::check() and Response::redirect('menu');
		
		$data = array();
		
		if (Input::method() == 'POST')
		{
			$username = Input::post('username');
			$password = Input::post('password');
			
			if (Auth::login($username, $password))
			{
				Response::redirect('menu');
			}
			else
			{
				$data['error'] = true;
			}
		}
		
		$this->template->is_menu = true;
		$this->template->is_login = true;
		$this->template->title = "ログイン";
		$this->template->content = View::forge('menu/login', $data);
	}
	
	public function action_logout()
	{
		Auth::logout();
		Response::redirect('menu/login');
	}
	
}
