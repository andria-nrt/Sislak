<?php $__env->startSection('title', 'Settings - '.$settingsinfo->company_name.' - '.$settingsinfo->soft_name.''); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('expert.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('expert.topbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<style type="text/css">
  table.dataTable tbody tr td {
    word-wrap: break-word;
    word-break: break-all;
}
</style>

<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card bg-dark">
      		<div class="card-header border-0 bg-transparent text-white">
                <i class="fa fa-university"></i><span> Pengaturan</span>
            </div>

            <div class="card">

            <div class="card-header">
              <div style="display:inline-block; padding-top:5px;">
                <i class="fa fa-table"></i> Pengaturan Aplikasi
              </div> 
             
            </div>

            <div class="card-body">

          <?php if (session('message')): ?>
              <div class="alert alert-<?php echo e(session('class')); ?> alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <div class="alert-icon contrast-alert"><i class="icon-close"></i></div>
                <div class="alert-message"><span><?php echo e(session('message')); ?></span></div>
              </div>
        <?php endif; ?>

  <form action="<?php echo e(url('admin/settingsupdate')); ?>" enctype="multipart/form-data" method="post">
    <?php echo csrf_field(); ?>
    

    <div class="modal-body">
        <div id="validate-error"></div>
        <div class="row">

             

            
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Nama Perusahaan</label>
                    <input required="" type="text" class="form-control" id="company_name" name="company_name" placeholder="Enter Company name" value="<?php echo e($settings->company_name); ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="designation">Nomer Telepon</label>
                    <input required="" type="number" class="form-control" id="phone" name="phone" placeholder="Enter Phone" value="<?php echo e($settings->phone); ?>">
                </div>
            </div>

            
            <div class="col-md-6">
                <div class="form-group">
                    <label for="mobile">Email</label>
                    <input required="" type="email" class="form-control" id="email" name="email" placeholder="Enter Telephone Number" value="<?php echo e($settings->email); ?>">
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-group">
                    <label for="address">Alamat</label>
                    <input class="form-control" id="address" name="address" placeholder="Enter Address" value="<?php echo e($settings->address); ?>">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="images">Logo</label>
                      <input type="file" class="form-control" class="form-control" id="logo" name="logo">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="images">Favicon</label>
                      <input type="file" class="form-control" class="form-control" id="favicon" name="favicon">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group" align="center">
                      <img src="<?php echo e(asset('/logo/'.$settings->logo)); ?>" class="img-responsive" style="background-color: #515151;" >
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group" align="center">
                    <img src="<?php echo e(asset('/favicon/'.$settings->favicon)); ?>" class="img-responsive" style="background-color: #515151;" >
                </div>
            </div>


            
            
        </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-dark"><i class="fa fa-check-square-o"></i> Update</button>
    </div>
</form>
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


<?php echo $__env->make('expert.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sislak\resources\views/admin/settings.blade.php ENDPATH**/ ?>