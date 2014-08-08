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
			<th class="text-center"></th>
			<th class="text-center hidden-xs hidden-sm">目標金額</th>
			<th class="text-center hidden-xs hidden-sm">実績金額</th>
			<th class="text-center hidden-xs hidden-sm">見込金額</th>
			<th class="text-center hidden-xs hidden-sm">最低金額</th>
		</tr>
	</thead>
        <tbody>
<?php foreach ($itemTable['list'] as $aitem): ?>
                <tr>
                        <td><?php echo $aitem['row_title']; ?></td>
                        <td class="hidden-sm"><?php echo '$aitem[1]'; ?></td>
                        <td class="hidden-sm"><?php echo '$aitem[2]'; ?></td>
                        <td class="hidden-xs hidden-sm"><?php echo '$aitem[3]'; ?></td>
                        <td class="hidden-xs hidden-sm"><?php echo '$aitem[4]'; ?></td>
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