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
	<strong>備考:</strong>
	<?php echo $project->note; ?></p>
<hr>
<p  class="text-right">
	<?php echo Html::anchor('project/mcreate/'.$project->id, '<span class="glyphicon glyphicon-plus"></span> 新規登録', array('class' => 'btn btn-primary')); ?>
</p>
<?php if ($project->members): ?>
<?php echo Form::open(array("class"=>"form-horizontal")); ?>
	<fieldset>
		<table class="table table-striped table-bordered table-hover table-condensed">
			<thead>
				<tr class="info">
					<th>&nbsp;</th>
					<th class="text-center">社員名</th>
					<th class="text-center">開始日</th>
					<th class="text-center">終了日</th>
					<th class="text-center">備考</th>
				</tr>
			</thead>
			<tbody>
		<?php foreach ($project->members as $member): ?>
			<?php if ($member->id != $member_id) : ?>
				<tr>
					<td>
						<?php echo Html::anchor('project/member/'.$project->id.'/'.$member->id, '<span class="glyphicon glyphicon-pencil"></span>'
                                                        , array('class' => 'btn btn-sm btn-primary', 'data-toggle' => 'tooltip', 'title' => '編集')); ?>
						<?php echo Html::anchor('project/mdelete/'.$project->id.'/'.$member->id, '<span class="glyphicon glyphicon-remove"></span>'
                                                        , array('class' => 'btn btn-sm btn-danger', 'data-toggle' => 'tooltip', 'title' => '削除'
                                                            , 'onclick' => "return confirm('削除してもよろしいですか？')")); ?>
					</td>
					<td><?php echo isset($member->employee->emp_name) ? $member->employee->emp_name : ''; ?></td>
					<td><?php echo isset($member->start_date) ? str_replace('-', '/', $member->start_date) : ''; ?></td>
					<td><?php echo isset($member->end_date) ? str_replace('-', '/', $member->end_date) : ''; ?></td>
                                        <td><?php echo isset($member->note) ? $member->note : ''; ?></td>
				</tr>
			<?php else : ?>
				<tr>
					<td>
						<?php echo Form::button('submit', '<span class="glyphicon glyphicon-save"></span> 更新', array('class' => 'btn btn-sm btn-primary', 'onclick' => 'this.disabled=true;')); ?>
						<?php echo Html::anchor('project/member/'.$project->id, '<span class="glyphicon glyphicon-refresh"></span> ｷｬﾝｾﾙ', array('class' => 'btn btn-sm btn-warning')); ?>
					</td>
					<?php if ($member->id == $temp_id) : ?>
						<td><?php echo Form::select('emp_id', null, $employees, array('class' => 'col-md-4 form-control')); ?></td>
					<?php else : ?>
						<td><?php echo isset($member->employee->emp_name) ? $member->employee->emp_name : ''; ?></td>
					<?php endif; ?>
					<td>
						<?php echo Form::input('start_date', Input::post('start_date', isset($member) ? str_replace('-', '/', $member->start_date) : '')
                                                    , array('class' => 'col-md-4 form-control dp', 'placeholder'=>'開始日')); ?>
					</td>
					<td>
						<?php echo Form::input('end_date', Input::post('end_date', isset($member) ? str_replace('-', '/', $member->end_date) : '')
                                                    , array('class' => 'col-md-4 form-control dp', 'placeholder'=>'終了日')); ?>
					</td>
					<td>
						<?php echo Form::input('note', Input::post('note', isset($member) ? $member->note : '')
                                                    , array('class' => 'col-md-4 form-control', 'placeholder'=>'備考')); ?>
					</td>
				</tr>
			<?php endif; ?>
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
