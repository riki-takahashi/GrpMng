<?php echo render('project/_form'); ?>
<p>
	<?php echo Html::anchor('project/member/'.$project->id, 'メンバー登録'); ?> |
	<?php echo Html::anchor('project/sales/'.$project->id, '売上情報'); ?> |
	<?php echo Html::anchor('project', '戻る'); ?></p>
