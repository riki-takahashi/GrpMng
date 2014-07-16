<h2>Listing <span class='muted'>Sales_terms</span></h2>
<br>
<?php if ($sales_terms): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Term name</th>
			<th>Start date</th>
			<th>End date</th>
			<th>Note</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($sales_terms as $item): ?>		<tr>

			<td><?php echo $item->term_name; ?></td>
			<td><?php echo $item->start_date; ?></td>
			<td><?php echo $item->end_date; ?></td>
			<td><?php echo $item->note; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('sales/term/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-small')); ?>						<?php echo Html::anchor('sales/term/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-small')); ?>						<?php echo Html::anchor('sales/term/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-small btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Sales_terms.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('sales/term/create', 'Add new Sales term', array('class' => 'btn btn-success')); ?>

</p>
