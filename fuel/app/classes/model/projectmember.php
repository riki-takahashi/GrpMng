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

	protected static $_belongs_to = array(
		'employee' => array(
			'model_to' => 'Model_Employee',
			'key_from' => 'emp_id',
			'key_to' => 'id',
			'cascade_save' => false,
			'cascade_delete' => false,
		),
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

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('start_date', '開始日', 'required');
		$val->add_field('end_date', '終了日', 'required');

		return $val;
	}
}
