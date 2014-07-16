<h3>グループ一覧</h3>
<br>
<?php if ($groups): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>グループ名</th>
			<th>代表者</th>
			<th>無効フラグ</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($groups as $item): ?>		<tr>

			<td><?php echo $item->group_name; ?></td>
			<td><?php echo $item->employee->emp_name; ?></td>
			<td><?php echo $invalid_label($item->invalid_flag); ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('group/view/'.$item->id, '<i class="icon-eye-open"></i> 詳細', array('class' => 'btn btn-small')); ?>
						<?php echo Html::anchor('group/edit/'.$item->id, '<i class="icon-wrench"></i> 編集', array('class' => 'btn btn-small')); ?>
						<?php echo Html::anchor('group/delete/'.$item->id, '<i class="icon-trash icon-white"></i> 削除', array('class' => 'btn btn-small btn-danger', 'onclick' => "return confirm('削除してもよろしいですか？')")); ?>
					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>データがありません</p>

<?php endif; ?><p>
	<?php echo Html::anchor('group/create', '新規登録', array('class' => 'btn btn-success')); ?>

</p>
