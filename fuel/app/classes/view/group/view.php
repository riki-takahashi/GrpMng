<?php
class View_Group_View extends ViewModel
{
	public function view()
	{
		//グループデータ
		if ( ! $group = Model_Group::find($this->id))
		{
			Session::set_flash('error', '該当のグループが見つかりません。 #'.$this->id);
			Response::redirect('group');
		}
		$this->group = $group;
		//無効フラグリストデータ
		Config::load('arrays', true);
		$invalid_flags = Config::get('arrays.invalid_flag');
		$this->invalid_label = function($val) use ($invalid_flags) {
			return $invalid_flags[$val];
		};
	}
}
