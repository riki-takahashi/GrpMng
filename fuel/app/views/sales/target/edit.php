<?php echo render('sales/target/_form', $__data); ?>
<p>
	<?php echo Html::anchor('sales/target/index'
                . '?' . Controller_Sales_target::GROUP_ID . '=' . $group_id
                . '&' . Controller_Sales_target::SALES_TERM_ID . '=' . $sales_term_id
                . '&' . Controller_Sales_target::PAGE . '=' . $page
                , '戻る'); ?>
</p>
