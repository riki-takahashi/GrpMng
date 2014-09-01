<?php
use Orm\Model;
/**
 * 売上目標モデルクラス
 * Copyright 2014 Riki System Co.,Ltd.
 * @author i-suzuki
 */
class Model_Sales_Target extends Model
{
        /**
         * 項目ID
         * @var type 
         */
	protected static $_properties = array(
		'id',
		'group_id',
		'sales_term_id',
		'target_amount',
		'min_amount',
		'created_at',
		'updated_at',
	);

        /**
         * 売上目標情報はグループマスタを参照している
         * また売上目標情報は売上対象期間情報を参照している
         * 　ORM側でオブジェクト間のリレーション定義
         * @var type 
         */
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
		$val->add_field('group_id', 'グループID', 'required|valid_string[numeric]');
		$val->add_field('sales_term_id', '売上期間', 'required|valid_string[numeric]');
		$val->add_field('target_amount', '目標売上金額', 'required|valid_string[numeric]');
		$val->add_field('min_amount', '最低売上金額', 'required|valid_string[numeric]');

		return $val;
	}

}
