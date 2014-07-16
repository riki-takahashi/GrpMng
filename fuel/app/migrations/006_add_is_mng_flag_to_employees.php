<?php

namespace Fuel\Migrations;

class Add_is_mng_flag_to_employees
{
	public function up()
	{
		\DBUtil::add_fields('employees', array(
			'is_mng_flag' => array('constraint' => 1, 'type' => 'char'),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('employees', array(
			'is_mng_flag'

		));
	}
}