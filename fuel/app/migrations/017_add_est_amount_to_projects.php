<?php

namespace Fuel\Migrations;

class Add_est_amount_to_projects
{
	public function up()
	{
		\DBUtil::add_fields('projects', array(
			'est_amount' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('projects', array(
			'est_amount'

		));
	}
}