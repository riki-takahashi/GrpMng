<?php
//コード値の一覧
return array(
	//無効フラグ
	'invalid_flag' => array(
		0 => '有効',
		1 => '無効',
	),
	//物件担当権限フラグ
	'is_mng_flag' => array(
		0 => 'なし',
		1 => 'あり',
	),
	//状態
	'status' => array(
		0 => '',
		1 => '引合',
		2 => '見積',
		3 => '受注',
		4 => '売上',
	),
	//状態のcssスタイルクラス名
	'style_status' => array(
		0 => '',
		1 => 'hikiai',
		2 => 'mitsumori',
		3 => 'juchu',
		4 => 'uriage',
	),
);