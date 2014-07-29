<?php echo Form::open(array("class"=>"form-horizontal")); ?>
<p class="text-right">
    <?php echo Html::anchor('sales/target/create', '<span class="glyphicon glyphicon-plus"></span> 新規登録', array('class' => 'btn btn-primary')); ?>&nbsp;&nbsp;&nbsp;&nbsp;
    <?php echo Form::button('sales/target/search', '<span class="glyphicon glyphicon-search"></span> 検索開始', array('type' => 'submit', 'class' => 'btn btn-primary')); ?>
</p>
	<fieldset>
		<div class="form-group">
			<?php echo Form::label('グループ', 'group_id', array('class'=>'control-label')); ?>
				<?php echo Form::select('group_id', $group_id, $groups, array('class' => 'col-md-4 form-control')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('売上期間', 'sales_term_id', array('class'=>'control-label')); ?>
				<?php echo Form::select('sales_term_id', $sales_term_id, $sales_terms, array('class' => 'col-md-4 form-control')); ?>
		</div>
	</fieldset>
<?php echo Form::close(); ?>