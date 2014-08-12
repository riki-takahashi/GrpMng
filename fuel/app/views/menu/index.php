<dl>
	<dt>案件管理</dt>
	<dd><?php echo Html::anchor('project/search', '案件情報'); ?></dd>
	<dd><?php echo Html::anchor('project/assign', '社員アサイン状況'); ?></dd>
	<br>
	<dt>売上管理</dt>
	<dd><?php echo Html::anchor('sales/term', '売上期間情報'); ?></dd>
	<dd><?php echo Html::anchor('sales/target/search', '売上目標情報'); ?></dd>
	<dd><?php echo Html::anchor('sales/achievement/search', '売上集計'); ?></dd>
	<br>
	<dt>マスタメンテ</dt>
	<dd><?php echo Html::anchor('employee', '社員マスタ'); ?></dd>
	<dd><?php echo Html::anchor('group', 'グループマスタ'); ?></dd>
	<dd><?php echo Html::anchor('position', '役職マスタ'); ?></dd>
</dl>
