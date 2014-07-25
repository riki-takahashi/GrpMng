<?php
use Orm\Model;

class Model_Sales_Target extends Model
{
	protected static $_properties = array(
		'id',
		'group_id',
		'sales_term_id',
		'target_amount',
		'min_amount',
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
		'sales_term' => array(
			'model_to' => 'Model_Sales_Term',
			'key_from' => 'sales_term_id',
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
			'events' => array('before_save'),
			'mysql_timestamp' => true,
		),
	);

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('group_id', 'グループID', 'required|valid_string[numeric]');
		$val->add_field('sales_term_id', '売上期間', 'required|valid_string[numeric]');
		$val->add_field('target_amount', '目標売上金額', 'required|valid_string[numeric]');
		$val->add_field('min_amount', '最低売上金額', 'required|valid_string[numeric]');

		return $val;
	}

}
