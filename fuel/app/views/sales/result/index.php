<p class="text-right">
	<?php echo Html::anchor('sales/result/create', '<span class="glyphicon glyphicon-plus"></span> 新規登録', array('class' => 'btn btn-primary')); ?>
</p>
<?php if ($sales_results): ?>
<table class="table table-striped table-bordered table-hover table-condensed">
	<thead>
		<tr class="info">
			<th class="text-center">&nbsp;</th>
			<th class="text-center">案件ID</th>
			<th class="text-center">売上実績名</th>
			<th class="text-center">売上日</th>
			<th class="text-center">売上金額</th>
			<th class="text-center">消費税</th>
			<th class="text-center">備考</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($sales_results as $item): ?>
                <tr>
			<td>
                                <?php echo Html::anchor('sales/result/edit/'.$item->id, '<span class="glyphicon glyphicon-pencil"></span> 編集', array('class' => 'btn btn-sm btn-primary')); ?>
                                <?php echo Html::anchor('sales/result/delete/'.$item->id, '<span class="glyphicon glyphicon-remove"></span> 削除', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('削除してもよろしいですか？')")); ?>
			</td>
			<td><?php echo $item->project_id; ?></td>
			<td><?php echo $item->sales_result_name; ?></td>
			<td><?php echo $item->sales_date; ?></td>
			<td><?php echo $item->sales_amount; ?></td>
			<td><?php echo $item->tax; ?></td>
			<td><?php echo $item->note; ?></td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>データがありません</p>

<?php endif; ?>
