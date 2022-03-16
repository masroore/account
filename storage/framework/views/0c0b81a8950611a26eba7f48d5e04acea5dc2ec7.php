<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Student Ledger')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-button'); ?>

    <div class="row d-flex justify-content-end">
        <div class="col-auto">
            <?php echo e(Form::open(array('route' => array('report.ledger'),'method' => 'GET','id'=>'report_ledger'))); ?>

            <div class="all-select-box">
                <div class="btn-box">
                    <?php echo e(Form::label('start_date', __('Start Date'),['class'=>'text-type'])); ?>

                    <?php echo e(Form::date('start_date','', array('class' => 'month-btn form-control'))); ?>

                </div>
            </div>
        </div>
        <div class="col-auto">
            <div class="all-select-box">
                <div class="btn-box">
                    <?php echo e(Form::label('end_date', __('End Date'),['class'=>'text-type'])); ?>

                    <?php echo e(Form::date('end_date','', array('class' => 'month-btn form-control'))); ?>

                </div>
            </div>
        </div>
        
        <div class="col-auto my-auto">
            <a href="#" class="apply-btn" onclick="document.getElementById('report_ledger').submit(); return false;" data-toggle="tooltip" data-original-title="<?php echo e(__('apply')); ?>">
                <span class="btn-inner--icon"><i class="fas fa-search"></i></span>
            </a>
            <a href="<?php echo e(route('report.ledger')); ?>" class="reset-btn" data-toggle="tooltip" data-original-title="<?php echo e(__('Reset')); ?>">
                <span class="btn-inner--icon"><i class="fas fa-trash-restore-alt"></i></span>
            </a>
            <a href="#" class="action-btn" onclick="saveAsPDF()" data-toggle="tooltip" data-original-title="<?php echo e(__('Download')); ?>">
                <span class="btn-inner--icon"><i class="fas fa-download"></i></span>
            </a>
             <a href="<?php echo e(route('file-export')); ?>?start_date=<?php echo isset($_GET['start_date'])? $_GET['start_date']: ''; ?>&end_date=<?php echo isset($_GET['end_date'])? $_GET['end_date'] : ''; ?>&search_text=<?php echo isset($_GET['search_text'])? $_GET['search_text'] : ''; ?>&account=<?php echo isset($_GET['account'])? $_GET['account'] : ''; ?>" class="apply-btn" data-toggle="tooltip" data-original-title="Export Excel">
                <span class="btn-inner--icon"><i class="fas fa-download"></i></span>
            </a>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php $__currentLoopData = $studentledger; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
     <div id="printableArea">
         <div class="row mt-4">
            <div class="col">
                <div class="card p-4 mb-4">
                    <h5 class="report-text gray-text mb-0"><?php echo e(__('Student No')); ?> :</h5>
                    <h5 class="report-text mb-0"><?php echo e($item->student_id); ?></h5>
                </div>
            </div>

            <div class="col">
                <div class="card p-4 mb-4">
                    <h5 class="report-text gray-text mb-0"><?php echo e(__('Duration')); ?> :</h5>
                    <h5 class="report-text mb-0"><?php echo e(\Auth::user()->dateFormat($item->create_date)); ?> to <?php echo e(\Auth::user()->dateFormat($item->modify_date)); ?></h5>
                </div>
            </div>
        </div>
     </div>  
     
     <div class="row mt-4">
                <div class="col">
                    <div class="card p-4 mb-4">
                        <h5 class="report-text gray-text mb-0">Student name :</h5>
                        <h5 class="report-text mb-0"><?php echo e($item->name); ?></h5>
                    </div>
                </div>

                <div class="col">
                    <div class="card p-4 mb-4">
                        <h5 class="report-text gray-text mb-0">Father Name :</h5>
                        <h5 class="report-text mb-0"><?php echo e($item->name); ?></h5>
                    </div>
                </div>
                <div class="col">
                    <div class="card p-4 mb-4">
                        <h5 class="report-text gray-text mb-0">Class :</h5>
                        <h5 class="report-text mb-0"><?php echo e($item->classes); ?></h5>
                    </div>
                </div>
                <div class="col">
                    <div class="card p-4 mb-4">
                        <h5 class="report-text gray-text mb-0">Status :</h5>
                        <h5 class="report-text mb-0"><?php echo e($item->active); ?></h5>
                    </div>
                </div>

                <div class="col">
                    <div class="card p-4 mb-4">
                        <h5 class="report-text gray-text mb-0">Date :</h5>
                        <h5 class="report-text mb-0"><?php echo e(\Auth::user()->dateFormat($item->create_date)); ?></h5>
                    </div>
                </div>
            </div>
            
  <div class="row mt-4">
        <div class="col-12 mb-4">
             <table class="table table-responsive">
                    <thead>
                    <tr>
                        <th></th>
                        <th> #</th>
                        <th> Date</th>
                        <th> Type</th>
                        <th> Vr .No</th>
                        <th> Narration</th>
                        <th>Debit</th>
                        <th>Credit</th>
                        <th>Balance</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td><?php echo e(AUth::user()->journalNumberFormat($item->journal_id)); ?></td>
                            <td><?php echo e(\Auth::user()->dateFormat($item->transaction_date)); ?></td>
                            <td></td>
                            <td><?php echo e($item->accounts_reg); ?></td>
                            <td></td>
                            <td><?php echo e(\Auth::user()->priceFormat($item->debit)); ?></td>
                            <td><?php echo e(\Auth::user()->priceFormat($item->credit)); ?></td>
                            <!--<td><?php echo e(\Auth::user()->priceFormat($item->balance)); ?></td>-->
                            <td><?php echo e(\Auth::user()->priceFormat($item->debit - $item->credit)); ?></td>
                        </tr>
                        <?php $__currentLoopData = $studentsledger; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td></td>
                            <td><?php echo e(AUth::user()->journalNumberFormat($items->journal_entries_id)); ?></td>
                            <td><?php echo e(\Auth::user()->dateFormat($items->date)); ?></td>
                            <td></td>
                            <td><?php echo e($items->narration); ?></td>
                            <td></td>
                            <td><?php echo e(\Auth::user()->priceFormat($items->debit)); ?></td>
                            <td><?php echo e(\Auth::user()->priceFormat($items->credit)); ?></td>
                            <!--<td><?php echo e(\Auth::user()->priceFormat($item->balance)); ?></td>-->
                            <td><?php echo e(\Auth::user()->priceFormat($items->debit - $item->credit)); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                    </tbody>  
            </table>        
        </div>    
    </div>
     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/onamhamy/public_html/account/resources/views/report/student_ledger.blade.php ENDPATH**/ ?>