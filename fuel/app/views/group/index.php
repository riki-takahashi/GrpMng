<p  class="text-right">
	<?php echo Html::anchor('group/create', '<span class="glyphicon glyphicon-plus"></span> 新規登録', array('class' => 'btn btn-primary')); ?>
</p>
<?php if ($groups): ?>
<table class="table table-striped table-bordered table-hover table-condensed">
	<thead>
		<tr class="info">
			<th class="text-center">&nbsp;</th>
			<th class="text-center">グループ名</th>
			<th class="text-center">代表者</th>
			<th class="text-center">無効フラグ</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($groups as $item): ?>		<tr>

			<td>
				<?php echo Html::anchor('group/edit/'.$item->id, '<span class="glyphicon glyphicon-pencil"></span> 編集', array('class' => 'btn btn-sm btn-primary')); ?>	
				<?php echo Html::anchor('group/delete/'.$item->id, '<span class="glyphicon glyphicon-remove"></span> 削除', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('削除してもよろしいですか？')")); ?>
			</td>
			<td><?php echo $item->group_name; ?></td>
			<td><?php echo $item->employee->emp_name; ?></td>
			<td><?php echo $invalid_label($item->invalid_flag); ?></td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>データがありません</p>

<?php endif; ?>
