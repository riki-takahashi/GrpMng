<?php
use Orm\Model;
/**
 * 社員マスタモデルクラス
 * Copyright 2014 Riki System Co.,Ltd.
 * @author i-suzuki
 */
class Model_Employee extends Model
{
        /**
         * 項目ID
         * @var type 
         */
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
	
        /**
         * 社員マスタは役職マスタを参照している
         * 　ORM側でオブジェクト間のリレーション定義
         * @var type 
         */
	protected static $_belongs_to = array(
		'position' =>	array(
			'model_to' => 'Model_Position',
			'key_from' => 'position_id',
			'key_to' => 'id',
			'cascade_save' => false,
			'cascade_delete' => false,
	));

        /**
         * グループ所属社員マスタはグループマスタを参照している
         * 　ORM側でオブジェクト間のリレーション定義
         * @var type 
         */
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
            $val->add_callable('ExtraValidationRule');
            
            switch($factory)
            {
                case 'create':
                case 'edit':
                    $val->add_field('emp_name', '社員名', 'required');
                    $val->add_field('emp_kana', '社員名カナ', 'required');
                    $val->add_field('position_id', '役職', 'required|valid_string[numeric]');
                    $val->add_field('mail_address', 'メールアドレス', 'required|valid_email');
                    $val->add_field('invalid_flag', '無効フラグ', 'required|max_length[1]');
                    $val->add_field('is_mng_flag', '物件担当権限', 'required|max_length[1]');
                    break;
                case 'delete':
                    $val->add_field('id', '社員', 'required')
                        ->add_rule('isexists', 'projectmembers', 'emp_id', '案件メンバー情報') //案件メンバー情報と参照整合性チェック
                        ->add_rule('isexists', 'groups', 'main_emp_id', 'グループマスタ') //グループマスタと参照整合性チェック
                        ->add_rule('isexists', 'group_employee', 'emp_id', 'グループ所属社員マスタ') //グループ所属社員マスタと参照整合性チェック
                        ->add_rule('isexists', 'projects', 'emp_id', '案件情報'); //案件情報と参照整合性チェック
                    break;
            }

            return $val;
	}

}
