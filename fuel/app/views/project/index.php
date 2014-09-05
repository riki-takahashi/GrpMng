<p  class="pull-right">
	<?php echo Html::anchor('project/create', '<span class="glyphicon glyphicon-plus"></span> 新規登録', array('class' => 'btn btn-primary')); ?>
</p>
<?php if ($projects): ?>

    <script type="text/javascript">
            $(document).ready(function() {
                $('.grumble1').hover(function(){
                    $(this).grumble({
                        text: '編集', 
                        angle: 315, //角度
                        distance: 0, //距離
                        showAfter: 2000, //表示のタイミング
                        type: 'alt-', //水色にする場合
                        hasHideButton: false, //クリックで消去しない場合
                        hideAfter: 2000 //自動で消す（なしの場合はfalse）
                    });
                    $(".grumble1").unbind("hover"); //何度も実行されるのを防止
                });
                
                $('.grumble2').hover(function(){
                    $(this).grumble({
                        text: '削除', 
                        angle: 225, //角度
                        distance: 0, //距離
                        showAfter: 2000, //表示のタイミング
                        hasHideButton: false, //クリックで消去しない場合
                        hideAfter: 2000 //自動で消す（なしの場合はfalse）
                    });
                    $(".grumble2").unbind("hover"); //何度も実行されるのを防止
                });

                $('.grumble3').hover(function(){
                    $(this).grumble({
                        text: 'メンバー', 
                        angle: 135, //角度
                        distance: 0, //距離
                        showAfter: 2000, //表示のタイミング
                        type: 'alt-', //水色にする場合
                        hasHideButton: false, //クリックで消去しない場合
                        hideAfter: 2000 //自動で消す（なしの場合はfalse）
                    });
                    $(".grumble3").unbind("hover"); //何度も実行されるのを防止
                });

                $('.grumble4').hover(function(){
                    $(this).grumble({
                        text: '売上実績', 
                        angle: 45, //角度
                        distance: 0, //距離
                        showAfter: 2000, //表示のタイミング
                        type: 'alt-', //水色にする場合
                        hasHideButton: false, //クリックで消去しない場合
                        hideAfter: 2000 //自動で消す（なしの場合はfalse）
                    });
                    $(".grumble4").unbind("hover"); //何度も実行されるのを防止
                });

            });            
    </script>

<?php echo Pagination::create_links(); ?>
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover table-condensed">
	<thead>
		<tr class="info">
			<th>&nbsp;</th>
			<th class="text-center">案件名</th>
			<th class="text-center hidden-xs hidden-sm">担当グループ</th>
			<th class="text-center hidden-xs hidden-sm">担当者</th>
			<th class="text-center hidden-xs hidden-sm">開始日</th>
			<th class="text-center hidden-xs hidden-sm">終了日</th>
			<th class="text-center hidden-xs">エンドユーザー</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($projects as $item): ?>
		<tr>
			<td>
				<?php echo Html::anchor('project/edit/'.$item->id, '<span class="glyphicon glyphicon-pencil"></span>', array('class' => 'btn btn-sm btn-primary grumble1')); ?>
				<?php echo Html::anchor('project/delete/'.$item->id, '<span class="glyphicon glyphicon-remove"></span>', array('class' => 'btn btn-sm btn-danger grumble2', 'onclick' => "return confirm('削除してもよろしいですか？')")); ?>
				<?php echo Html::anchor('project/member/'.$item->id, '<span class="glyphicon glyphicon-user"></span>', array('class' => 'btn btn-sm btn-primary grumble3')); ?>
				<?php echo Html::anchor('project/sales/'.$item->id, '<span class="glyphicon glyphicon-thumbs-up"></span>', array('class' => 'btn btn-sm btn-primary grumble4')); ?>
			</td>
			<td><?php echo $item->project_name; ?></td>
			<td class="hidden-xs hidden-sm"><?php echo isset($item->group->group_name) ? $item->group->group_name : ''; ?></td>
			<td class="hidden-xs hidden-sm"><?php echo isset($item->employee->emp_name) ? $item->employee->emp_name: ''; ?></td>
			<td class="hidden-xs hidden-sm"><?php echo str_replace('-', '/', $item->start_date); ?></td>
			<td class="hidden-xs hidden-sm"><?php echo str_replace('-', '/', $item->end_date); ?></td>
			<td class="hidden-xs"><?php echo $item->end_user; ?></td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>
</div>
<?php else: ?>
<p>データがありません</p>
<?php endif; ?>
<p>
	<?php echo Html::anchor('project/search/', '検索画面に戻る'); ?>
</p>