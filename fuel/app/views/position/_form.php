<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
                    <div class="col-xs-10 col-sm-5 col-md-4 col-lg-4">
			<?php echo Form::label('役職名', 'position_name', array('class'=>'control-label')); ?>
			<?php echo Form::input('position_name', Input::post('position_name', isset($position) ? $position->position_name : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'役職名')); ?>
                    </div>
		</div>
		<div class="form-group">
                    <div class="col-xs-10 col-sm-5 col-md-4 col-lg-4">
			<?php echo Form::label('並び順', 'order_no', array('class'=>'control-label')); ?>
			<?php echo Form::input('order_no', Input::post('order_no', isset($position) ? $position->order_no : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'並び順')); ?>
                    </div>
		</div>
		<div class="form-group">
                    <div class="col-xs-10 col-sm-5 col-md-4 col-lg-4">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::button('submit', '<span class="glyphicon glyphicon-save"></span> 保存', array('class' => 'btn btn-primary')); ?>
                    </div>
		</div>
	</fieldset>
<?php echo Form::close(); ?>