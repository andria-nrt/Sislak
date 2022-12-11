

<?php $__env->startSection('title', 'Buku Besar Pembantu - '.$settingsinfo->company_name.' - '.$settingsinfo->soft_name.''); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('expert.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('expert.topbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card bg-dark">
      		<div class="card-header border-0 bg-transparent text-white">
                <i class="fa fa-share"></i><span> Migrasi Akun</span>
            </div>

            <div class="card">

            <div class="card-header">
              <div style="display:inline-block; padding-top:5px;">
                <i class="fa fa-table"></i> Daftar Buku Besar Pembantu
              </div> 
              <button type="button" class="btn btn-dark btn-sm waves-effect waves-light pull-right" id="addNew"> 
                <span>Change</span>
              </button>
              <span class="pull-right" style="margin-top: 6px; margin-right: 15px;">Tanggal Pembukaan: <?php echo e($opening_date); ?></span>
            </div>

            <div class="card-body">
              <div class="table-responsive">
              <table id="dataTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th width="5%">SN</th>
                        <th>Kode Buku Besar</th>
                        <th>Buku Besar Pembantu</th>
                        <th>Jurnal Umum</th>
                        <th>Jenis Akun</th>
                        <th>Tanggal Pembukaan</th>
                        <th>Nominal Pembukaan</th>
                        
                        <th width="8%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; ?>
                    <?php $__currentLoopData = $subsidiaryLedger; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subsidiaryLedger): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                    if(array_key_exists($subsidiaryLedger->id, $openingData)) {
                      $openingDt = $openingData[$subsidiaryLedger->id];
                      $amount = ($openingDt->acc_type<=2) ? $openingDt->debit_amount-$openingDt->credit_amount : $openingDt->credit_amount-$openingDt->debit_amount;

                      $date = new DateTime($openingDt->transaction_date);
                      $date = $date->format('d/m/Y');
                    } else {
                      $date = '---';
                      $amount = 0;
                    }
                    
                    ?>
                    <tr>
                        <td><?php echo e($i++); ?></td>
                        <td><?php echo e($subsidiaryLedger->ledger_code); ?></td>
                        <td><?php echo e($subsidiaryLedger->ledger_head); ?></td>
                        <td><?php echo e($subsidiaryLedger->general_ledger_head); ?></td>
                        <td><?php echo e($subsidiaryLedger->type_name); ?></td>
                        <td><?php echo e($date); ?></td>
                        <td>
<?php if($set_currency->currency_position==2): ?><?php echo e($set_currency->symbol); ?><?php endif; ?> 
<?php echo e($amount); ?> 
<?php if($set_currency->currency_position==1): ?><?php echo e($set_currency->symbol); ?><?php endif; ?> 
<?php echo e($set_currency->currency_text); ?></td>
   
                        <td>
                          <button type="button" class="btn btn-warning btn-sm waves-effect waves-light edit" data="<?php echo e($subsidiaryLedger->id); ?>"> 
                            <i class="fa fa-edit"></i> <span>Migrate</span>
                          </button>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            </div>
            </div>
          </div>
               
          </div>
        </div>
      </div><!--End Row-->
	  
       <!--End Dashboard Content-->

    </div>
    <!-- End container-fluid-->
    
    </div><!--End content-wrapper-->
   

  <?php echo $__env->make('expert.copyright', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <?php $__env->stopSection(); ?>

  <?php $__env->startSection('js'); ?>
    <script>
    $(document).ready(function() {
        dataTableLoad({
            curUrl: "<?php echo e(route('Accounts.migration.index')); ?>",
            addUrl: "<?php echo e(route('Accounts.migration.create')); ?>"
        });
    });
    </script>
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('expert.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/husnimubarok/Sites/localhost/caexpert/resources/views/accounts/migration/index.blade.php ENDPATH**/ ?>