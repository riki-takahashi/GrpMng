<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('社員名', 'emp_name', array('class'=>'control-label')); ?>
				<?php echo Form::input('emp_name', Input::post('emp_name', isset($employee) ? $employee->emp_name : ''), array('class' => 'col-md-6 form-control', 'placeholder'=>'社員名')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('社員名カナ', 'emp_kana', array('class'=>'control-label')); ?>
				<?php echo Form::input('emp_kana', Input::post('emp_kana', isset($employee) ? $employee->emp_kana : ''), array('class' => 'col-md-6 form-control', 'placeholder'=>'社員名カナ')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('役職', 'position_id', array('class'=>'control-label')); ?>
				<?php echo Form::select('position_id', Input::post('position_id', isset($employee) ? $employee->position_id : ''), $positions, array('class' => 'col-md-4 form-control')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('所属グループ', 'groups', array('class'=>'control-label')); ?><br>
			<?php if ($groups) : ?>
				<?php foreach($groups as $group) : ?>
					<?php echo Form::checkbox('group' . $group->id, $group->id, $is_belong($group->id)); ?>
					<?php echo Form::label($group->group_name, 'group' . $group->id, array()); ?>&nbsp;
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('メールアドレス', 'mail_address', array('class'=>'control-label')); ?>
				<?php echo Form::input('mail_address', Input::post('mail_address', isset($employee) ? $employee->mail_address : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'メールアドレス')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('物件担当権限', 'is_mng_flag', array('class'=>'control-label')); ?>
				<?php echo Form::select('is_mng_flag', Input::post('is_mng_flag', isset($employee) ? $employee->is_mng_flag : ''), $is_mng_flag, array('class' => 'col-md-4 form-control')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('無効フラグ', 'invalid_flag', array('class'=>'control-label')); ?>
				<?php echo Form::select('invalid_flag', Input::post('invalid_flag', isset($employee) ? $employee->invalid_flag : ''), $invalid_flag, array('class' => 'col-md-4 form-control')); ?>
		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', '保存', array('class' => 'btn btn-primary')); ?>
		</div>
	</fieldset>
<?php echo Form::close(); ?>