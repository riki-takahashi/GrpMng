<?php echo Form::open(array("class"=>"form-horizontal")); ?>
	<fieldset>
		<div class="form-group">
                    <div class="col-xs-10 col-sm-5 col-md-4 col-lg-4">
			<?php echo Form::label('案件名', 'project_name', array('class'=>'control-label')); ?>
			<?php echo Form::input('project_name', Input::post('project_name', isset($project) ? $project["project_name"] : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'案件名')); ?>
                    </div>
		</div>
		<div class="form-group">
                    <div class="col-xs-10 col-sm-5 col-md-4 col-lg-4">
			<?php echo Form::label('担当グループ', 'group_id', array('class'=>'control-label')); ?>
			<?php echo Form::select('group_id', Input::post('group_id', isset($project) ? $project["group_id"] : ''), $groups, array('class' => 'col-md-4 form-control')); ?>
                    </div>
		</div>
		<div class="form-group">
                    <div class="col-xs-10 col-sm-5 col-md-4 col-lg-4">
			<?php echo Form::label('担当者', 'emp_id', array('class'=>'control-label')); ?>
			<?php echo Form::select('emp_id', Input::post('emp_id', isset($project) ? $project["emp_id"] : ''), $employees, array('class' => 'col-md-4 form-control')); ?>
                    </div>
		</div>
		<div class="form-group">
                    <div class="col-xs-10 col-sm-5 col-md-4 col-lg-4">
			<?php echo Form::label('開始日', 'start_date', array('class'=>'control-label')); ?>
			<?php echo Form::input('start_date', Input::post('start_date', isset($project) ? str_replace('-', '/', $project["start_date"]) : ''), array('class' => 'col-md-4 form-control dp', 'placeholder'=>'開始日')); ?>
                    </div>
		</div>
		<div class="form-group">
                    <div class="col-xs-10 col-sm-5 col-md-4 col-lg-4">
			<?php echo Form::label('終了日', 'end_date', array('class'=>'control-label')); ?>
			<?php echo Form::input('end_date', Input::post('end_date', isset($project) ? str_replace('-', '/', $project["end_date"]) : ''), array('class' => 'col-md-4 form-control dp', 'placeholder'=>'終了日')); ?>
                    </div>
		</div>
		<div class="form-group">
                    <div class="col-xs-10 col-sm-5 col-md-4 col-lg-4">
			<?php echo Form::label('見積金額', 'est_amount', array('class'=>'control-label')); ?>
			<?php echo Form::input('est_amount', Input::post('est_amount', isset($project) ? number_format(intval($project["est_amount"])) : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'見積金額')); ?>
                    </div>
		</div>
		<div class="form-group">
                    <div class="col-xs-10 col-sm-5 col-md-4 col-lg-4">
			<?php echo Form::label('受注金額', 'order_amount', array('class'=>'control-label')); ?>
			<?php echo Form::input('order_amount', Input::post('order_amount', isset($project) ? number_format(intval($project["order_amount"])) : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'受注金額')); ?>
                    </div>
		</div>
		<div class="form-group">
                    <div class="col-xs-10 col-sm-5 col-md-4 col-lg-4">
			<?php echo Form::label('納品日', 'delivery_date', array('class'=>'control-label')); ?>
			<?php echo Form::input('delivery_date', Input::post('delivery_date', isset($project) ? str_replace('-', '/', $project["delivery_date"]) : ''), array('class' => 'col-md-4 form-control dp', 'placeholder'=>'納品日')); ?>
                    </div>
		</div>
		<div class="form-group">
                    <div class="col-xs-10 col-sm-5 col-md-4 col-lg-4">
			<?php echo Form::label('売上日', 'sales_date', array('class'=>'control-label')); ?>
			<?php echo Form::input('sales_date', Input::post('sales_date', isset($project) ? str_replace('-', '/', $project["sales_date"]) : ''), array('class' => 'col-md-4 form-control dp', 'placeholder'=>'売上日')); ?>
                    </div>
		</div>
		<div class="form-group">
                    <div class="col-xs-10 col-sm-5 col-md-4 col-lg-4">
			<?php echo Form::label('エンドユーザー', 'end_user', array('class'=>'control-label')); ?>
			<?php echo Form::input('end_user', Input::post('end_user', isset($project) ? $project["end_user"] : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'エンドユーザー')); ?>
                    </div>
		</div>
		<div class="form-group">
                    <div class="col-xs-10 col-sm-5 col-md-4 col-lg-4">
			<?php echo Form::label('受注元', 'order_user', array('class'=>'control-label')); ?>
			<?php echo Form::input('order_user', Input::post('order_user', isset($project) ? $project["order_user"] : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'受注元')); ?>
                    </div>
		</div>
		<div class="form-group">
                    <div class="col-xs-10 col-sm-5 col-md-4 col-lg-4">
			<?php echo Form::label('備考', 'note', array('class'=>'control-label')); ?>
			<?php echo Form::textarea('note', Input::post('note', isset($project) ? $project["note"] : ''), array('class' => 'col-md-8 form-control', 'rows' => '3', 'placeholder'=>'備考')); ?>
                    </div>
		</div>
		<div class="form-group">
                    <div class="col-xs-10 col-sm-5 col-md-4 col-lg-4">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::button('submit', '<span class="glyphicon glyphicon-save"></span> 保存', array('class' => 'btn btn-primary', 'onclick' => 'this.disabled=true;')); ?>
                    </div>
		</div>
	</fieldset>
<?php echo Form::close(); ?>