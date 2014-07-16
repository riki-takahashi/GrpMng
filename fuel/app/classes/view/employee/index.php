<?php
class View_Employee_Index extends ViewModel
{
	public function view()
	{
		//社員一覧データ
		// $employees = Model_Employee::find('all', array(
			// 'related' => array(
				// 'position' => array(
		            // 'order_by' => array('order_no' => 'desc'),
				// ),
			// ),
			// 'order_by' => array('emp_kana' => 'asc'),
        // ));
		$employees = Model_Employee::query()
			->related('position')
			->order_by('position.order_no', 'desc')
			->order_by('emp_kana', 'asc')
			->get();

		$this->employees = $employees;
		//無効フラグリストデータ
		Config::load('arrays', true);
		$invalid_flags = Config::get('arrays.invalid_flag');
		$this->invalid_label = function($val) use ($invalid_flags) {
			return $invalid_flags[$val];
		};
	}
}
