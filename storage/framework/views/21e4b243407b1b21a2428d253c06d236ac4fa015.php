

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
                <i class="fa fa-share"></i><span> Buku Besar Pembantu</span>
            </div>

            <div class="card">

            <div class="card-header">
              <div style="display:inline-block; padding-top:5px;">
                <i class="fa fa-table"></i> Daftar Buku Besar Pembantu
              </div> 
              <button type="button" class="btn btn-dark btn-sm waves-effect waves-light pull-right" id="addNew"> 
                <i class="fa fa-plus"></i> <span>Tambah Baru</span>
              </button>
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
                        
                        <th width="8%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; ?>
                    <?php $__currentLoopData = $subsidiaryLedger; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subsidiaryLedger): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($i++); ?></td>
                        <td><?php echo e($subsidiaryLedger->ledger_code); ?></td>
                        <td><?php echo e($subsidiaryLedger->ledger_head); ?></td>
                        <td><?php echo e($subsidiaryLedger->general_ledger_head); ?></td>
                        <td><?php echo e($subsidiaryLedger->type_name); ?></td>
   
                        <td>
                          <button type="button" class="btn btn-warning btn-sm waves-effect waves-light edit" data="<?php echo e($subsidiaryLedger->id); ?>"> 
                            <i class="fa fa-edit"></i> <span>Edit</span>
                          </button> 
                          <button type="button" class="btn btn-danger btn-sm waves-effect waves-light delete" data="<?php echo e($subsidiaryLedger->id); ?>"> 
                            <i class="fa fa-times"></i> <span>Hapus</span>
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
            curUrl: "<?php echo e(route('Accounts.subsidiary_ledger.index')); ?>",
            addUrl: "<?php echo e(route('Accounts.subsidiary_ledger.create')); ?>"
        });
    });
    </script>
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('expert.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/husnimubarok/Sites/localhost/caexpert/resources/views/accounts/subsidiaryLedger/index.blade.php ENDPATH**/ ?>