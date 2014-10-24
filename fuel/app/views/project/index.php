<p  class="pull-right">
	<?php echo Html::anchor('project/create', '<span class="glyphicon glyphicon-plus"></span> 新規登録', array('class' => 'btn btn-primary')); ?>
</p>
<?php if ($projects): ?>

<?php echo Pagination::create_links(); ?>
<div class="table-responsive">
<br>
<br>
<table class="table table-striped table-bordered table-hover table-condensed">
	<thead>
		<tr class="info">
			<th>&nbsp;</th>
<!--　TODO: 未実装
			<th class="text-center">状態</th>
-->
			<th class="text-center">案件名</th>
			<th class="text-center hidden-xs hidden-sm">担当グループ</th>
			<th class="text-center hidden-xs hidden-sm">担当者</th>
			<th class="text-center hidden-xs hidden-sm">開始日</th>
			<th class="text-center hidden-xs hidden-sm">終了日</th>
			<th class="text-center hidden-xs">エンドユーザー</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($projects as $item): ?>
		<tr>
			<td>
                                <?php echo Html::anchor('project/edit/'.$item->id, '<span class="glyphicon glyphicon-pencil"></span>'
                                        , array('class' => 'btn btn-sm btn-primary tipEdit', 'data-toggle' => 'tooltip', 'title' => '案件編集')); ?>
				<?php echo Html::anchor('project/delete/'.$item->id, '<span class="glyphicon glyphicon-remove"></span>'
                                        , array('class' => 'btn btn-sm btn-danger tipDelete', 'data-toggle' => 'tooltip', 'title' => '削除'
                                            , 'onclick' => "return confirm('削除してもよろしいですか？')")); ?>
				<?php echo Html::anchor('project/member/'.$item->id, '<span class="glyphicon glyphicon-user"></span>'
                                        , array('class' => 'btn btn-sm btn-primary tipMember', 'data-toggle' => 'tooltip', 'title' => '案件メンバー登録')); ?>
                                <?php echo Html::anchor('project/sales/'.$item->id, '<span class="glyphicon glyphicon-thumbs-up"></span>'
                                        , array('class' => 'btn btn-sm btn-primary tipSales', 'data-toggle' => 'tooltip', 'title' => '売上実績')); ?>
			</td>
<!--　TODO: 未実装
			<td><?pphp echo $item->project_status; ?></td>
-->
			<td><?php echo $item->project_name; ?></td>
			<td class="hidden-xs hidden-sm"><?php echo isset($item->group->group_name) ? $item->group->group_name : ''; ?></td>
			<td class="hidden-xs hidden-sm"><?php echo isset($item->employee->emp_name) ? $item->employee->emp_name: ''; ?></td>
			<td class="hidden-xs hidden-sm"><?php echo str_replace('-', '/', $item->start_date); ?></td>
			<td class="hidden-xs hidden-sm"><?php echo str_replace('-', '/', $item->end_date); ?></td>
			<td class="hidden-xs"><?php echo $item->end_user; ?></td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>
    
</div>
<?php else: ?>
<p>データがありません</p>
<?php endif; ?>
<p>
	<?php echo Html::anchor('project/search/', '検索画面に戻る'); ?>
</p>