<p class="text-right">
	<?php echo Html::anchor('sales/target/create', '<span class="glyphicon glyphicon-plus"></span> 新規登録', array('class' => 'btn btn-success')); ?>
</p>
<?php if ($sales_targets): ?>
<table class="table table-striped table-bordered table-hover table-condensed">
	<thead>
		<tr class="info">
			<th class="text-center">&nbsp;</th>
			<th class="text-center">グループID</th>
			<th class="text-center">売上対象期間ID</th>
			<th class="text-center">目標売上金額</th>
			<th class="text-center">最低売上金額</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($sales_targets as $item): ?>
                <tr>
			<td>
                                <?php echo Html::anchor('sales/target/edit/'.$item->id, '<span class="glyphicon glyphicon-pencil"></span> 編集', array('class' => 'btn btn-sm btn-primary')); ?>
                                <?php echo Html::anchor('sales/target/delete/'.$item->id, '<span class="glyphicon glyphicon-remove"></span> 削除', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('削除してもよろしいですか？')")); ?>
			</td>
                        <td><?php echo $item->group_id; ?></td>
                        <td><?php echo $item->sales_term_id; ?></td>
                        <td><?php echo $item->target_amount; ?></td>
                        <td><?php echo $item->min_amount; ?></td>
                </tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>データがありません</p>

<?php endif; ?>