<?php
use Orm\Model;
/**
 * グループマスタモデルクラス
 * Copyright 2014 Riki System Co.,Ltd.
 * @author i-suzuki
 */
class Model_Group extends Model
{
        /**
         * 項目ID
         * @var type 
         */
	protected static $_properties = array(
		'id',
		'group_name',
		'group_kana',
		'main_emp_id',
		'invalid_flag',
		'created_at',
		'updated_at',
	);
        
        /**
         * グループマスタは社員マスタを参照している
         * 　ORM側でオブジェクト間のリレーション定義
         * @var type 
         */
	protected static $_belongs_to = array(
		'employee' =>	array(
			'model_to' => 'Model_Employee',
			'key_from' => 'main_emp_id',
			'key_to' => 'id',
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
		$val->add_field('group_name', 'グループ名', 'required');
		$val->add_field('group_kana', 'グループ名カナ', 'required');
		$val->add_field('main_emp_id', '代表者', 'required|valid_string[numeric]');
		$val->add_field('invalid_flag', '無効フラグ', 'required|max_length[1]');

		return $val;
	}

}
