<h2>役職編集</h2>
<br>

<?php echo render('position/_form'); ?>
<p>
	<?php echo Html::anchor('position/view/'.$position->id, '詳細'); ?> |
	<?php echo Html::anchor('position', '戻る'); ?></p>
