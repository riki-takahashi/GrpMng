<?php
class View_Employee_View extends ViewModel
{
	public function view()
	{
		//売上実績データ
		if ( ! $employee = Model_Employee::find($this->id))
		{
			Session::set_flash('error', '該当の売上実績が見つかりません。 #'.$this->id);
			Response::redirect('sales/result/index/');
		}
		$this->employee = $employee;

		Config::load('arrays', true);
	}
}
