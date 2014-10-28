<p  class="text-right">
	<?php echo Html::anchor('employee/create', '<span class="glyphicon glyphicon-plus"></span> 新規登録', array('class' => 'btn btn-primary')); ?>
</p>
<?php if ($employees): ?>
<table class="table table-striped table-bordered table-hover table-condensed">
	<thead>
		<tr class="info">
			<th>&nbsp;</th>
			<th class="text-center">社員名</th>
			<th class="text-center">社員名カナ</th>
			<th class="text-center">役職</th>
			<th class="text-center">所属グループ</th>
			<th class="text-center">メールアドレス</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($employees as $item): ?>		<tr>
			<td>
				<?php echo Html::anchor('employee/edit/'.$item->id, '<span class="glyphicon glyphicon-pencil"></span>'
                                        , array('class' => 'btn btn-sm btn-primary', 'data-toggle' => 'tooltip', 'title' => '編集')); ?>	
				<?php echo Html::anchor('employee/delete/'.$item->id, '<span class="glyphicon glyphicon-remove"></span>'
                                        , array('class' => 'btn btn-sm btn-danger', 'data-toggle' => 'tooltip', 'title' => '削除'
                                            , 'onclick' => "return confirm('削除してもよろしいですか？')")); ?>
			</td>
			<td><?php echo $item->emp_name; ?></td>
			<td><?php echo $item->emp_kana; ?></td>
			<td><?php echo isset($item->position->position_name) ? $item->position->position_name : ''; ?></td>
			<td>
				<?php foreach ($item->groups as $group) : ?>
					<?php echo isset($group->group_name) ? $group->group_name : ''; ?><br>
				<?php endforeach; ?>
			</td>
			<td><?php echo $item->mail_address; ?></td>
		</tr>
<?php endforeach; ?>	
</tbody>
</table>

<?php else: ?>
<p>データがありません</p>

<?php endif; ?>
