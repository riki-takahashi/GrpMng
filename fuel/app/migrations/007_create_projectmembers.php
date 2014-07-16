<?php

namespace Fuel\Migrations;

class Create_projectmembers
{
	public function up()
	{
		\DBUtil::create_table('projectmembers', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'project_id' => array('constraint' => 11, 'type' => 'int'),
			'emp_id' => array('constraint' => 11, 'type' => 'int'),
			'start_date' => array('type' => 'date'),
			'end_date' => array('type' => 'date'),
			'note' => array('type' => 'text', 'null' => true),
			'created_at' => array('type' => 'timestamp', 'null' => true),
			'updated_at' => array('type' => 'timestamp', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('projectmembers');
	}
}