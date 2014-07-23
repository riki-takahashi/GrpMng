<h2>Viewing <span class='muted'>#<?php echo $sales_target->id; ?></span></h2>

<p>
	<strong>Id:</strong>
	<?php echo $sales_target->id; ?></p>
<p>
	<strong>Group id:</strong>
	<?php echo $sales_target->group_id; ?></p>
<p>
	<strong>Sales term id:</strong>
	<?php echo $sales_target->sales_term_id; ?></p>
<p>
	<strong>Target amount:</strong>
	<?php echo $sales_target->target_amount; ?></p>
<p>
	<strong>Min amount:</strong>
	<?php echo $sales_target->min_amount; ?></p>

<?php echo Html::anchor('sales/target/edit/'.$sales_target->id, 'Edit'); ?> |
<?php echo Html::anchor('sales/target', 'Back'); ?>