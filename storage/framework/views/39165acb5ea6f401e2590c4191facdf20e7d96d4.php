

<?php $__env->startSection('title', 'Jurnal Umum - '.$settingsinfo->company_name.' - '.$settingsinfo->soft_name.''); ?>

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
                <i class="fa fa-share"></i><span> Konfigurasi Kepala Akun</span>
            </div>

            <div class="card">
                <div class="card-body">
                  <form method="post" action="<?php echo e(route('Accounts.headConfigUpdate')); ?>">
                    <?php echo csrf_field(); ?>
                    <?php $__currentLoopData = $configs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $config): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="row">
                        <?php $i=0; ?>
                        <?php $__currentLoopData = $config; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $config): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-6">
                            <div class="form-group row">
                              <label for="basic-input" class="<?php if($i==0): ?><?php echo e('offset-sm-1'); ?><?php endif; ?> col-sm-7 col-form-label"><?php echo e($config->particular_name.' ('.(($config->coa_level==2)?'General Ledger':'Subsidiary Ledger').')'); ?></label>
                              <div class="<?php echo e(($i==0) ? 'col-sm-4' : 'col-sm-4'); ?>">
                                <input type="text" name="<?php echo e($config->particular); ?>" value="<?php echo e($config->account_code); ?>" class="form-control">
                              </div>
                            </div>
                        </div>
                        <?php $i++; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <button type="submit" class="btn btn-primary shadow-primary px-5"><i class="icon-lock"></i> Simpan</button>
                        </div>
                    </div>
                  </form>
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
    <?php if(session('configMsg')): ?>
    <script>
    $(document).ready(function() {
        Lobibox.notify('success', {
            pauseDelayOnHover: true,
            continueDelayOnInactiveTab: false,
            position: 'top right',
            icon: 'fa fa-check-circle',
            msg: "<?php echo e(session('configMsg')); ?>"
        });
    });
    </script>
    <?php endif; ?>
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('expert.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/husnimubarok/Sites/localhost/caexpert/resources/views/accounts/configs/head_configuration.blade.php ENDPATH**/ ?>