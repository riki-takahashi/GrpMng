<p class="text-right">
    <?php echo Html::anchor('sales/target/create/', '<span class="glyphicon glyphicon-plus"></span> 新規登録', array('class' => 'btn btn-primary')); ?>
</p>
<?php if ($sales_targets): ?>
<?php echo Pagination::create_links(); ?>
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover table-condensed">
	<thead>
		<tr class="info">
			<th>&nbsp;</th>
			<th class="text-center hidden-xs">担当グループ</th>
			<th class="text-center">売上期間</th>
			<th class="text-center hidden-xs hidden-sm">目標売上金額</th>
			<th class="text-center hidden-xs hidden-sm">最低売上金額</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($sales_targets as $item): ?>
                <tr>
			<td>
                                <?php echo Html::anchor('sales/target/edit'
                                        . '?'.Controller_Sales_target::SALES_TARGET_ID.'='.$item->id
                                        . '&'.Controller_Sales_target::GROUP_ID.'='.$group_id
                                        . '&'.Controller_Sales_target::SALES_TERM_ID.'='.$sales_term_id
                                        . '&'.Controller_Sales_target::PAGE.'='.$page
                                        , '<span class="glyphicon glyphicon-pencil"></span> 編集'
                                        , array('class' => 'btn btn-sm btn-primary')); ?>
                            
                                <?php echo Html::anchor('sales/target/delete'
                                        . '?'.Controller_Sales_target::SALES_TARGET_ID.'='.$item->id
                                        . '&'.Controller_Sales_target::GROUP_ID.'='.$group_id
                                        . '&'.Controller_Sales_target::SALES_TERM_ID.'='.$sales_term_id
                                        , '<span class="glyphicon glyphicon-remove"></span> 削除'
                                        , array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('削除してもよろしいですか？')")); ?>
			</td>
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
	<?php echo Html::anchor('sales/target/search', '検索画面に戻る'); ?>
</p>