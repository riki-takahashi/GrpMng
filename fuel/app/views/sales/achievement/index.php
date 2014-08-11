<?php if (isset($sales_total)): ?>
<div style="text-align: left;float: left;">売上対象期間：　<?php echo $term_name; ?></div>
<br>
<br>
<div class="table-responsive">
    
<?php foreach ($sales_total as $itemTable): ?>
<br>
<p style="text-align: left;float: left;"><?php echo $itemTable["title"]; ?><div style="text-align: right;">[千円]</div></p>
<table class="table table-striped table-bordered table-hover table-condensed">
	<thead>
		<tr class="info">
			<th class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-center"></th>
			<th class="text-center">目標金額</th>
			<th class="text-center">実績金額</th>
			<th class="text-center hidden-xs hidden-sm">見込金額</th>
			<th class="text-center hidden-xs hidden-sm">最低金額</th>
		</tr>
	</thead>
        <tbody>
<?php foreach ($itemTable["list"] as $item): ?>
                <tr>
                        <td class="col-xs-3 col-sm-3 col-md-3 col-lg-3"><?php print_r($item["row_title"]); ?></td>
                        <td class="text-right"><?php echo number_format($item["target_amount_sum"]/1000);//小数第１位四捨五入 ?></td>
                        <td class="text-right"><?php echo number_format($item["sales_amount_sum"]/1000);//小数第１位四捨五入 ?></td>
                        <td class="text-right hidden-xs hidden-sm"><?php echo number_format($item["order_amount_sum"]/1000);//小数第１位四捨五入 ?></td>
                        <td class="text-right hidden-xs hidden-sm"><?php echo number_format($item["min_amount_sum"]/1000);//小数第１位四捨五入 ?></td>
                </tr>
<?php endforeach; ?>
        </tbody>
</table>

<?php endforeach; ?>

</div>
<?php else: ?>
<p>データがありません</p>
<?php endif; ?>
<p>
	<?php echo Html::anchor('sales/achievement/search', '検索画面に戻る'); ?>
</p>