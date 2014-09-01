<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
                    <div class="col-xs-10 col-sm-5 col-md-4 col-lg-4">
			<?php echo Form::label('売上期間名', 'term_name', array('class'=>'control-label')); ?>
			<?php echo Form::input('term_name', Input::post('term_name', isset($sales_term) ? $sales_term->term_name : ''), array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder'=>'売上期間名')); ?>
                    </div>
		</div>
		<div class="form-group">
                    <div class="col-xs-10 col-sm-5 col-md-4 col-lg-4">
			<?php echo Form::label('開始日', 'start_date', array('class'=>'control-label')); ?>
			<?php echo Form::input('start_date', Input::post('start_date', isset($sales_term) ? str_replace('-', '/', $sales_term->start_date) : ''), array('class' => 'col-md-4 form-control dp', 'placeholder'=>'開始日')); ?>
                    </div>
		</div>
		<div class="form-group">
                    <div class="col-xs-10 col-sm-5 col-md-4 col-lg-4">
			<?php echo Form::label('終了日', 'end_date', array('class'=>'control-label')); ?>
			<?php echo Form::input('end_date', Input::post('end_date', isset($sales_term) ? str_replace('-', '/', $sales_term->end_date) : ''), array('class' => 'col-md-4 form-control dp', 'placeholder'=>'終了日')); ?>
                    </div>
		</div>
		<div class="form-group">
                    <div class="col-xs-10 col-sm-5 col-md-4 col-lg-4">
			<?php echo Form::label('備考', 'note', array('class'=>'control-label')); ?>
			<?php echo Form::textarea('note', Input::post('note', isset($sales_term) ? $sales_term->note : ''), array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder'=>'備考')); ?>
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