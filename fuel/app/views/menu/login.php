<?php echo Form::open(array("class"=>"form-horizontal")); ?>
<fieldset>
	<div class="form-group">
		<?php echo Form::label('ユーザーID', 'username', array('class'=>'control-label')); ?>
			<?php echo Form::input('username', null, array('class' => 'col-md-6 form-control', 'placeholder'=>'ユーザーID')); ?>
	</div>
	<div class="form-group">
		<?php echo Form::label('パスワード', 'password', array('class'=>'control-label')); ?>
			<?php echo Form::password('password', null, array('class' => 'col-md-6 form-control', 'placeholder'=>'パスワード')); ?>
	</div>
	<br>
	<div class="form-group">
		<?php echo Form::button('submit', '<span class="glyphicon glyphicon-log-in"></span> ログイン', array('class' => 'btn btn-primary')); ?>
	</div>

</fieldset>
<?php echo Form::close(); ?>
