<?php echo Form::open(array("class"=>"form-horizontal")); ?>
	<fieldset>
		<div class="form-group">
                    <div class="col-xs-10 col-sm-5 col-md-4 col-lg-4">
			<?php echo Form::label('グループ', 'group_id', array('class'=>'control-label')); ?>
			<?php echo Form::select('group_id', Input::post('group_id', isset($sales_target) ? $sales_target->group_id : ''), $groups, array('class' => 'col-md-4 form-control')); ?>
                    </div>
		</div>
		<div class="form-group">
                    <div class="col-xs-10 col-sm-5 col-md-4 col-lg-4">
			<?php echo Form::label('売上期間', 'sales_term_id', array('class'=>'control-label')); ?>
			<?php echo Form::select('sales_term_id', Input::post('sales_term_id', isset($sales_target) ? $sales_target->sales_term_id : ''), $sales_terms, array('class' => 'col-md-4 form-control')); ?>
                    </div>
		</div>
		<div class="form-group">
                    <div class="col-xs-10 col-sm-5 col-md-4 col-lg-4">
			<?php echo Form::label('目標売上金額', 'target_amount', array('class'=>'control-label')); ?>
			<?php echo Form::input('target_amount', Input::post('target_amount', isset($sales_target) ? number_format(intval($sales_target->target_amount)) : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'目標売上金額')); ?>
                    </div>
		</div>
		<div class="form-group">
                    <div class="col-xs-10 col-sm-5 col-md-4 col-lg-4">
			<?php echo Form::label('最低売上金額', 'min_amount', array('class'=>'control-label')); ?>
			<?php echo Form::input('min_amount', Input::post('min_amount', isset($sales_target) ? number_format(intval($sales_target->min_amount)) : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'最低売上金額')); ?>
                    </div>
		</div>
		<div class="form-group">
                    <div class="col-xs-10 col-sm-5 col-md-4 col-lg-4">
			<?php echo Form::hidden('id', isset($sales_target->id) ? $sales_target->id : ''); ?>
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::button('submit', '保存', array('class' => 'btn btn-primary', 'onclick' => 'return onece();')); ?>
                    </div>
                </div>
	</fieldset>
<?php echo Form::close(); ?>