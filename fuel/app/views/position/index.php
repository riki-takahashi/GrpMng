<h3>役職一覧</h3>
<br>
<?php if ($positions): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>役職名</th>
			<th>並び順</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($positions as $item): ?>		<tr>

			<td><?php echo $item->position_name; ?></td>
			<td><?php echo $item->order_no; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('position/view/'.$item->id, '<i class="icon-eye-open"></i> 詳細', array('class' => 'btn btn-small')); ?>						
						<?php echo Html::anchor('position/edit/'.$item->id, '<i class="icon-wrench"></i> 編集', array('class' => 'btn btn-small')); ?>						
						<?php echo Html::anchor('position/delete/'.$item->id, '<i class="icon-trash icon-white"></i> 削除', array('class' => 'btn btn-small btn-danger', 'onclick' => "return confirm('削除してもよろしいですか？')")); ?>					
					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>データがありません</p>

<?php endif; ?><p>
	<?php echo Html::anchor('position/create', '新規登録', array('class' => 'btn btn-success')); ?>

</p>
