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
			'est_amount' => array('constraint' => 11, 'type' => 'int'),
			'order_amount' => array('constraint' => 11, 'type' => 'int'),
			'delivery_date' => array('type' => 'date'),
			'sales_date' => array('type' => 'date'),
			'end_user' => array('type' => 'text'),
			'order_user' => array('type' => 'text'),
			'note' => array('type' => 'text'),
			'created_at' => array('type' => 'date', 'null' => true),
			'updated_at' => array('type' => 'date', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('projects');
	}
}