<?php
use Orm\Model;
/**
 * 役職マスタモデルクラス
 * Copyright 2014 Riki System Co.,Ltd.
 * @author i-suzuki
 */
class Model_Position extends Model
{
        /**
         * 項目ID
         * @var type 
         */
	protected static $_properties = array(
		'id',
		'position_name',
		'order_no',
		'created_at',
		'updated_at',
	);

        /**
         * 役職マスタは社員マスタを参照している
         * 　ORM側でオブジェクト間のリレーション定義
         * @var type 
         */
	protected static $_belongs_to = array(
		'position' =>	array(
			'model_to' => 'Model_Employee',
			'key_from' => 'id',
			'key_to' => 'position_id',
			'cascade_save' => false,
			'cascade_delete' => false,
	));

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
		$val->add_field('position_name', '役職名', 'required');
		$val->add_field('order_no', '並び順', 'required|valid_string[numeric]');

		return $val;
	}

}
