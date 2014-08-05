<?php echo Form::open(array("class"=>"form-horizontal")); ?>
<p class="text-right">
    <?php echo Form::button('sales/achievement/search', '<span class="glyphicon glyphicon-search"></span> 検索開始', array('type' => 'submit', 'class' => 'btn btn-primary')); ?>
</p>
	<fieldset>
            <div class="form-group">
		<div class="col-xs-12 col-sm-5 col-md-4 col-lg-3">
			<?php echo Form::label('グループ', 'group_id', array('class'=>'control-label')); ?>
				<?php echo Form::select('group_id', $group_id, $groups, array('class' => 'form-control')); ?>
		</div>
            </div>
            <div class="form-group">
		<div class="col-xs-12 col-sm-5 col-md-4 col-lg-3">
			<?php echo Form::label('売上期間', 'sales_term_id', array('class'=>'control-label')); ?>
				<?php echo Form::select('sales_term_id', $sales_term_id, $sales_terms, array('class' => 'form-control')); ?>
		</div>
            </div>
	</fieldset>
<?php echo Form::close(); ?>