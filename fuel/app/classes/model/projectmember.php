<?php
/**
 * 案件メンバーモデルクラス
 * Copyright 2014 Riki System Co.,Ltd.
 * @author i-suzuki
 */
class Model_Projectmember extends \Orm\Model
{
        /**
         * 項目ID
         * @var type 
         */
	protected static $_properties = array(
		'id',
		'project_id',
		'emp_id',
		'start_date',
		'end_date',
		'note',
		'created_at',
		'updated_at',
	);

        /**
         * 案件メンバーは社員マスタを参照している
         * 　ORM側でオブジェクト間のリレーション定義
         * @var type 
         */
	protected static $_belongs_to = array(
		'employee' => array(
			'model_to' => 'Model_Employee',
			'key_from' => 'emp_id',
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
			'events' => array('before_update'),
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
                $val->add_callable('ExtraValidationRule');
                
		$val->add_field('start_date', '開始日', 'required');
                
		$val->add_field('end_date', '終了日', 'required')
                    ->add_rule('enddaterule', 'start_date');

		return $val;
	}
}
