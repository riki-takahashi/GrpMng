<?php
class View_Employee_View extends ViewModel
{
	public function view()
	{
		//社員データ
		if ( ! $employee = Model_Employee::find($this->id))
		{
			Session::set_flash('error', '該当の社員が見つかりません。 #'.$this->id);
			Response::redirect('employee/index/');
		}
		$this->employee = $employee;

		Config::load('arrays', true);
		//無効フラグリストデータ
		$invalid_flags = Config::get('arrays.invalid_flag');
		$this->invalid_label = function($val) use ($invalid_flags) {
			return $invalid_flags[$val];
		};
		//物件担当権限リストデータ
		$is_mng_flag = Config::get('arrays.is_mng_flag');
		$this->is_mng_label = function($val) use ($is_mng_flag) {
			return $is_mng_flag[$val];
		};
	}
}
