<h3>社員マスタ詳細</h3>
<p>
	<strong>社員名:</strong>
	<?php echo $employee->emp_name; ?></p>
<p>
	<strong>社員名カナ:</strong>
	<?php echo $employee->emp_kana; ?></p>
<p>
	<strong>役職:</strong>
	<?php echo $employee->position->position_name; ?></p>
<p>
	<strong>所属グループ:</strong>
	<?php if ($employee->groups) : ?>
		<?php $count = 0; ?>
		<?php foreach($employee->groups as $group) : ?>
			<?php if($count > 0) : ?>，<?php endif; ?>
			<?php echo $group->group_name; ?>
			<?php $count++; ?>
		<?php endforeach; ?>
	<?php endif; ?></p>
<p>
	<strong>メールアドレス:</strong>
	<?php echo $employee->mail_address; ?></p>
<p>
	<strong>物件担当権限:</strong>
	<?php echo $is_mng_label($employee->is_mng_flag); ?></p>
<p>
	<strong>無効フラグ:</strong>
	<?php echo $invalid_label($employee->invalid_flag); ?></p>

<?php echo Html::anchor('employee/edit/'.$employee->id, '編集'); ?> |
<?php echo Html::anchor('employee', '戻る'); ?>