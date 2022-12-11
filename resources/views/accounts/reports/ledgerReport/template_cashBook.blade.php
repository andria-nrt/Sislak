@extends('expert.master')

@section('title', 'Cash Book - '.$settingsinfo->company_name.' - '.$settingsinfo->soft_name.'')

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
          <div class="card-header text-uppercase"> <i class="fa fa-eye"></i> Cash Book</div>
            <div class="card-body">

              <form id="report-form">
                <div class="row">
                  <div class="offset-md-2 col-md-3">
                    <select class="form-control select2" id="sl_id" name="sl_id">                      
                        <option value="{{$slLedger->id}}">{{$slLedger->ledger_code.' - '.$slLedger->ledger_head}}</option>
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
   

@include('expert.copyright')

@endsection

@section('js')
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
      if(!sl_id) {
        alert("Please select Subsidiary Ledger");
      } else if(!from_date) {
        alert("Please enter from date");
      } else if(!to_date) {
        alert("Please enter to date");
      } else {
        $("#report-view-card").show();
        $("#report-view").html('<div class="loader"></div>');

        $.ajax({
          url: '{{route("Accounts.ledgerReport")}}',
          data: {report_type: 2, sl_id: sl_id, from_date: from_date, to_date: to_date},
          success: function(data){
            $("#report-view").html(data);
          }
        });
      }
    });
  });
</script>
@endsection