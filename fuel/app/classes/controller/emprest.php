<?php
/**
 * 
 * 使用していない
 * 
 */
class Controller_Emprest extends Controller_Rest
{
	public function get_emp()
	{
		$this->response(Model_Employee::find('all', array('related' => array('position'))));
	}
}
