<?php
use Orm\Model;
/**
 * 売上期間モデルクラス
 * Copyright 2014 Riki System Co.,Ltd.
 * @author i-suzuki
 */
class Model_Sales_Term extends Model
{
        /**
         * 項目ID
         * @var type 
         */
	protected static $_properties = array(
		'id',
		'term_name',
		'start_date',
		'end_date',
		'note',
		'created_at',
		'updated_at',
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
            $val->add_callable('ExtraValidationRule');
            
            switch($factory)
            {
                case 'create':
                case 'edit':
                    $val->add_field('term_name', '売上期間名', 'required');
                    $val->add_field('start_date', '開始日', 'required');
                    $val->add_field('end_date', '終了日', 'required')
                        ->add_rule('enddaterule', 'start_date'); //日付大小関係チェック
                    break;
                case 'delete':
                    $val->add_field('id', '売上期間', 'required')
                        ->add_rule('isexists', 'sales_targets', 'sales_term_id', '売上目標情報'); //売上目標情報と参照整合性チェック
                    break;
            }

            return $val;
	}
     
}
