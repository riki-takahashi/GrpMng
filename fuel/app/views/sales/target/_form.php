<?php echo Form::open(array("class"=>"form-horizontal")); ?>
	<fieldset>
		<div class="form-group">
			<?php echo Form::label('グループID', 'group_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('group_id', Input::post('group_id', isset($sales_target) ? $sales_target->group_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'グループID')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('売上期間', 'sales_term_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('sales_term_id', Input::post('sales_term_id', isset($sales_target) ? $sales_target->sales_term_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'売上期間')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('目標売上金額', 'target_amount', array('class'=>'control-label')); ?>

				<?php echo Form::input('target_amount', Input::post('target_amount', isset($sales_target) ? $sales_target->target_amount : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'目標売上金額')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('最低売上金額', 'min_amount', array('class'=>'control-label')); ?>

				<?php echo Form::input('min_amount', Input::post('min_amount', isset($sales_target) ? $sales_target->min_amount : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'最低売上金額')); ?>
		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', '保存', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>