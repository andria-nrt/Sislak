<?php $__env->startSection('title', 'Jenis Akun - '.$settingsinfo->company_name.' - '.$settingsinfo->soft_name.''); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('expert.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('expert.topbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<style type="text/css" id="treeview5-style"> 
  .treeview .list-group-item{cursor:pointer}.treeview span.indent{margin-left:20px;margin-right:20px}.treeview span.icon{width:12px;margin-right:10px}.treeview .node-disabled{color:silver;cursor:not-allowed}.node-treeview5{color:#000;}.node-treeview5:not(.node-disabled):hover{background-color:#F5F5F5;} 

  .list-group-item > .badge {
    float: right;
}

.badge {
    display: inline-block;
    min-width: 10px;
    padding: 3px 7px;
    font-size: 12px;
    font-weight: bold;
    line-height: 1;
    color: 
#fff;
text-align: center;
white-space: nowrap;
vertical-align: baseline;
background-color:
    #777;
    border-radius: 3px;
}
</style>


<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card bg-dark">
      		<div class="card-header border-0 bg-transparent text-white">
                <i class="fa fa-share"></i><span> Bagan Akun</span>
            </div>

            <div class="card">

            <div class="card-body">
              <div id="treeview5" class="treeview"></div>
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
      <?php $coa = [1=>'Asset', 2=>'Expense', 3=>'Liability', 4=>'Income']; ?>

      $('#treeview5').treeview({
        color: "#000",
        expandIcon: 'fa fa-angle-double-right',
        collapseIcon: 'fa fa-angle-double-down',
        nodeIcon: 'fa fa-clone',
        showTags: true,
        levels: 3,
        data: [
          <?php $__currentLoopData = $accountTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $accountType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          {
            text: '<?php echo e($accountType->type_code." - ".$accountType->type_name); ?>',
            tags: ['<?php echo e($coa[$accountType->id]); ?>'],
            <?php if(array_key_exists($accountType->id, $generalLedgers)): ?>
            nodes: [
              <?php $__currentLoopData = $generalLedgers[$accountType->id]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $generalLedger): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              {
                text: '<?php echo e($generalLedger->ledger_code." - ".$generalLedger->ledger_head); ?>',
                tags: ['<?php echo e($coa[$accountType->id]); ?>'],
                <?php if(array_key_exists($generalLedger->id, $subsidiaryLedgers)): ?>
                nodes: [
                  <?php $__currentLoopData = $subsidiaryLedgers[$generalLedger->id]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subsidiaryLedger): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  {
                    text: '<?php echo e($subsidiaryLedger->ledger_code." - ".$subsidiaryLedger->ledger_head); ?>',
                    tags: ['<?php echo e($coa[$accountType->id]); ?>']
                  },
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                ]
                <?php endif; ?>
              },
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            ]
            <?php endif; ?>
          },
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        ]
      });
    });
    </script>
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('expert.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sislak\resources\views/accounts/chartOfAccounts/index.blade.php ENDPATH**/ ?>