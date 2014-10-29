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
	//状態　（ID、名称、cssスタイルクラス名、背景色）
	'status' => array(
		array('id' => 1, 'name' => '引合', 'style' => 'hikiai', 'background-color' => '#000000'),
		array('id' => 2, 'name' => '見積', 'style' => 'mitsumori', 'background-color' => '#18bc9c'),
		array('id' => 3, 'name' => '受注', 'style' => 'juchu', 'background-color' => '#f39c12'),
		array('id' => 4, 'name' => '売上', 'style' => 'uriage', 'background-color' => '#428bca'),
	),
);