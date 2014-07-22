<?php
class View_Employee_Index extends ViewModel
{
	public function view()
	{
		//売上実績データ
		$sales_result = Model_Sales_Result::query()
			->get();

		$this->employees = $sales_result;
		//無効フラグリストデータ
		Config::load('arrays', true);
		$invalid_flags = Config::get('arrays.invalid_flag');
		$this->invalid_label = function($val) use ($invalid_flags) {
			return $invalid_flags[$val];
		};
	}
}
