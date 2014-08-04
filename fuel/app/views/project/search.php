<?php echo Form::open(array("class"=>"form-horizontal")); ?>
<p class="text-right">
    <?php echo Html::anchor('project/create', '<span class="glyphicon glyphicon-plus"></span> 新規登録', array('class' => 'btn btn-primary')); ?>&nbsp;&nbsp;&nbsp;
    <?php echo Form::button('project/search', '<span class="glyphicon glyphicon-search"></span> 検索開始', array('type' => 'submit', 'class' => 'btn btn-primary')); ?>
</p>
	<fieldset>
            <div class="form-group">
                <div class="col-xs-12 col-sm-5 col-md-4 col-lg-3">
                    <?php echo $fieldset->field('project_name')->set_template('{label}'); ?>
                    <?php echo $fieldset->field('project_name')->set_template('{field}'); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12 col-sm-5 col-md-4 col-lg-3">
                    <?php echo $fieldset->field('group_id')->set_template('{label}'); ?>
                    <?php echo $fieldset->field('group_id')->set_template('{field}'); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12 col-sm-5 col-md-4 col-lg-3">
                    <?php echo $fieldset->field('emp_id')->set_template('{label}'); ?>
                    <?php echo $fieldset->field('emp_id')->set_template('{field}'); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12 col-sm-5 col-md-4 col-lg-3">
                    <?php echo $fieldset->field('start_date_from')->set_template('{label}'); ?>
                    <?php echo $fieldset->field('start_date_from')->set_template('{field}'); ?>
                    <?php echo $fieldset->field('start_date_to')->set_template('{field}'); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12 col-sm-5 col-md-4 col-lg-3">
                    <?php echo $fieldset->field('end_date_from')->set_template('{label}'); ?>
                    <?php echo $fieldset->field('end_date_from')->set_template('{field}'); ?>
                    <?php echo $fieldset->field('end_date_to')->set_template('{field}'); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12 col-sm-5 col-md-4 col-lg-3">
                    <?php echo $fieldset->field('delivery_date_from')->set_template('{label}'); ?>
                    <?php echo $fieldset->field('delivery_date_from')->set_template('{field}'); ?>
                    <?php echo $fieldset->field('delivery_date_to')->set_template('{field}'); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12 col-sm-5 col-md-4 col-lg-3">
                    <?php echo $fieldset->field('sales_date_from')->set_template('{label}'); ?>
                    <?php echo $fieldset->field('sales_date_from')->set_template('{field}'); ?>
                    <?php echo $fieldset->field('sales_date_to')->set_template('{field}'); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12 col-sm-5 col-md-4 col-lg-3">
                    <?php echo $fieldset->field('end_user')->set_template('{label}'); ?>
                    <?php echo Form::input('end_user', Input::post('end_user', isset($project) ? $project->end_user : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'エンドユーザー')); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12 col-sm-5 col-md-4 col-lg-3">
                    <?php echo $fieldset->field('order_user')->set_template('{label}'); ?>
                    <?php echo Form::input('order_user', Input::post('order_user', isset($project) ? $project->order_user : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'受注元')); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12 col-sm-5 col-md-4 col-lg-3">
                    <?php echo $fieldset->field('note')->set_template('{label}'); ?>
                    <?php echo Form::textarea('note', Input::post('note', isset($project) ? $project->note : ''), array('class' => 'col-md-8 form-control', 'rows' => '3', 'placeholder'=>'備考')); ?>
                </div>
            </div>
	</fieldset>
<?php echo Form::close(); 