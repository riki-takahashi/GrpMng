<?php
use Orm\Model;
/**
 * 検索画面用モデルクラス
 * 　画面にFieldSetを使用しているため、関連情報をモデル内に定義しています。
 * Copyright 2014 Riki System Co.,Ltd.
 * @author i-suzuki
 */
class Model_Projectsearch extends Model
{
        /**
         * 項目ID
         * @var type 
         */
	protected static $_properties = array(
		'id',
		'project_status' => array(
                    'data_type' => 'varchar',
                    'label' => array(
                                'label' => '状態',
                                'class' => 'control-label',
                                'for' => 'form_project_status',
                            ),
                    'form' => array(
                                'type' => 'select',
                                'class' => 'form-control',
                            ),
                ),            
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
		'start_date_from' => array(
                    'data_type' => 'varchar',
                    'label' => array(
                                'label' => '開始日',
                                'class' => 'control-label',
                                'for' => 'form_start_date_from',
                            ),
                    'form' => array(
                                'type' => 'text',
                                'class' => 'form-control dp',
                                'placeholder' => '開始日　自',
                            ),
                ),
		'start_date_to' => array(
                    'data_type' => 'varchar',
                    'label' => array(
                                'label' => '開始日',
                                'class' => 'control-label',
                                'for' => 'form_start_date_to',
                            ),
                    'form' => array(
                                'type' => 'text',
                                'class' => 'form-control dp',
                                'placeholder' => '開始日　至',
                            ),
                ),
		'end_date_from' => array(
                    'data_type' => 'varchar',
                    'label' => array(
                                'label' => '終了日',
                                'class' => 'control-label',
                                'for' => 'form_end_date_from',
                            ),
                    'form' => array(
                                'type' => 'text',
                                'class' => 'form-control dp',
                                'placeholder' => '終了日　自',
                            ),
                ),
		'end_date_to' => array(
                    'data_type' => 'varchar',
                    'label' => array(
                                'label' => '終了日',
                                'class' => 'control-label',
                                'for' => 'form_end_date_to',
                            ),
                    'form' => array(
                                'type' => 'text',
                                'class' => 'form-control dp',
                                'placeholder' => '終了日　至',
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
		'delivery_date_from' => array(
                    'data_type' => 'varchar',
                    'label' => array(
                                'label' => '納品日',
                                'class' => 'control-label',
                                'for' => 'form_delivery_date_from',
                            ),
                    'form' => array(
                                'type' => 'text',
                                'class' => 'form-control dp',
                                'placeholder' => '納品日　自',
                            ),
                ),
		'delivery_date_to' => array(
                    'data_type' => 'varchar',
                    'label' => array(
                                'label' => '納品日',
                                'class' => 'control-label',
                                'for' => 'form_delivery_date_to',
                            ),
                    'form' => array(
                                'type' => 'text',
                                'class' => 'form-control dp',
                                'placeholder' => '納品日　至',
                            ),
                ),
		'sales_date_from' => array(
                    'data_type' => 'varchar',
                    'label' => array(
                                'label' => '売上日',
                                'class' => 'control-label',
                                'for' => 'form_sales_date_from',
                            ),
                    'form' => array(
                                'type' => 'text',
                                'class' => 'form-control dp',
                                'placeholder' => '売上日　自',
                            ),
                ),
		'sales_date_to' => array(
                    'data_type' => 'varchar',
                    'label' => array(
                                'label' => '売上日',
                                'class' => 'control-label',
                                'for' => 'form_sales_date_to',
                            ),
                    'form' => array(
                                'type' => 'text',
                                'class' => 'form-control dp',
                                'placeholder' => '売上日　至',
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
         * 案件マスタ検索条件のグループはグループマスタを参照している
         * また案件マスタ検索条件の担当者は社員マスタを参照している
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

}
