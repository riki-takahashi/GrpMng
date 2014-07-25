<p  class="pull-right">
	<?php echo Html::anchor('project/create', '<span class="glyphicon glyphicon-plus"></span> 新規登録', array('class' => 'btn btn-primary')); ?>
</p>
<?php if ($projects): ?>
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover table-condensed">
	<thead>
		<tr class="info">
			<th>&nbsp;</th>
			<th class="text-center">案件名</th>
			<th class="text-center">担当グループ</th>
			<th class="text-center">担当者</th>
			<th class="text-center">開始日</th>
			<th class="text-center">終了日</th>
			<th class="text-center">エンドユーザー</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($projects as $item): ?>
		<tr>
			<td>
				<?php echo Html::anchor('project/edit/'.$item->id, '<span class="glyphicon glyphicon-pencil"></span> 編集', array('class' => 'btn btn-sm btn-primary')); ?>
				<?php echo Html::anchor('project/delete/'.$item->id, '<span class="glyphicon glyphicon-remove"></span> 削除', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('削除してもよろしいですか？')")); ?>
				<?php echo Html::anchor('project/member/'.$item->id, '<span class="glyphicon glyphicon-user"></span> メンバー', array('class' => 'btn btn-sm btn-primary')); ?>
				<?php echo Html::anchor('project/sales/'.$item->id, '<span class="glyphicon glyphicon-thumbs-up"></span> 売上実績', array('class' => 'btn btn-sm btn-primary')); ?>
			</td>
			<td><?php echo $item->project_name; ?></td>
			<td><?php echo $item->group->group_name; ?></td>
			<td><?php echo $item->employee->emp_name; ?></td>
			<td><?php echo $item->start_date; ?></td>
			<td><?php echo $item->end_date; ?></td>
			<td><?php echo $item->end_user; ?></td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>
</div>
<?php else: ?>
<p>データがありません</p>
<?php endif; ?>
