<?php $__env->startSection('title', 'Bank Book - '.$settingsinfo->company_name.' - '.$settingsinfo->soft_name.''); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('expert.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('expert.topbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="clearfix"></div>
  
<div class="content-wrapper">
  <div class="container-fluid">
    <div class="row">
      <!-- Form -->
      <div class="col-lg-12" id="report-template">
        <div class="card">
          <div class="card-header text-uppercase"> <i class="fa fa-eye"></i> Bank Book</div>
            <div class="card-body">

              <form id="report-form">
                <div class="row">
                  <div class="offset-md-2 col-md-3">
                    <select class="form-control select2" id="sl_id" name="sl_id">
                        <option value="">All Bank</option>
                        <?php $__currentLoopData = $slLedgers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slLedger): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                        
                        <option value="<?php echo e($slLedger->id); ?>"><?php echo e($slLedger->ledger_code.' - '.$slLedger->ledger_head); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  </div>

                  <div class="col-md-4">
                    <div class="input-daterange input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Select Date</span>
                      </div>
                      <input type="text" class="form-control" name="from_date" id="from_date" autocomplete="off">
                      <div class="input-group-prepend">
                        <span class="input-group-text">To</span>
                      </div>
                      <input type="text" class="form-control" name="to_date" id="to_date" autocomplete="off">
                    </div>
                  </div>
                  <div class="col-md-2 pl-0">
                    <button type="button" id="report-btn" class="btn btn-gradient-yoda waves-effect waves-light">View Report</button>
                  </div>
                </div>
              </form>

            </div>
        </div>
      </div>
      <!-- Report View -->
      <div class="col-lg-12" id="report-view-card" style="display:none;">
        <div class="card">
            <div class="card-body" id="report-view"></div>
        </div>
      </div>
    </div><!--End Row-->
  </div>
</div><!--End content-wrapper-->
   

<?php echo $__env->make('expert.copyright', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script type="text/javascript">
  $(document).ready(function(){
    $(".select2").select2();

    $('.input-daterange').datepicker({
      format: 'd/m/yyyy',
      autoclose: true,
      todayHighlight: true
    });

    $("#report-btn").click(function(e){
      e.preventDefault();
      var sl_id = $("#sl_id").val();
      var from_date = $("#from_date").val();
      var to_date = $("#to_date").val();
      if(!from_date) {
        alert("Please enter from date");
      } else if(!to_date) {
        alert("Please enter to date");
      } else {
        $("#report-view-card").show();
        $("#report-view").html('<div class="loader"></div>');

        $.ajax({
          url: '<?php echo e(route("Accounts.ledgerReport")); ?>',
          data: {report_type: 3, gl_id: '<?php echo e($gl_id); ?>', sl_id: sl_id, from_date: from_date, to_date: to_date},
          success: function(data){
            $("#report-view").html(data);
          }
        });
      }
    });
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('expert.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sislak\resources\views/accounts/reports/ledgerReport/template_bankBook.blade.php ENDPATH**/ ?>