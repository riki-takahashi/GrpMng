<?php

namespace Fuel\Migrations;

class Create_group_employee
{
	public function up()
	{
		\DBUtil::create_table('group_employee', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'group_id' => array('constraint' => 11, 'type' => 'int'),
			'emp_id' => array('constraint' => 11, 'type' => 'int'),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('group_employee');
	}
}