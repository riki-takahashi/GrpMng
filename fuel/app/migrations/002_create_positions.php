<?php

namespace Fuel\Migrations;

class Create_positions
{
	public function up()
	{
		\DBUtil::create_table('positions', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'position_name' => array('type' => 'text'),
			'order_no' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('type' => 'timestamp', 'null' => true),
			'updated_at' => array('type' => 'timestamp', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('positions');
	}
}