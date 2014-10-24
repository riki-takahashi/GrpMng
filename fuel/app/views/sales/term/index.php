<p class="text-right">
	<?php echo Html::anchor('sales/term/create', '<span class="glyphicon glyphicon-plus"></span> 新規登録', array('class' => 'btn btn-primary')); ?>
</p>
<?php if ($sales_terms): ?>
<table class="table table-striped table-bordered table-hover table-condensed">
	<thead>
		<tr class="info">
			<th>&nbsp;</th>
			<th class="text-center">売上期間名</th>
			<th class="text-center">開始日</th>
			<th class="text-center">終了日</th>
			<th class="text-center">備考</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($sales_terms as $item): ?>		<tr>

			<td>
                                <?php echo Html::anchor('sales/term/edit/'.$item->id, '<span class="glyphicon glyphicon-pencil"></span>'
                                        , array('class' => 'btn btn-sm btn-primary', 'data-toggle' => 'tooltip', 'title' => '編集')); ?>
                                <?php echo Html::anchor('sales/term/delete/'.$item->id, '<span class="glyphicon glyphicon-remove"></span>'
                                        , array('class' => 'btn btn-sm btn-danger', 'data-toggle' => 'tooltip', 'title' => '削除'
                                            , 'onclick' => "return confirm('削除してもよろしいですか？')")); ?>
			</td>
			<td><?php echo $item->term_name; ?></td>
                        <td><?php echo str_replace('-', '/', $item->start_date); ?></td>
			<td><?php echo str_replace('-', '/', $item->end_date); ?></td>
			<td><?php echo $item->note; ?></td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>データがありません</p>

<?php endif; ?>
