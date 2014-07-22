<?php

namespace Fuel\Migrations;

class Create_sales_results
{
	public function up()
	{
		\DBUtil::create_table('sales_results', array(
			'id' => array('constraint' => 11, 'type' => 'int'),
			'project_id' => array('constraint' => 11, 'type' => 'int'),
			'sales_result_name' => array('type' => 'text'),
			'sales_date' => array('type' => 'date'),
			'sales_amount' => array('constraint' => 11, 'type' => 'int'),
			'tax' => array('constraint' => 11, 'type' => 'int'),
			'note' => array('type' => 'text'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('sales_results');
	}
}