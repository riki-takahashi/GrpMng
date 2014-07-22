<h3>グループ編集</h3>
<br>

<?php echo render('group/_form'); ?>
<p>
	<?php echo Html::anchor('group/view/'.$group->id, '詳細'); ?> |
	<?php echo Html::anchor('group', '戻る'); ?></p>
