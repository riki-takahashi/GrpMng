<h3>社員編集</h3>
<br>

<?php echo render('employee/_form'); ?>
<p>
	<?php echo Html::anchor('employee/view/'.$employee->id, '詳細'); ?> |
	<?php echo Html::anchor('employee', '戻る'); ?></p>
