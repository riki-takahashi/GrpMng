<?php
use Orm\Model;

class Model_Project extends Model
{
	protected static $_properties = array(
		'id',
		'project_name',
		'group_id',
		'emp_id',
		'start_date',
		'end_date',
		'order_amount',
		'delivery_date',
		'sales_date',
		'end_user',
		'order_user',
		'note',
		'created_at',
		'updated_at',
	);

	protected static $_belongs_to = array(
		'group' => array(
			'model_to' => 'Model_Group',
			'key_from' => 'group_id',
			'key_to' => 'id',
			'cascade_save' => false,
			'cascade_delete' => false,
		),
		'employee' => array(
			'model_to' => 'Model_Employee',
			'key_from' => 'emp_id',
			'key_to' => 'id',
			'cascade_save' => false,
			'cascade_delete' => false,
		),
	);
	
	protected static $_has_many = array(
		'members' => array(
			'model_to' => 'Model_Projectmember',
			'key_from' => 'id',
			'key_to' => 'project_id',
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
			'events' => array('before_save'),
			'mysql_timestamp' => true,
		),
	);

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('project_name', '案件名', 'required');
		$val->add_field('group_id', '担当グループ', 'required|valid_string[numeric]');
		$val->add_field('emp_id', '担当者', 'required|valid_string[numeric]');
		$val->add_field('start_date', '開始日', 'required');
		$val->add_field('end_date', '終了日', 'required');
		$val->add_field('order_amount', '受注金額', 'valid_string[numeric]');

		return $val;
	}

}
