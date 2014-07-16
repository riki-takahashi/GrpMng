<?php echo Form::open(array("class"=>"form-horizontal")); ?>
	<fieldset>
		<div class="form-group">
			<?php echo Form::label('グループ名', 'group_name', array('class'=>'control-label')); ?>
				<?php echo Form::input('group_name', Input::post('group_name', isset($group) ? $group->group_name : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'グループ名')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('グループ名カナ', 'group_kana', array('class'=>'control-label')); ?>
				<?php echo Form::input('group_kana', Input::post('group_kana', isset($group) ? $group->group_kana : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'グループ名カナ')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('代表者', 'main_emp_id', array('class'=>'control-label')); ?>
				<?php echo Form::select('main_emp_id', Input::post('main_emp_id', isset($group) ? $group->main_emp_id : ''), $employees, array('class' => 'col-md-4 form-control')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('無効フラグ', 'invalid_flag', array('class'=>'control-label')); ?>
				<?php echo Form::select('invalid_flag', Input::post('invalid_flag', isset($group) ? $group->invalid_flag : ''), $invalid_flag, array('class' => 'col-md-4 form-control')); ?>
		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', '保存', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>