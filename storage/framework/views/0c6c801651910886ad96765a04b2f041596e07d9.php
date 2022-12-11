<?php $__env->startSection('title', 'Balance Sheet - '.$settingsinfo->company_name.' - '.$settingsinfo->soft_name.''); ?>

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
          <div class="card-header text-uppercase"> <i class="fa fa-eye"></i> Balance Sheet</div>
            <div class="card-body">

              <form id="report-form">
                <div class="row">
                  <div class="offset-md-3 col-md-4">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Select Date</span>
                      </div>
                      <input type="text" class="form-control" name="date" id="date" autocomplete="off">
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
    $('#date').datepicker({
      format: 'd/m/yyyy',
      autoclose: true,
      todayHighlight: true
    });

    $("#report-btn").click(function(e){
      e.preventDefault();
      var date = $("#date").val();
      if(!date) {
        alert("Please enter date");
      } else {
        $("#report-view-card").show();
        $("#report-view").html('<div class="loader"></div>');

        $.ajax({
          url: '<?php echo e(route("Accounts.balanceSheet")); ?>',
          data: {date: date},
          success: function(data){
            $("#report-view").html(data);
          }
        });
      }
    });
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('expert.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sislak\resources\views/accounts/reports/balanceSheet/template.blade.php ENDPATH**/ ?>