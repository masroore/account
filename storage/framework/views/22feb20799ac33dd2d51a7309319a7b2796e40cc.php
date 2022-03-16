<div class="card bg-none card-box">
    <?php echo e(Form::model($chartOfAccount, array('route' => array('chart-of-account.update', $chartOfAccount->id), 'method' => 'PUT'))); ?>

    <div class="row">
        <div class="form-group col-md-6">
            <?php echo e(Form::label('name', __('Name'),['class'=>'form-control-label'])); ?>

            <?php echo e(Form::text('name', null, array('class' => 'form-control','required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('code', __('Code'),['class'=>'form-control-label'])); ?>

            <?php echo e(Form::text('code', null, array('class' => 'form-control','required'=>'required'))); ?>

        </div>
       
        <div class="form-group col-md-6">
            <?php echo e(Form::label('is_enabled',__('Is Enabled'),array('class'=>'form-control-label'))); ?>

            <div class="custom-control custom-switch">
                <input type="checkbox" class="email-template-checkbox custom-control-input" name="is_enabled" id="is_enabled" <?php echo e($chartOfAccount->is_enabled==1?'checked':''); ?>>
                <label class="custom-control-label form-control-label" for="is_enabled"></label>
            </div>
        </div>
        <div class="form-group col-md-12">
            <?php echo e(Form::label('description', __('Description'),['class'=>'form-control-label'])); ?>

            <?php echo Form::textarea('description', null, ['class'=>'form-control','rows'=>'2']); ?>

        </div>
        <div class="col-md-12">
            <input type="submit" value="<?php echo e(__('Update')); ?>" class="btn-create badge-blue">
            <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    <?php echo e(Form::close()); ?>

</div>

<?php /**PATH /home/onamhamy/public_html/account/resources/views/chartOfAccount/edit.blade.php ENDPATH**/ ?>