<?php echo render('project/_form'); ?>
<p>
	<?php echo Html::anchor('project/view/'.$project->id, '詳細'); ?> |
	<?php echo Html::anchor('project/member/'.$project->id, 'メンバー登録'); ?> |
	<?php echo Html::anchor('project', '戻る'); ?></p>
