<h2>Editing <span class='muted'>Sales_term</span></h2>
<br>

<?php echo render('sales\term/_form'); ?>
<p>
	<?php echo Html::anchor('sales/term/view/'.$sales_term->id, 'View'); ?> |
	<?php echo Html::anchor('sales/term', 'Back'); ?></p>
