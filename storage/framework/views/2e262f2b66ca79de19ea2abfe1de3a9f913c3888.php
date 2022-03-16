<style>
    input[type="file"]{
        opacity: unset;
        position:relative;
    }
</style>
<div class="card bg-none card-box">
    <?php echo e(Form::model($document, array('route' => array('document-entry.update', $document->id), 'files' => 'true','enctype'=>'multipart/form-data', 'method' => 'PUT'))); ?>

    <div class="row">
        <div class="form-group col-md-6">
            <?php echo e(Form::label('payment_text', __('Payment Text'),['class'=>'form-control-label'])); ?>

            <?php echo e(Form::text('payment_text', null, array('class' => 'form-control','required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('file_type', __('File Type'),['class'=>'form-control-label'])); ?>

             <?php echo e(Form::select('file_type', array('JV' => 'Journal Voucher', 'BPV' => 'Bank payment Voucher', 'CPV' => 'Cash payment Voucher', 'BR' => 'Bank Receipt' , 'CR' => 'Cash Receipt'), null, array('class' => 'form-control','required'=>'required'))); ?>

            <!--<?php echo e(Form::text('file_type', null, array('class' => 'form-control','required'=>'required'))); ?>-->
        </div>
        <div class="form-group col-md-6">
             <?php echo e(Form::label('file_upload', __('Upload File'),['class'=>'form-control-label'])); ?>

            <?php echo e(Form::file('file_upload',null, array('class' => 'form-control'))); ?>

        </div>
        <div class="col-md-12">
            <input type="submit" value="<?php echo e(__('Update')); ?>" class="btn-create badge-blue">
            <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    <?php echo e(Form::close()); ?>

</div>
<?php /**PATH /home/onamhamy/public_html/account/resources/views/documentEntries/edit.blade.php ENDPATH**/ ?>