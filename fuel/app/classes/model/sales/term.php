<?php
use Orm\Model;

class Model_Sales_Term extends Model
{
	protected static $_properties = array(
		'id',
		'term_name',
		'start_date',
		'end_date',
		'note',
		'created_at',
		'updated_at',
	);

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
                        ->add_rule('isexists', 'sales_targets', 'sales_term_id'); //参照整合性チェック
                    break;
            }

            return $val;
	}
     
}
