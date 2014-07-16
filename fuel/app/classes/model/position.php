<?php
use Orm\Model;

class Model_Position extends Model
{
	protected static $_properties = array(
		'id',
		'position_name',
		'order_no',
		'created_at',
		'updated_at',
	);

	protected static $_belongs_to = array(
		'position' =>	array(
			'model_to' => 'Model_Employee',
			'key_from' => 'id',
			'key_to' => 'position_id',
			'cascade_save' => false,
			'cascade_delete' => false,
	));

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => true,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => true,
		),
	);

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('position_name', '役職名', 'required');
		$val->add_field('order_no', '並び順', 'required|valid_string[numeric]');

		return $val;
	}

}
