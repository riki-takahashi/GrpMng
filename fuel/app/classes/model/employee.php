<?php
use Orm\Model;

class Model_Employee extends Model
{
	protected static $_properties = array(
		'id',
		'emp_name',
		'emp_kana',
		'position_id',
		'mail_address',
		'invalid_flag',
		'created_at',
		'updated_at',
		'is_mng_flag',
	);
	
	protected static $_belongs_to = array(
		'position' =>	array(
			'model_to' => 'Model_Position',
			'key_from' => 'position_id',
			'key_to' => 'id',
			'cascade_save' => false,
			'cascade_delete' => false,
	));

	protected static $_many_many = array(
		'groups' =>	array(
			'key_from' => 'id',
			'key_through_from' => 'emp_id',
			'table_through' => 'group_employee',
			'key_through_to' => 'group_id',
			'model_to' => 'Model_Group',
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
		$val->add_field('emp_name', '社員名', 'required');
		$val->add_field('emp_kana', '社員名カナ', 'required');
		$val->add_field('position_id', '役職', 'required|valid_string[numeric]');
		$val->add_field('mail_address', 'メールアドレス', 'required|valid_email');
		$val->add_field('invalid_flag', '無効フラグ', 'required|max_length[1]');
		$val->add_field('is_mng_flag', '物件担当権限', 'required|max_length[1]');

		return $val;
	}

}
