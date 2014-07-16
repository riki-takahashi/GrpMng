<p>
	<strong>案件名:</strong>
	<?php echo $project->project_name; ?></p>
<p>
	<strong>担当グループ:</strong>
	<?php echo $project->group->group_name; ?></p>
<p>
	<strong>担当者:</strong>
	<?php echo $project->employee->emp_name; ?></p>
<p>
	<strong>開始日:</strong>
	<?php echo $project->start_date; ?></p>
<p>
	<strong>終了日:</strong>
	<?php echo $project->end_date; ?></p>
<p>
	<strong>受注金額:</strong>
	<?php echo $project->order_amount; ?></p>
<p>
	<strong>納品日:</strong>
	<?php echo $project->delivery_date; ?></p>
<p>
	<strong>売上日:</strong>
	<?php echo $project->sales_date; ?></p>
<p>
	<strong>エンドユーザー:</strong>
	<?php echo $project->end_user; ?></p>
<p>
	<strong>受注元:</strong>
	<?php echo $project->order_user; ?></p>
<p>
	<strong>備考:</strong>
	<?php echo $project->note; ?></p>

<?php echo Html::anchor('project/edit/'.$project->id, '編集'); ?> |
<?php echo Html::anchor('project', '戻る'); ?>