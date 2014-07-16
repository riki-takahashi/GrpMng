<h3>グループ詳細</h3>

<p>
	<strong>グループ名:</strong>
	<?php echo $group->group_name; ?></p>
<p>
	<strong>グループ名カナ:</strong>
	<?php echo $group->group_kana; ?></p>
<p>
	<strong>代表者:</strong>
	<?php echo $group->employee->emp_name; ?></p>
<p>
	<strong>無効フラグ:</strong>
	<?php echo $invalid_label($group->invalid_flag); ?></p>

<?php echo Html::anchor('group/edit/'.$group->id, '編集'); ?> |
<?php echo Html::anchor('group', '戻る'); ?>