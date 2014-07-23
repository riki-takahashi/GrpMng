<?php

namespace Fuel\Migrations;

class Create_sales_targets
{
	public function up()
	{
		\DBUtil::create_table('sales_targets', array(
			'id' => array('constraint' => 11, 'type' => 'int'),
			'group_id' => array('constraint' => 11, 'type' => 'int'),
			'sales_term_id' => array('constraint' => 11, 'type' => 'int'),
			'target_amount' => array('constraint' => 11, 'type' => 'int'),
			'min_amount' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('sales_targets');
	}
}