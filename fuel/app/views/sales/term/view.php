<h2>Viewing <span class='muted'>#<?php echo $sales_term->id; ?></span></h2>

<p>
	<strong>Term name:</strong>
	<?php echo $sales_term->term_name; ?></p>
<p>
	<strong>Start date:</strong>
	<?php echo $sales_term->start_date; ?></p>
<p>
	<strong>End date:</strong>
	<?php echo $sales_term->end_date; ?></p>
<p>
	<strong>Note:</strong>
	<?php echo $sales_term->note; ?></p>

<?php echo Html::anchor('sales/term/edit/'.$sales_term->id, 'Edit'); ?> |
<?php echo Html::anchor('sales/term', 'Back'); ?>