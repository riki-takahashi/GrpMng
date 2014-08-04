<?php
use Orm\Model;

class Model_Projectsearch extends Model
{
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
