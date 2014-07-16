<?php

class Model_Projectmember extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'project_id',
		'emp_id',
		'start_date',
		'end_date',
		'note',
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => true,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_update'),
			'mysql_timestamp' => true,
		),
	);

}
