<h2>役職詳細</h2>

<p>
	<strong>役職名:</strong>
	<?php echo $position->position_name; ?></p>
<p>
	<strong>並び順:</strong>
	<?php echo $position->order_no; ?></p>

<?php echo Html::anchor('position/edit/'.$position->id, '編集'); ?> |
<?php echo Html::anchor('position', '戻る'); ?>