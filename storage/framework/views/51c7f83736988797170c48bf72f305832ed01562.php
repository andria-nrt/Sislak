<?php $__env->startSection('title', 'Backup - '.$settingsinfo->company_name.' - '.$settingsinfo->soft_name.''); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('expert.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('expert.topbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php if($user_role_per->admin == 1): ?>

<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card bg-dark">
      		<div class="card-header border-0 bg-transparent text-white">
                <i class="fa fa-user-circle"></i><span> Backup Manage</span>
            </div>

            <div class="card">
            <div class="card-header"><div style="display:inline-block; padding-top:5px;"><i class="fa fa-table"></i> Backup List </div> 

            <a href="<?php echo e(url('admin/backup/create')); ?>" class="btn btn-dark btn-sm waves-effect waves-light pull-right"> <i class="fa fa-plus"></i> <span>Create New Backup</span>
            </a>

          </div>

          
            
            <div class="card-body">

              <?php if (session('message')): ?>
                <div class="alert alert-<?php echo e(session('class')); ?> alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  <div class="alert-icon contrast-alert"><i class="icon-close"></i></div>
                  <div class="alert-message"><span><?php echo e(session('message')); ?></span></div>
                </div>
              <?php endif; ?>

              <div class="table-responsive">
                
                <?php if(count($backups)): ?>

                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 5%; text-align: center;">SN</th>
                        <th style="width: 65%; text-align: left;">File</th>
                        <th style="width: 20%; text-align: center;">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=1; ?>
                    <?php $__currentLoopData = $backups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $backup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td style="width: 5%; text-align: center;"><?php echo e($i++); ?></td>
                            <td style="width: 65%; text-align: left;"><?php echo e($backup['file_name']); ?></td>
                           
                            <td style="width: 20%; text-align: center;">
                                <a class="btn btn-xs btn-success"
                                   href="<?php echo e(url('admin/backup/backup-download/'.$backup['file_name'])); ?>">
                                   <i class="fa fa-cloud-download"></i> 
                                   
                                   Download
                                </a>

                                <a class="btn btn-xs btn-danger" data-button-type="delete"
                                   href="<?php echo e(url('admin/backup/delete/'.$backup['file_name'])); ?>">
                                   <i class="fa fa-trash-o"></i>
                                    Delete
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="well">
                    <h4>There are no backups</h4>
                </div>
            <?php endif; ?>

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
   
   <?php endif; ?>

  <?php echo $__env->make('expert.copyright', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <?php $__env->stopSection(); ?>

  <?php $__env->startSection('js'); ?>
    <script>
    $(document).ready(function() {
        dataTableLoad({
        });
    });
    </script>
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('expert.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH N:\XAMPP-72\htdocs\TEST\ACCOUNTING\resources\views/backup/backups.blade.php ENDPATH**/ ?>