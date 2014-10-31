<p class="text-right">
	<?php echo Html::anchor('position/create', '<span class="glyphicon glyphicon-plus"></span> 新規登録', array('class' => 'btn btn-primary')); ?>
</p>
<?php if ($positions): ?>
<table class="table table-striped table-bordered table-hover table-condensed">
	<thead>
		<tr class="info">
			<th class="text-center">&nbsp;</th>
			<th class="text-center">役職名</th>
			<th class="text-center">並び順</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($positions as $item): ?>		<tr>

			<td class="minimum-width">
                            <?php echo Html::anchor('position/edit/'.$item->id, '<span class="glyphicon glyphicon-pencil"></span>'
                                    , array('class' => 'btn btn-sm btn-primary', 'data-toggle' => 'tooltip', 'title' => '編集')); ?>					
                            <?php echo Html::anchor('position/delete/'.$item->id, '<span class="glyphicon glyphicon-remove"></span>'
                                    , array('class' => 'btn btn-sm btn-danger', 'data-toggle' => 'tooltip', 'title' => '削除'
                                        , 'onclick' => "return confirm('削除してもよろしいですか？')")); ?>
			</td>
			<td><?php echo $item->position_name; ?></td>
			<td><?php echo $item->order_no; ?></td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>データがありません</p>

<?php endif; ?>
