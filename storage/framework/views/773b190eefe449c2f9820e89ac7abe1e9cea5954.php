<div class="card bg-none card-box">
    <?php echo e(Form::model($plan, array('route' => array('plans.update', $plan->id), 'method' => 'PUT', 'enctype' => "multipart/form-data"))); ?>

    <div class="row">
        <div class="form-group col-md-6">
            <?php echo e(Form::label('name',__('Name'),['class'=>'form-control-label'])); ?>

            <?php echo e(Form::text('name',null,array('class'=>'form-control font-style','placeholder'=>__('Enter Plan Name'),'required'=>'required'))); ?>

        </div>
        <?php if($plan->price >0): ?>
            <div class="form-group col-md-6">
                <?php echo e(Form::label('price',__('Price'),['class'=>'form-control-label'])); ?>

                <?php echo e(Form::number('price',null,array('class'=>'form-control','placeholder'=>__('Enter Plan Price'),'required'=>'required'))); ?>

            </div>
        <?php endif; ?>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('duration', __('Duration'),['class'=>'form-control-label'])); ?>

            <?php echo Form::select('duration', $arrDuration, null,array('class' => 'form-control select2','required'=>'required')); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('max_users',__('Maximum Users'),['class'=>'form-control-label'])); ?>

            <?php echo e(Form::number('max_users',null,array('class'=>'form-control','required'=>'required'))); ?>

            <span class="small"><?php echo e(__('Note: "-1" for Unlimited')); ?></span>
        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('max_customers',__('Maximum Customers'),['class'=>'form-control-label'])); ?>

            <?php echo e(Form::number('max_customers',null,array('class'=>'form-control','required'=>'required'))); ?>

            <span class="small"><?php echo e(__('Note: "-1" for Unlimited')); ?></span>
        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('max_venders',__('Maximum Venders'),['class'=>'form-control-label'])); ?>

            <?php echo e(Form::number('max_venders',null,array('class'=>'form-control','required'=>'required'))); ?>

            <span class="small"><?php echo e(__('Note: "-1" for Unlimited')); ?></span>
        </div>
        <div class="form-group col-md-12">
            <?php echo e(Form::label('description', __('Description'),['class'=>'form-control-label'])); ?>

            <?php echo Form::textarea('description', null, ['class'=>'form-control','rows'=>'2']); ?>

        </div>
        <div class="form-group col-md-12">
            <input type="submit" value="<?php echo e(__('Update')); ?>" class="btn-create badge-blue">
            <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    <?php echo e(Form::close()); ?>

</div>
<?php /**PATH /home/onamhamy/public_html/account/resources/views/plan/edit.blade.php ENDPATH**/ ?>