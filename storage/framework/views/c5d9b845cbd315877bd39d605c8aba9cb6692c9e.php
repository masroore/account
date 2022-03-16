<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Journal Entry Create')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('assets/js/jquery-ui.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/jquery.repeater.min.js')); ?>"></script>
    <script>
        var selector = "body";
        if ($(selector + " .repeater").length) {
            var $dragAndDrop = $("body .repeater tbody").sortable({
                handle: '.sort-handler'
            });
            var $repeater = $(selector + ' .repeater').repeater({
                initEmpty: false,
                defaultValues: {
                    'status': 1
                },
                show: function () {
                    $(this).slideDown();
                    var file_uploads = $(this).find('input.multi');
                    if (file_uploads.length) {
                        $(this).find('input.multi').MultiFile({
                            max: 3,
                            accept: 'png|jpg|jpeg',
                            max_size: 2048
                        });
                    }
                    // $('.select2').select2();
                   $(".select2").select2({
                      matcher: matchStart
                    });
                },
                hide: function (deleteElement) {
                    if (confirm('Are you sure you want to delete this element?')) {
                        $(this).slideUp(deleteElement);
                        $(this).remove();

                        var inputs = $(".debit");
                        var totalDebit = 0;
                        for (var i = 0; i < inputs.length; i++) {
                            totalDebit = parseFloat(totalDebit) + parseFloat($(inputs[i]).val());
                        }
                        $('.totalDebit').html(totalDebit.toFixed(2));


                        var inputs = $(".credit");
                        var totalCredit = 0;
                        for (var i = 0; i < inputs.length; i++) {
                            totalCredit = parseFloat(totalCredit) + parseFloat($(inputs[i]).val());
                        }
                        $('.totalCredit').html(totalCredit.toFixed(2));


                    }
                },
                ready: function (setIndexes) {
                    $dragAndDrop.on('drop', setIndexes);
                },
                isFirstItemUndeletable: true
            });
            var value = $(selector + " .repeater").attr('data-value');
            if (typeof value != 'undefined' && value.length != 0) {
                value = JSON.parse(value);
                $repeater.setList(value);
            }

        }

        $(document).on('keyup', '.debit', function () {
            var el = $(this).parent().parent().parent().parent();
            var debit = $(this).val();
            var credit = 0;
            el.find('.credit').val(credit);
            el.find('.amount').html(debit);


            var inputs = $(".debit");
            var totalDebit = 0;
            for (var i = 0; i < inputs.length; i++) {
                totalDebit = parseFloat(totalDebit) + parseFloat($(inputs[i]).val());
            }
            $('.totalDebit').html(totalDebit.toFixed(2));

            el.find('.credit').attr("disabled", true);
            el.find('.credit').addClass('d-none');
            if (debit == '') {
                el.find('.credit').attr("disabled", false);
                el.find('.credit').removeClass('d-none');
            }
            
        })
        
        $(document).on('change', '#vouchertype', function () {
            // alert('vouchertype');
            var prefix = $(".prefixjournal").data('prefix');
            // alert(prefix);
            var vouchertype = $(this).val();
            var journal = vouchertype+prefix;
            console.log(journal);
            $(".prefixjournal").val(journal);
            // BPV
            // CPV
            // BR
            // CR
        }) 
        
        $(document).on('keyup', '.credit', function () {
            var el = $(this).parent().parent().parent().parent();
            var credit = $(this).val();
            var debit = 0;
            el.find('.debit').val(debit);
            el.find('.amount').html(credit);

            var inputs = $(".credit");
            console.log(inputs);
            var totalCredit = 0;
            for (var i = 0; i < inputs.length; i++) {
                if (!isNaN($(inputs[i]).val())) {
                    console.log($(inputs[i]).val());
                    totalCredit = parseFloat(totalCredit) + parseFloat($(inputs[i]).val());
                }
            }
            console.log('-----Total Credit-------');
            console.log(totalCredit);
            $('.totalCredit').html(totalCredit.toFixed(2));

            el.find('.debit').attr("disabled", true);
            el.find('.debit').addClass('d-none');
            if (credit == '') {
                el.find('.debit').attr("disabled", false);
                el.find('.debit').removeClass('d-none');
            }
        })


    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>

    <?php echo e(Form::open(array('url' => 'journal-entry','class'=>'w-100'))); ?>

    <input type="hidden" name="_token" id="token" value="<?php echo e(csrf_token()); ?>">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="form-group">
                        <?php echo e(Form::label('journal_number', __('Journal Number'),['class'=>'form-control-label'])); ?>

                        <div class="form-icon-user">
                            <span><i class="fas fa-file"></i></span>
                            <input type="text" class="form-control prefixjournal" value="<?php echo e(\Auth::user()->journalWithPrefix($journalId,'#JUR')); ?>" data-prefix = <?php echo sprintf("%05d", $journalId); ?> readonly>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="form-group">
                        <?php echo e(Form::label('date', __('Transaction Date'),['class'=>'form-control-label'])); ?>

                        <div class="form-icon-user">
                            <span><i class="fas fa-calendar"></i></span>
                            <?php echo e(Form::text('date', '', array('class' => 'form-control datepicker','required'=>'required'))); ?>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="form-group">
                        <?php echo e(Form::label('reference', __('Reference'),['class'=>'form-control-label'])); ?>

                        <div class="form-icon-user">
                            <span><i class="fas fa-joint"></i></span>
                            <?php echo e(Form::text('reference', '', array('class' => 'form-control'))); ?>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="form-group">
                        <?php echo e(Form::label('vouchertype', __('vouchertype'),['class'=>'form-control-label'])); ?>

                        <div class="form-icon-user">
                            <!--<span><i class="fas fa-joint"></i></span>-->
                            <?php echo e(Form::select('vouchertype', array('JUR' => 'Journal Voucher', 'BPV' => 'Bank payment Voucher', 'CPV' => 'Cash payment Voucher', 'BR' => 'Bank Receipt' , 'CR' => 'Cash Receipt'), 'JV', array('class' => 'form-control','required'=>'required'))); ?>

                            <!--<?php echo e(Form::text('vouchertype', '', array('class' => 'form-control'))); ?>-->
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8">
                    <div class="form-group">
                        <?php echo e(Form::label('description', __('Description'),['class'=>'form-control-label'])); ?>

                        <?php echo e(Form::textarea('description', '', array('class' => 'form-control','rows'=>'2'))); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card repeater">
                <div class="item-section py-4">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-md-12 d-flex align-items-center justify-content-between justify-content-md-end">
                            <div class="all-button-box">
                                <a href="#" data-repeater-create="" class="btn btn-xs btn-white btn-icon-only width-auto" data-toggle="modal" data-target="#add-bank">
                                    <i class="fas fa-plus"></i> <?php echo e(__('Add Account')); ?>

                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body py-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0" data-repeater-list="accounts" id="sortable-table">
                            <thead>
                            <tr>
                                <th><?php echo e(__('Account')); ?></th>
                                <th><?php echo e(__('Debit')); ?></th>
                                <th><?php echo e(__('Credit')); ?> </th>
                                <th><?php echo e(__('Description')); ?></th>
                                <th class="text-right"><?php echo e(__('Amount')); ?> </th>
                                <th width="2%"></th>
                            </tr>
                            </thead>

                            <tbody class="ui-sortable" data-repeater-item>
                            <tr>
                                <td width="25%">
                                        <?php echo e(Form::select('account', $accounts,'', array('class' => 'form-control select2','required'=>'required'))); ?>

                                </td>

                                <td>
                                    <div class="form-group price-input">
                                        <?php echo e(Form::text('debit','', array('class' => 'form-control debit','required'=>'required','placeholder'=>__('Debit'),'required'=>'required'))); ?>

                                    </div>
                                </td>
                                <td>
                                    <div class="form-group price-input">
                                        <?php echo e(Form::text('credit','', array('class' => 'form-control credit','required'=>'required','placeholder'=>__('Credit'),'required'=>'required'))); ?>

                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <?php echo e(Form::text('description','', array('class' => 'form-control','placeholder'=>__('Description')))); ?>

                                    </div>
                                </td>
                                <td class="text-right amount">0.00</td>
                                <td>
                                    <a href="#" class="fas fa-trash text-danger" data-repeater-delete></a>
                                </td>
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td></td>
                                <td class="text-right"><strong><?php echo e(__('Total Credit')); ?> (<?php echo e(\Auth::user()->currencySymbol()); ?>)</strong></td>
                                <td class="text-right totalCredit">0.00</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td class="text-right"><strong><?php echo e(__('Total Debit')); ?> (<?php echo e(\Auth::user()->currencySymbol()); ?>)</strong></td>
                                <td class="text-right totalDebit">0.00</td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 text-right">
        <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn-create btn-xs badge-blue radius-10px">
        <input type="button" value="<?php echo e(__('Cancel')); ?>" onclick="location.href = '<?php echo e(route("journal-entry.index")); ?>';" class="btn-create btn-xs bg-gray radius-10px">
    </div>
    <?php echo e(Form::close()); ?>


<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/onamhamy/public_html/account/resources/views/journalEntry/create.blade.php ENDPATH**/ ?>