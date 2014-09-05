<h2>Viewing <span class='muted'>#<?php echo $sales_result->id; ?></span></h2>

<p>
	<strong>Id:</strong>
	<?php echo $sales_result->id; ?></p>
<p>
	<strong>Project id:</strong>
	<?php echo $sales_result->project_id; ?></p>
<p>
	<strong>Sales result name:</strong>
	<?php echo $sales_result->sales_result_name; ?></p>
<p>
	<strong>Sales date:</strong>
	<?php echo $sales_result->sales_date; ?></p>
<p>
	<strong>Sales amount:</strong>
	<?php echo $sales_result->sales_amount; ?></p>
<p>
	<strong>Note:</strong>
	<?php echo $sales_result->note; ?></p>

<?php echo Html::anchor('sales/result/edit/'.$sales_result->id, 'Edit'); ?> |
<?php echo Html::anchor('sales/result', '戻る'); ?>