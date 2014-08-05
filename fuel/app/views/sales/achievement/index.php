<?php if ($sales_targets): ?>
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover table-condensed">
	<thead>
		<tr class="info">
			<th class="text-center hidden-xs">担当グループ</th>
			<th class="text-center">売上期間</th>
			<th class="text-center hidden-xs hidden-sm">目標売上金額</th>
			<th class="text-center hidden-xs hidden-sm">最低売上金額</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($sales_targets as $item): ?>
                <tr>
                        <td class="hidden-xs"><?php echo $item->group->group_name; ?></td>
                        <td><?php echo $item->sales_term->term_name; ?></td>
                        <td class="hidden-xs hidden-sm"><?php echo $item->target_amount; ?></td>
                        <td class="hidden-xs hidden-sm"><?php echo $item->min_amount; ?></td>
                </tr>
<?php endforeach; ?>	</tbody>
</table>
</div>
<?php else: ?>
<p>データがありません</p>
<?php endif; ?>
<p>
	<?php echo Html::anchor('sales/achievement/search', '検索画面に戻る'); ?>
</p>