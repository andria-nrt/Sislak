<?php $__env->startSection('title', 'System Logs - '.$settingsinfo->company_name.' - '.$settingsinfo->soft_name.''); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('expert.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('expert.topbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<style type="text/css">

.table-responsive {
    white-space: normal;
}
</style>

<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card bg-dark">
      		<div class="card-header border-0 bg-transparent text-white">
                <i class="fa fa-university"></i><span> System Logs</span>
            </div>

            <div class="card">

            <div class="card-header">
              <div style="display:inline-block; padding-top:5px;">
                <i class="fa fa-table"></i> Logs List
              </div> 
             
            </div>

            <div class="card-body">
              <div class="table-responsive">
              <table id="dataTable" class="table table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th style="width: 5%;">SN</th>
                        <th style="width: 15%;">Tanggal</th>
                        <th style="width: 10%;">ID - User </th>
                        <th style="width: 15%;">Menu</th>
                        <th style="width: 10%;">Aksi</th>
                        <th style="width: 35%;">Changes</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; ?>
                    <?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $logdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($i++); ?></td>
                        <td><?php echo e($logdata->date_time); ?></td>
                        <td><?php echo e($logdata->user_id); ?> - <?php echo e($logdata->user_name); ?></td>
                        <td><?php echo e($logdata->table); ?></td>
                        <td><?php echo e($logdata->action); ?></td>
                        <td><?php echo trim($logdata->changes); ?></td>
                        
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
            curUrl: "<?php echo e(route('Admin.userrole.index')); ?>",
            addUrl: "<?php echo e(route('Admin.userrole.create')); ?>"
        });
    });
    </script>
  <?php $__env->stopSection(); ?>


<?php echo $__env->make('expert.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sislak\resources\views/admin/systemlogs.blade.php ENDPATH**/ ?>