<?php

namespace Fuel\Migrations;

class Create_groups
{
	public function up()
	{
		\DBUtil::create_table('groups', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'group_name' => array('type' => 'text'),
			'group_kana' => array('type' => 'text'),
			'main_emp_id' => array('constraint' => 11, 'type' => 'int'),
			'invalid_flag' => array('constraint' => 1, 'type' => 'char'),
			'created_at' => array('type' => 'timestamp', 'null' => true),
			'updated_at' => array('type' => 'timestamp', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('groups');
	}
}