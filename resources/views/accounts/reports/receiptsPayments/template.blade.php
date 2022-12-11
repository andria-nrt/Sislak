@extends('expert.master')

@section('title', 'Receipts & Payments - '.$settingsinfo->company_name.' - '.$settingsinfo->soft_name.'')

@section('content')

@include('expert.sidebar')

@include('expert.topbar')

<div class="clearfix"></div>
  
<div class="content-wrapper">
  <div class="container-fluid">
    <div class="row">
      <!-- Form -->
      <div class="col-lg-12" id="report-template">
        <div class="card">
          <div class="card-header text-uppercase"> <i class="fa fa-eye"></i> Receipts &amp; Payments</div>
            <div class="card-body">

              <form id="report-form">
                <div class="row">
                  <div class="offset-md-2 col-md-6">
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
   

@include('expert.copyright')

@endsection

@section('js')
<script type="text/javascript">
  $(document).ready(function(){
    $('.input-daterange').datepicker({
      format: 'd/m/yyyy',
      autoclose: true,
      todayHighlight: true
    });

    $("#report-btn").click(function(e){
      e.preventDefault();
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
          url: '{{route("Accounts.receiptsPayments")}}',
          data: {from_date: from_date, to_date: to_date},
          success: function(data){
            $("#report-view").html(data);
          }
        });
      }
    });
  });
</script>
@endsection