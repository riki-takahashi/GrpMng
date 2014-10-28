<?php echo Form::open(array("class"=>"form-horizontal")); ?>
<p class="text-right">
    <?php echo Html::anchor('project/create', '<span class="glyphicon glyphicon-plus"></span> 新規登録', array('class' => 'btn btn-primary')); ?>&nbsp;&nbsp;&nbsp;
    <?php echo Form::button('project/search', '<span class="glyphicon glyphicon-search"></span> 検索開始', array('type' => 'submit', 'class' => 'btn btn-primary')); ?>
</p>
	<fieldset>
            <div class="form-group">
                <div class="col-xs-10 col-sm-5 col-md-4 col-lg-4">
                    <?php echo $fieldset->field('project_status')->set_template('{label}'); ?>
                    <?php echo $fieldset->field('project_status')->set_template('{field}'); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-10 col-sm-5 col-md-4 col-lg-4">
                    <?php echo $fieldset->field('project_name')->set_template('{label}'); ?>
                    <?php echo $fieldset->field('project_name')->set_template('{field}'); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-10 col-sm-5 col-md-4 col-lg-4">
                    <?php echo $fieldset->field('group_id')->set_template('{label}'); ?>
                    <?php echo $fieldset->field('group_id')->set_template('{field}'); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-10 col-sm-5 col-md-4 col-lg-4">
                    <?php echo $fieldset->field('emp_id')->set_template('{label}'); ?>
                    <?php echo $fieldset->field('emp_id')->set_template('{field}'); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-10 col-sm-5 col-md-4 col-lg-4">
                    <?php echo $fieldset->field('start_date_from')->set_template('{label}'); ?>
                    <?php echo $fieldset->field('start_date_from')->set_template('{field}'); ?>
                    <?php echo $fieldset->field('start_date_to')->set_template('{field}'); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-10 col-sm-5 col-md-4 col-lg-4">
                    <?php echo $fieldset->field('end_date_from')->set_template('{label}'); ?>
                    <?php echo $fieldset->field('end_date_from')->set_template('{field}'); ?>
                    <?php echo $fieldset->field('end_date_to')->set_template('{field}'); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-10 col-sm-5 col-md-4 col-lg-4">
                    <?php echo $fieldset->field('delivery_date_from')->set_template('{label}'); ?>
                    <?php echo $fieldset->field('delivery_date_from')->set_template('{field}'); ?>
                    <?php echo $fieldset->field('delivery_date_to')->set_template('{field}'); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-10 col-sm-5 col-md-4 col-lg-4">
                    <?php echo $fieldset->field('sales_date_from')->set_template('{label}'); ?>
                    <?php echo $fieldset->field('sales_date_from')->set_template('{field}'); ?>
                    <?php echo $fieldset->field('sales_date_to')->set_template('{field}'); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-10 col-sm-5 col-md-4 col-lg-4">
                    <?php echo $fieldset->field('end_user')->set_template('{label}'); ?>
                    <?php echo $fieldset->field('end_user')->set_template('{field}'); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-10 col-sm-5 col-md-4 col-lg-4">
                    <?php echo $fieldset->field('order_user')->set_template('{label}'); ?>
                    <?php echo $fieldset->field('order_user')->set_template('{field}'); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-10 col-sm-5 col-md-4 col-lg-4">
                    <?php echo $fieldset->field('note')->set_template('{label}'); ?>
                    <?php echo $fieldset->field('note')->set_template('{field}'); ?>
                </div>
            </div>
	</fieldset>
<?php echo Form::close(); 