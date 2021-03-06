<?php

namespace Fuel\Migrations;

class Change_field_type_to_timestamp_in_sales_results
{
	public function up()
	{
		\DBUtil::modify_fields('sales_results', array(
			'created_at' => array('type' => 'timestamp', 'null' => true),
			'updated_at' => array('type' => 'timestamp', 'null' => true)
		));
	}

	public function down()
	{
	\DBUtil::modify_fields('sales_results', array(
			'created_at' => array('type' => 'int', 'null' => true),
			'updated_at' => array('type' => 'int', 'null' => true)
		));
	}
}