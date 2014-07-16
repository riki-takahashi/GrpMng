<?php
class Controller_Menu extends Controller_Template{

	public function action_index()
	{
		$this->template->is_menu = true;
		$this->template->title = "メニュー";
		$this->template->content = View::forge('menu/index');

	}
	
}
