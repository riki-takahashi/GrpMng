<?php echo Form::open(array("class"=>"form-horizontal")); ?>
	<fieldset>
		<div class="form-group">
                    <div class="col-xs-10 col-sm-5 col-md-4 col-lg-4">
			<?php echo Form::label('案件名:', 'project_name', array('class'=>'control-label')); ?>
			<?php echo $project_name; ?>
                    </div>
		</div>
		<div class="form-group">
                    <div class="col-xs-10 col-sm-5 col-md-4 col-lg-4">
			<?php echo Form::label('売上実績名', 'sales_result_name', array('class'=>'control-label')); ?>
			<?php echo Form::input('sales_result_name', Input::post('sales_result_name', isset($sales_result) ? $sales_result->sales_result_name : $project_name), array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder'=>'売上実績名')); ?>
                    </div>
		</div>
		<div class="form-group">
                    <div class="col-xs-10 col-sm-5 col-md-4 col-lg-4">
			<?php echo Form::label('売上日', 'sales_date', array('class'=>'control-label')); ?>
			<?php echo Form::input('sales_date', Input::post('sales_date', isset($sales_result) ? str_replace('-', '/', $sales_result->sales_date) : ''), array('class' => 'col-md-4 form-control dp', 'placeholder'=>'売上日')); ?>
                    </div>
		</div>
		<div class="form-group">
                    <div class="col-xs-10 col-sm-5 col-md-4 col-lg-4">
			<?php echo Form::label('売上金額', 'sales_amount', array('class'=>'control-label')); ?>
			<?php echo Form::input('sales_amount', Input::post('sales_amount', isset($sales_result) ? $sales_result->sales_amount : $sales_amount), array('class' => 'col-md-4 form-control', 'placeholder'=>'売上金額')); ?>
                    </div>
		</div>
		<div class="form-group">
                    <div class="col-xs-10 col-sm-5 col-md-4 col-lg-4">
			<?php echo Form::label('備考', 'note', array('class'=>'control-label')); ?>
			<?php echo Form::textarea('note', Input::post('note', isset($sales_result) ? $sales_result->note : ''), array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder'=>'備考')); ?>
                    </div>
		</div>
		<div class="form-group">
                    <div class="col-xs-10 col-sm-5 col-md-4 col-lg-4">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', '保存', array('class' => 'btn btn-primary')); ?>
                    </div>
                </div>
	</fieldset>
<?php echo Form::close(); ?>