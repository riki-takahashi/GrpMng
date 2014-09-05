<?php

namespace Fuel\Migrations;

class Delete_tax_from_sales_results
{
	public function up()
	{
		\DBUtil::drop_fields('sales_results', array(
			'tax'

		));
	}

	public function down()
	{
		\DBUtil::add_fields('sales_results', array(
			'tax' => array('constraint' => 11, 'type' => 'int'),

		));
	}
}