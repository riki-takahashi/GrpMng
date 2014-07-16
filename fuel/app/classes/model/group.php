<?php
use Orm\Model;

class Model_Group extends Model
{
	protected static $_properties = array(
		'id',
		'group_name',
		'group_kana',
		'main_emp_id',
		'invalid_flag',
		'created_at',
		'updated_at',
	);

	protected static $_belongs_to = array(
		'employee' =>	array(
			'model_to' => 'Model_Employee',
			'key_from' => 'main_emp_id',
			'key_to' => 'id',
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
		$val->add_field('group_name', 'グループ名', 'required');
		$val->add_field('group_kana', 'グループ名カナ', 'required');
		$val->add_field('main_emp_id', '代表者', 'required|valid_string[numeric]');
		$val->add_field('invalid_flag', '無効フラグ', 'required|max_length[1]');

		return $val;
	}

}
