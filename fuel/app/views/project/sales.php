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
	<?php echo $project->start_date; ?></p>
<p>
	<strong>終了日:</strong>
	<?php echo $project->end_date; ?></p>
<p>
	<strong>備考:</strong>
	<?php echo $project->note; ?></p>
<hr>
<p  class="text-right">
	<?php echo Html::anchor('project/screate/'.$project->id, '<span class="glyphicon glyphicon-plus"></span> 新規登録', array('class' => 'btn btn-primary')); ?>
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
                                    <th class="text-center">売上金額</th>
                                    <th class="text-center">消費税</th>
                                    <th class="text-center">備考</th>
                            </tr>
			</thead>
			<tbody>
		<?php foreach ($project->results as $result): ?>
                            <tr>
                                    <td>
                                        <?php echo Html::anchor('sales/result/edit/'.$project->id.'/'.$result->id, '<span class="glyphicon glyphicon-pencil"></span> 編集', array('class' => 'btn btn-sm btn-primary')); ?>
                                        <?php echo Html::anchor('project/sdelete/'.$project->id.'/'.$result->id, '<span class="glyphicon glyphicon-remove"></span> 削除', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('削除してもよろしいですか？')")); ?>
                                    </td>
                                    <td><?php echo $result->sales_result_name; ?></td>
                                    <td><?php echo $result->sales_date; ?></td>
                                    <td><?php echo $result->sales_amount; ?></td>
                                    <td><?php echo $result->tax; ?></td>
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
