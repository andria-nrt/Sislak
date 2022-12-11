<!-- 

<?php $__env->startSection('title', 'Currency Setting - '.$settingsinfo->company_name.' - '.$settingsinfo->soft_name.''); ?>

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
                <i class="fa fa-university"></i><span> Currency Setting</span>
            </div>

            <div class="card">

          

            <div class="card-body">

          <?php if (session('message')): ?>
              <div class="alert alert-<?php echo e(session('class')); ?> alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <div class="alert-icon contrast-alert"><i class="icon-close"></i></div>
                <div class="alert-message"><span><?php echo e(session('message')); ?></span></div>
              </div>
        <?php endif; ?>

  <form action="<?php echo e(url('admin/currencyupdate')); ?>" id="currencyform" enctype="multipart/form-data" method="post">
    <?php echo csrf_field(); ?>
    

    <div class="modal-body">
        <div id="validate-error"></div>
        <div class="row">

            <div class="col-md-3">
                <div class="form-group">
                    <label for="user_role"> Currency</label>
                    <select required="" type="text" class="form-control" id="currency" name="currency">
                        <option value="<?php echo e($currency_setting->currency); ?>"><?php echo e($currency_setting->name); ?> - <?php echo e($currency_setting->currency_name); ?> </option>
                        <option disabled="" value="">----------------------</option>
                        <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currenciesdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($currenciesdata->id); ?>">
                            <?php echo e($currenciesdata->name); ?> - <?php echo e($currenciesdata->currency_name); ?>

                        </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>

            
            <div class="col-md-3">
              <div id="showcursymbol_result">
                <div class="form-group">
                    <label for="symbol">Symbol</label>
                    <input required="" type="text" class="form-control" id="symbol" name="symbol" placeholder="Enter Symbol" value="<?php echo e($currency_setting->symbol); ?>" required="">
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div id="show_cur_text">
                <div class="form-group">
                    <label for="symbol">Currency Text</label>
                    <input required="" type="text" class="form-control" id="currency_text" name="currency_text" placeholder="Enter Currency Text" value="<?php echo e($currency_setting->currency_text); ?>" required="">
                </div>
              </div>
            </div>
            
    

            <div class="col-md-3">
                <div class="form-group">
                    <label for="user_role"> Currency Position </label>
                    <select required="" type="text" class="form-control" id="currency_position" name="currency_position">
                        <option value="<?php if($currency_setting->currency_position==1): ?>
                          1
                          <?php else: ?>
                          2
                          <?php endif; ?>"><?php if($currency_setting->currency_position==1): ?>
                          Before
                          <?php else: ?>
                          After
                          <?php endif; ?>
                        </option>
                        <option disabled="">------------------</option>
                        <option value="1">Before</option>
                        <option value="2">After</option>
                    </select>
                </div>
            </div>

            
            
            

            
            
        </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-dark">
          <i class="fa fa-check-square-o"></i> Update 
        </button>
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
  
  <?php $__env->startSection('js'); ?>
  <script type="text/javascript">
    $(document).ready(function() {
        $("#currency").select2();
        $("#currency_position").select2();
    });

    $("#currency").on('change',function(){
    //alert($(this).val());
    var id = document.getElementById("currency").value;
        $.ajax({
            url: "<?php echo e(url('admin/showcursymbol')); ?>",
            data: {id: id},
            success: function(data){
        $("#currencyform").find("#showcursymbol_result").html(data);
        showcurrency_text(id);
        }
        });

    });

    function showcurrency_text (id) {
      //alert(id);
       
        $.ajax({
            url: "<?php echo e(url('admin/showcurtext')); ?>",
            data: {id: id},
            success: function(data){
        $("#currencyform").find("#show_cur_text").html(data);
        }
        });

    }

    
</script>
<?php $__env->stopSection(); ?>
 -->

<?php echo $__env->make('expert.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sislak\resources\views/admin/currency.blade.php ENDPATH**/ ?>