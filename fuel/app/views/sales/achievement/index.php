<?php if (isset($sales_total)): ?>
    <?php if (isset($pdf_out_flg)): ?>
    <div style="text-align: right;">出力日時：　
    <?php echo Date::forge()->format("%Y/%m/%d　%H : %M"); ?>
    </div><br>
    <?php endif; ?>

<div style="text-align: left;">売上対象期間：　<?php echo $term_name; ?></div>
<br>
<div class="table-responsive">

<?php foreach ($sales_total as $itemTable): ?>
<div style="text-align:left; float:left; width:80%"><?php echo $itemTable["title"]; ?></div><div style="text-align:right; float:right; width:10%">[千円]</div>
<br>
<table class="table table-striped table-bordered table-hover table-condensed">
	<thead>
		<tr class="info">
			<th class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-center"><?php echo isset($group_title) ? $group_title : ''; ?></th>
                        <?php if (isset($taget_out_flg)): ?>
			<th class="text-center">目標金額</th>
			<th class="text-center hidden-xs hidden-sm">最低金額</th>
                        <?php endif; ?>
                        <th class="text-center hidden-xs hidden-sm">見込金額</th>
			<th class="text-center">実績金額</th>
		</tr>
	</thead>
        <tbody>
<?php foreach ($itemTable["list"] as $item): ?>
                <tr>
                        <td class="col-xs-3 col-sm-3 col-md-3 col-lg-3"><?php print_r($item["row_title"]); ?></td>
                        <?php if (isset($taget_out_flg)): ?>
                        <td class="text-right"><?php echo number_format($item["target_amount_sum"]/1000);//小数第１位四捨五入 ?></td>
                        <td class="text-right hidden-xs hidden-sm"><?php echo number_format($item["min_amount_sum"]/1000);//小数第１位四捨五入 ?></td>
                        <?php endif; ?>
                        <td class="text-right hidden-xs hidden-sm"><?php echo number_format($item["order_amount_sum"]/1000);//小数第１位四捨五入 ?></td>
                        <td class="text-right"><?php echo number_format($item["sales_amount_sum"]/1000);//小数第１位四捨五入 ?></td>
                </tr>
<?php endforeach; ?>
        </tbody>
</table>

<?php endforeach; ?>

</div>
<?php else: ?>
<p>データがありません</p>
<?php endif; ?>
<?php if (!isset($pdf_out_flg)): ?>
<p>
	<?php echo Html::anchor('sales/achievement/search', '検索画面に戻る'); ?>
</p>
<p>
	<?php echo Html::anchor('sales/achievement/pdf?'.Controller_Sales_Achievement::AGGREGATE_UNIT_ID.'='.$aggregate_unit_id.'&'.Controller_Sales_Achievement::SALES_TERM_ID.'='.$sales_term_id.'&pdf_out_flg=true', 'PDF出力', array('target'=>'_blank')); ?>
</p>
<?php endif;
