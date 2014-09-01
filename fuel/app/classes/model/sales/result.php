<?php
use Orm\Model;
/**
 * 売上実績モデルクラス
 * Copyright 2014 Riki System Co.,Ltd.
 * @author i-suzuki
 */
class Model_Sales_Result extends Model
{
        /**
         * 項目ID
         * @var type 
         */
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

        /**
         * 売上実績情報は案件情報を参照している
         * 　ORM側でオブジェクト間のリレーション定義
         * @var type 
         */
	protected static $_belongs_to = array(
		'project' => array(
			'model_to' => 'Model_Project',
			'key_from' => 'project_id',
			'key_to' => 'id',
			'cascade_save' => false,
			'cascade_delete' => false,
		),
	);
        
        /**
         * タイムスタンプの自動更新を有効化
         * @var type 
         */
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
        
        /**
         * バリデーションルール設定
         * @param type $factory
         * @return type
         */
	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('sales_result_name', '売上実績名', 'required');
		$val->add_field('sales_date', '売上日', 'required');
		$val->add_field('sales_amount', '売上金額', 'required|valid_string[numeric]');
		$val->add_field('tax', '消費税', 'required|valid_string[numeric]');

		return $val;
	}
}
