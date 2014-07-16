<?php

namespace Fuel\Migrations;

class Create_projects
{
	public function up()
	{
		\DBUtil::create_table('projects', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'project_name' => array('type' => 'text'),
			'group_id' => array('constraint' => 11, 'type' => 'int'),
			'emp_id' => array('constraint' => 11, 'type' => 'int'),
			'start_date' => array('type' => 'date'),
			'end_date' => array('type' => 'date'),
			'order_amount' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'delivery_date' => array('type' => 'date', 'null' => true),
			'sales_date' => array('type' => 'date', 'null' => true),
			'end_user' => array('type' => 'text', 'null' => true),
			'order_user' => array('type' => 'text', 'null' => true),
			'note' => array('type' => 'text', 'null' => true),
			'created_at' => array('type' => 'timestamp', 'null' => true),
			'updated_at' => array('type' => 'timestamp', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('projects');
	}
}