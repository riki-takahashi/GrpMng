<?php
use Orm\Model;
/**
 * 案件モデルクラス
 * 　画面にFieldSetを使用しているため、関連情報をモデル内に定義しています。
 * Copyright 2014 Riki System Co.,Ltd.
 * @author i-suzuki
 */
class Model_Project extends Model
{
        /**
         * 項目ID
         * @var type 
         */
	protected static $_properties = array(
		'id',
		'project_name' => array(
                    'data_type' => 'varchar',
                    'label' => array(
                                'label' => '案件名',
                                'class' => 'control-label',
                                'for' => 'form_project_name',
                            ),
                    'form' => array(
                                'type' => 'text',
                                'class' => 'form-control',
                                'placeholder' => '案件名',
                            ),
                ),
		'group_id' => array(
                    'data_type' => 'varchar',
                    'label' => array(
                                'label' => '担当グループ',
                                'class' => 'control-label',
                                'for' => 'form_group_id',
                            ),
                    'form' => array(
                                'type' => 'select',
                                'class' => 'form-control',
                            ),
                ),
		'emp_id' => array(
                    'data_type' => 'varchar',
                    'label' => array(
                                'label' => '担当者',
                                'class' => 'control-label',
                                'for' => 'form_emp_id',
                            ),
                    'form' => array(
                                'type' => 'select',
                                'class' => 'form-control',
                            ),
                ),
		'start_date' => array(
                    'data_type' => 'varchar',
                    'label' => array(
                                'label' => '開始日',
                                'class' => 'control-label',
                                'for' => 'form_start_date',
                            ),
                    'form' => array(
                                'type' => 'text',
                                'class' => 'form-control dp',
                                'placeholder' => '開始日',
                            ),
                ),
		'end_date' => array(
                    'data_type' => 'varchar',
                    'label' => array(
                                'label' => '終了日',
                                'class' => 'control-label',
                                'for' => 'form_end_date',
                            ),
                    'form' => array(
                                'type' => 'text',
                                'class' => 'form-control dp',
                                'placeholder' => '終了日',
                            ),
                ),
		'order_amount' => array(
                    'data_type' => 'varchar',
                    'label' => array(
                                'label' => '受注金額',
                                'class' => 'control-label',
                                'for' => 'form_order_amount',
                            ),
                    'form' => array(
                                'type' => 'text',
                                'class' => 'form-control',
                                'placeholder' => '受注金額',
                            ),
                ),
		'delivery_date' => array(
                    'data_type' => 'varchar',
                    'label' => array(
                                'label' => '納品日',
                                'class' => 'control-label',
                                'for' => 'form_delivery_date',
                            ),
                    'form' => array(
                                'type' => 'text',
                                'class' => 'form-control dp',
                                'placeholder' => '納品日',
                            ),
                ),
		'sales_date' => array(
                    'data_type' => 'varchar',
                    'label' => array(
                                'label' => '売上日',
                                'class' => 'control-label',
                                'for' => 'form_sales_date',
                            ),
                    'form' => array(
                                'type' => 'text',
                                'class' => 'form-control dp',
                                'placeholder' => '売上日',
                            ),
                ),
		'end_user' => array(
                    'data_type' => 'varchar',
                    'label' => array(
                                'label' => 'エンドユーザー',
                                'class' => 'control-label',
                                'for' => 'form_end_user',
                            ),
                    'form' => array(
                                'type' => 'text',
                                'class' => 'form-control',
                                'placeholder' => 'エンドユーザー',
                            ),
                ),
		'order_user' => array(
                    'data_type' => 'varchar',
                    'label' => array(
                                'label' => '受注元',
                                'class' => 'control-label',
                                'for' => 'form_order_user',
                            ),
                    'form' => array(
                                'type' => 'text',
                                'class' => 'form-control',
                                'placeholder' => '受注元',
                            ),
                ),
		'note' => array(
                    'data_type' => 'varchar',
                    'label' => array(
                                'label' => '備考',
                                'class' => 'control-label',
                                'for' => 'form_note',
                            ),
                    'form' => array(
                                'type' => 'text',
                                'class' => 'form-control',
                                'placeholder' => '備考',
                            ),
                ),
		'created_at',
		'updated_at',
	);

        /**
         * 案件マスタはグループマスタを参照している
         * また案件マスタは社員マスタを参照している
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
		'employee' => array(
			'model_to' => 'Model_Employee',
			'key_from' => 'emp_id',
			'key_to' => 'id',
			'cascade_save' => false,
			'cascade_delete' => false,
		),
	);
	
        /**
         * 案件マスタは案件メンバーから参照されている
         * また案件マスタは売上実績から参照されている
         * 　ORM側でオブジェクト間のリレーション定義
         * @var type 
         */
	protected static $_has_many = array(
		'members' => array(
			'model_to' => 'Model_Projectmember',
			'key_from' => 'id',
			'key_to' => 'project_id',
			'cascade_save' => false,
			'cascade_delete' => false,
		),
		'results' => array(
			'model_to' => 'Model_Sales_Result',
			'key_from' => 'id',
			'key_to' => 'project_id',
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
         * バリデーションチェックルール設定
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
                    $val->add_field('project_name', '案件名', 'required');
                    $val->add_field('group_id', '担当グループ', 'required|valid_string[numeric]');
                    $val->add_field('emp_id', '担当者', 'required|valid_string[numeric]');
                    $val->add_field('start_date', '開始日', 'required');
                    $val->add_field('end_date', '終了日', 'required')
                        ->add_rule('enddaterule', 'start_date');
                    $val->add_field('order_amount', '受注金額', 'valid_string[numeric]');
                    break;
                case 'delete':
                    $val->add_field('id', '案件', 'required')
                        ->add_rule('isexists', 'sales_results', 'project_id', '売上実績情報'); //売上実績情報と参照整合性チェック
                    break;
            }

            return $val;
	}

}
