<?php

namespace Fuel\Migrations;

class Create_sales_terms
{
	public function up()
	{
		\DBUtil::create_table('sales_terms', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'term_name' => array('type' => 'text'),
			'start_date' => array('type' => 'date'),
			'end_date' => array('type' => 'date'),
			'note' => array('type' => 'text', 'null' => true),
			'created_at' => array('type' => 'timestamp', 'null' => true),
			'updated_at' => array('type' => 'timestamp', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('sales_terms');
	}
}