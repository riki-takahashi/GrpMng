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
				Session::set_flash('error', 'ユーザーIDもしくはパスワードが違います。');
			}
		}
		
		$this->template->is_menu = true;
		$this->template->is_login = true;
		$this->template->title = "ログイン";
		$this->template->content = View::forge('menu/login');
	}
	
	public function action_logout()
	{
		Auth::logout();
		Response::redirect('menu/login');
	}
	
}
