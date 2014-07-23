<?php
use Orm\Model;

class Model_Sales_Result extends Model
{
	protected static $_properties = array(
		'id',
		'project_id',
		'sales_result_name',
		'sales_date',
		'sales_amount',
		'tax',
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
			'events' => array('before_save'),
			'mysql_timestamp' => true,
		),
	);

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('project_id', '案件ID', 'required|valid_string[numeric]');
		$val->add_field('sales_result_name', '売上実績名', 'required');
		$val->add_field('sales_date', '売上日', 'required');
		$val->add_field('sales_amount', '売上金額', 'required|valid_string[numeric]');
		$val->add_field('tax', '消費税', 'required|valid_string[numeric]');
		$val->add_field('note', '備考', '');

		return $val;
	}

}
