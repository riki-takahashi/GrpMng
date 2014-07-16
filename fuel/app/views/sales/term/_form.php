<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Term name', 'term_name', array('class'=>'control-label')); ?>

				<?php echo Form::textarea('term_name', Input::post('term_name', isset($sales_term) ? $sales_term->term_name : ''), array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder'=>'Term name')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Start date', 'start_date', array('class'=>'control-label')); ?>

				<?php echo Form::input('start_date', Input::post('start_date', isset($sales_term) ? $sales_term->start_date : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Start date')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('End date', 'end_date', array('class'=>'control-label')); ?>

				<?php echo Form::input('end_date', Input::post('end_date', isset($sales_term) ? $sales_term->end_date : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'End date')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Note', 'note', array('class'=>'control-label')); ?>

				<?php echo Form::textarea('note', Input::post('note', isset($sales_term) ? $sales_term->note : ''), array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder'=>'Note')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>