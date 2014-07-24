<?php
class Controller_Mybase extends Controller_Template{
	
	public function before()
	{
		parent::before();
		// ログイン認証チェック
		if ( !Auth::check() and !in_array(Request::active()->action, array('login')))
		{
			Response::redirect('menu/login');
		}
		// CSRFチェック
//		if (Input::method() === 'POST') {
//			if (!Security::check_token()) {
//				Response::redirect('menu/login');
//			}
//		}
	}
	
}

