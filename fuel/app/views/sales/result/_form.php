<?php echo Form::open(array("class"=>"form-horizontal")); ?>
	<fieldset>
		<div class="form-group">
			<?php echo Form::label('案件ID', 'project_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('project_id', Input::post('project_id', isset($sales_result) ? $sales_result->project_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'案件ID')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('売上実績名', 'sales_result_name', array('class'=>'control-label')); ?>

				<?php echo Form::textarea('sales_result_name', Input::post('sales_result_name', isset($sales_result) ? $sales_result->sales_result_name : ''), array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder'=>'売上実績名')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('売上日', 'sales_date', array('class'=>'control-label')); ?>

				<?php echo Form::input('sales_date', Input::post('sales_date', isset($sales_result) ? $sales_result->sales_date : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'売上日')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('売上金額', 'sales_amount', array('class'=>'control-label')); ?>

				<?php echo Form::input('sales_amount', Input::post('sales_amount', isset($sales_result) ? $sales_result->sales_amount : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'売上金額')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('消費税', 'tax', array('class'=>'control-label')); ?>

				<?php echo Form::input('tax', Input::post('tax', isset($sales_result) ? $sales_result->tax : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'消費税')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('備考', 'note', array('class'=>'control-label')); ?>

				<?php echo Form::textarea('note', Input::post('note', isset($sales_result) ? $sales_result->note : ''), array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder'=>'備考')); ?>
		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', '保存', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>