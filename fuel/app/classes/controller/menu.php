<?php
/**
 * メニューコントローラクラス
 * Copyright 2014 Riki System Co.,Ltd.
 * @author takahashi
 */
class Controller_Menu extends Controller_Mybase{

        /**
         * 初期表示
         */
	public function action_index()
	{
            $this->template->is_menu = true;
            $this->template->title = "メニュー";
            $this->template->content = View::forge('menu/index');
	}
	
        /**
         * ログイン
         */
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
	
        /**
         * ログアウト
         */
	public function action_logout()
	{
		Auth::logout();
                Session::destroy();
		Response::redirect('menu/login');
	}
	
}
