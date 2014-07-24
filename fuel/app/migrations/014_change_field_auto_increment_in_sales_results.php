<?php

namespace Fuel\Migrations;

class Change_field_auto_increment_in_sales_results
{
	public function up()
	{
		\DBUtil::modify_fields('sales_results', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true)
		));
	}

	public function down()
	{
	\DBUtil::modify_fields('sales_results', array(
			'id' => array('constraint' => 11, 'type' => 'int')
		));
	}
}