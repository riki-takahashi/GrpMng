<?php
class View_Group_Index extends ViewModel
{
	public function view()
	{
		//グループ一覧データ
		$groups = Model_Group::find('all', array(
            'order_by' => array('id' => 'asc'),
        ));
		$this->groups = $groups;
		//無効フラグリストデータ
		Config::load('arrays', true);
		$invalid_flags = Config::get('arrays.invalid_flag');
		$this->invalid_label = function($val) use ($invalid_flags) {
			return $invalid_flags[$val];
		};
	}
}
