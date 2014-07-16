<?php

namespace Fuel\Migrations;

class Create_employees
{
	public function up()
	{
		\DBUtil::create_table('employees', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'emp_name' => array('type' => 'text'),
			'emp_kana' => array('type' => 'text'),
			'position_id' => array('constraint' => 11, 'type' => 'int'),
			'mail_address' => array('type' => 'text'),
			'invalid_flag' => array('constraint' => 1, 'type' => 'char'),
			'created_at' => array('type' => 'timestamp', 'null' => true),
			'updated_at' => array('type' => 'timestamp', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('employees');
	}
}