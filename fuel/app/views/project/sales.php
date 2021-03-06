<style>
td.minimum-width {
    width: 10px;
    white-space: nowrap;
}
</style>
<p>
	<strong>案件名:</strong>
	<?php echo $project->project_name; ?></p>
<p>
	<strong>担当グループ:</strong>
	<?php echo $project->group->group_name; ?></p>
<p>
	<strong>担当者:</strong>
	<?php echo $project->employee->emp_name; ?></p>
<p>
	<strong>開始日:</strong>
	<?php echo str_replace('-', '/', $project->start_date); ?></p>
<p>
	<strong>終了日:</strong>
	<?php echo str_replace('-', '/', $project->end_date); ?></p>
<p>
	<strong>受注金額:</strong>
	<?php echo '&nbsp;&nbsp;'.number_format(intval($order_amount)).' 円'; ?></p>
<p>
	<strong>備考:</strong>
	<?php echo $project->note; ?></p>
<hr>
<p  class="text-right">
	<?php echo Html::anchor('sales/result/create/'.$project->id, '<span class="glyphicon glyphicon-plus"></span> 新規登録', array('class' => 'btn btn-primary')); ?>
</p>
<?php if ($project->results): ?>
<?php echo Form::open(array("class"=>"form-horizontal")); ?>
	<fieldset>
		<table class="table table-striped table-bordered table-hover table-condensed">
			<thead>
                            <tr class="info">
                                    <th>&nbsp;</th>
                                    <th class="text-center">売上実績名</th>
                                    <th class="text-center">売上日</th>
                                    <th class="text-center">受注金額</th>
                                    <th class="text-center">売上金額</th>
                                    <th class="text-center">備考</th>
                            </tr>
			</thead>
			<tbody>
		<?php foreach ($project->results as $result): ?>
                            <tr>
                                    <td class="minimum-width">
                                        <?php echo Html::anchor('sales/result/edit/'.$project->id.'/'.$result->id, '<span class="glyphicon glyphicon-pencil"></span>'
                                                , array('class' => 'btn btn-sm btn-primary', 'data-toggle' => 'tooltip', 'title' => '編集')); ?>
                                        <?php echo Html::anchor('project/sdelete/'.$project->id.'/'.$result->id, '<span class="glyphicon glyphicon-remove"></span>'
                                                , array('class' => 'btn btn-sm btn-danger', 'data-toggle' => 'tooltip', 'title' => '削除'
                                                    , 'onclick' => "return confirm('削除してもよろしいですか？')")); ?>
                                    </td>
                                    <td><?php echo $result->sales_result_name; ?></td>
                                    <td><?php echo str_replace('-', '/', $result->sales_date); ?></td>
                                    <td><?php echo number_format($result->project->order_amount); ?></td>
                                    <td><?php echo number_format($result->sales_amount); ?></td>
                                    <td><?php echo $result->note; ?></td>
                            </tr>
		<?php endforeach; ?>
			</tbody>
		</table>
	</fieldset>
<?php echo Form::close(); ?>
<?php else: ?>
<p>データがありません</p>
<?php endif; ?>
<p>
	<?php echo Html::anchor('project', '案件TOP'); ?> | 
	<?php echo Html::anchor('project/edit/'.$project->id, '案件編集'); ?> 
</p>
