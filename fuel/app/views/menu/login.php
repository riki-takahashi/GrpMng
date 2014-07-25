<?php echo Form::open(array("class"=>"form-horizontal")); ?>
<fieldset>
	<div class="form-group">
		<div class="col-sm-3">
			<?php echo Form::label('ユーザーID', 'username', array('class'=>'control-label')); ?>
			<?php echo Form::input('username', null, array('class' => 'form-control', 'placeholder'=>'ユーザーID')); ?>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-3">
			<?php echo Form::label('パスワード', 'password', array('class'=>'control-label')); ?>
			<?php echo Form::password('password', null, array('class' => 'form-control', 'placeholder'=>'パスワード')); ?>
		</div>
	</div>
	<br>
	<div class="form-group">
		<div class="col-sm-3">
			<?php echo Form::button('submit', '<span class="glyphicon glyphicon-log-in"></span> ログイン', array('class' => 'btn btn-primary')); ?>
		</div>
	</div>

</fieldset>
<?php echo Form::close(); ?>
