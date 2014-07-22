<?php echo render('project/_form'); ?>
<p>
	<?php echo Html::anchor('project/member/'.$project->id, 'メンバー登録'); ?> |
	<?php echo Html::anchor('sales/result/view/'.$project->id, '売上実績'); ?> |
	<?php echo Html::anchor('project', '戻る'); ?></p>
