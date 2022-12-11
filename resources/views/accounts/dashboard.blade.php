@extends('expert.master')

@section('title', 'Dashboard - '.$settingsinfo->company_name.' - '.$settingsinfo->soft_name.'')

@section('content')

<body onload="info_noti()">

@include('expert.sidebar')

@include('expert.topbar')

<div class="clearfix"></div>
    
  <div class="content-wrapper">
    <div class="container-fluid">

      <!--Start Dashboard Content-->

      <div class="row">
        <div class="col-12 col-lg-12 col-xl-12">
          <div class="card bg-success" style="margin-bottom: 0px;">

           <div class="card-header bg-transparent text-white">
                    Dashboard 
           </div>
             
          </div>
        </div>
      </div><!--End Row-->

      <div class="row mt-4">

        <div class="col-12 col-lg-6 col-xl-3">
          <a href="#">
          <div class="card bg-purple shadow-purple">
            <div class="card-body">
              <div class="media">
                <div class="media-body text-left">
                  <h6 class="text-white">
                    @if($set_currency->currency_position==2){{$set_currency->symbol}}@endif
                        {{number_format($cash_balance, 2)}} 
                    @if($set_currency->currency_position==1){{$set_currency->symbol}}@endif 
                        {{$set_currency->currency_text}}
                  </h6>
                  <span class="text-white">Tunai</span>
                </div>
                <div class="align-self-center" style="color: #ffffff;">
                  <i class="fa fa-list-ul fa-2x"></i>
                </div>
              </div>
            </div>
          </div>
          </a>
        </div>
        <div class="col-12 col-lg-6 col-xl-3">
          <a href="#">
          <div class="card bg-info shadow-info">
            <div class="card-body">
              <div class="media">
                <div class="media-body text-left">
                  <h6 class="text-white">
                  @if($set_currency->currency_position==2){{$set_currency->symbol}}@endif {{number_format($bank_balance, 2)}} 
                  @if($set_currency->currency_position==1){{$set_currency->symbol}}@endif
                  {{$set_currency->currency_text}}
                </h6>
                  <span class="text-white">Bank</span>
                </div>
                <div class="align-self-center" style="color: #ffffff;">
                  <i class="fa fa-list-ul fa-2x"></i>
                </div>
              </div>
            </div>
          </div>
          </a>
        </div>
        <div class="col-12 col-lg-6 col-xl-3">
          <a href="#">
          <div class="card bg-danger shadow-danger">
            <div class="card-body">
              <div class="media">
                <div class="media-body text-left">
                  <h6 class="text-white">
                    @if($set_currency->currency_position==2){{$set_currency->symbol}}@endif 
                    {{number_format($receivable_balance, 2)}} 
                    @if($set_currency->currency_position==1){{$set_currency->symbol}}@endif
                    {{$set_currency->currency_text}}
                  </h6>
                  <span class="text-white">Piutang</span>
                </div>
                <div class="align-self-center" style="color: #ffffff;">
                  <i class="fa fa-list-ul fa-2x"></i>
                </div>
              </div>
            </div>
          </div>
          </a>
        </div>
        <div class="col-12 col-lg-6 col-xl-3">
          <a href="#">
          <div class="card bg-success shadow-success">
            <div class="card-body">
              <div class="media">
                <div class="media-body text-left">
                  <h6 class="text-white">
                    @if($set_currency->currency_position==2){{$set_currency->symbol}}@endif {{number_format($payable_balance, 2)}} 
                    @if($set_currency->currency_position==1){{$set_currency->symbol}}@endif
                    {{$set_currency->currency_text}}
                 </h6>
                  <span class="text-white">Hutang</span>
                </div>
                <div class="align-self-center" style="color: #ffffff;">
                  <i class="fa fa-list-ul fa-2x"></i>
                </div>
              </div>
            </div>
          </div>
          </a>
        </div>

      </div> 

      <div class="row">

        <div class="col-12 col-lg-6 col-xl-6">
          <div class="card">
            <div class="card-header text-uppercase">Pendapatan & Pengeluaran</div>
            <div class="card-body">
              <canvas id="incomeExpense"></canvas>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-6">
          <div class="card">
            <div class="card-header text-uppercase">Diterima & Dibayarkan</div>
            <div class="card-body">
              <canvas id="receivablePayable"></canvas>
            </div>
          </div>
        </div>

      </div>

      <div class="row">

        <div class="col-12 col-lg-6 col-xl-6">
          <div class="card">
            <div class="card-header text-uppercase">Alur Keuangan</div>
            <div class="card-body">
              <canvas id="cashInOut"></canvas>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-6">
          <div class="card">
            <div class="card-header text-uppercase">Saldo</div>
            <div class="card-body">
              <canvas id="cashBalance"></canvas>
            </div>
          </div>
        </div>

      </div>

      <!-- SAGOR-------------- -->

      <div class="row mt-4">
        <div class="col-12 col-lg-6 col-xl-3">
          <a href="{{url('accounts/general_ledger')}}">
          <div class="card bg-purple shadow-purple">
            <div class="card-body">
              <div class="media">
              <div class="media-body text-left">
                <h6 class="text-white">{{$gelled}}</h6>
                <span class="text-white">Jurnal Umum</span>
              </div>
                  <div class="align-self-center" style="color: #ffffff;">
                    <i class="fa fa-list-ul fa-2x"></i>
                  </div>
            </div>
            </div>
          </div>
          </a>
        </div>

        <div class="col-12 col-lg-6 col-xl-3">
          <a href="{{url('accounts/subsidiary_ledger')}}">
            <div class="card bg-info shadow-info">
              <div class="card-body">
                <div class="media">
                <div class="media-body text-left">
                  <h6 class="text-white">{{$sublegd}}</h6>
                  <span class="text-white">Buku Besar Pembantu </span>
                </div>
                    <div class="align-self-center" style="color: #ffffff;">
                      <i class="fa fa-list fa-2x"></i>
                    </div>
              </div>
              </div>
            </div>
          </a>
        </div>

        <div class="col-12 col-lg-6 col-xl-3">
          <a href="{{url('accounts/chart_of_accounts')}}">
          <div class="card bg-danger shadow-danger">
            <div class="card-body">
              <div class="media">
                <div class="media-body text-left">
                  <h6 class="text-white">{{$cot}}</h6>
                  <span class="text-white">Bagan Akun</span>
                </div>
                  <div class="align-self-center" style="color: #ffffff;">
                    <i class="fa fa-list-alt fa-2x"></i>
                  </div>
            </div>
            </div>
          </div>
        </a>
        </div>

        <div class="col-12 col-lg-6 col-xl-3">
          <a href="{{url('accounts/balance_sheet')}}">
            <div class="card bg-success shadow-success">
              <div class="card-body">
                <div class="media">
                <div class="media-body text-left">
                  @foreach($accTypes as $accType)
   
                    <?php $ttlAmount = 0; ?>
                    @if(array_key_exists($accType->id, $glLedgers))
                    @foreach($glLedgers[$accType->id] as $glLedger)
                      @if(array_key_exists($glLedger->id, $slLedgers))
                      <?php
                      $ttlGl = 0;
                      $i=0;
                      foreach($slLedgers[$glLedger->id] as $slLedger) {
                        $amount = 0;
                        if(array_key_exists($slLedger->id, $ledgers)) {
                          $amount = $ledgers[$slLedger->id];
                          $amount = ($slLedger->type_id==1) ? $amount->debit_amount-$amount->credit_amount : $amount->credit_amount-$amount->debit_amount;
                        }
                        //Surplus
                        if($surplus_id==$slLedger->id) {
                          $amount += $surplusBalance->balanceAmount;
                        }
                        $ttlGl += $amount;
                      }
                      $ttlAmount += $ttlGl;
                      ?>
                      
                
                    @endif
                    @endforeach
                    @endif


                    @endforeach
                  <h6 class="text-white">
                   @if($set_currency->currency_position==2){{$set_currency->symbol}}@endif {{number_format($ttlAmount, 2)}} 
                    @if($set_currency->currency_position==1){{$set_currency->symbol}}@endif
                   {{$set_currency->currency_text}}
                </h6>
                  <span class="text-white">Saldo</span>
                </div>
                    <div class="align-self-center" style="color: #ffffff;">
                      <i class="fa fa-credit-card-alt fa-2x"></i>
                    </div>
              </div>
              </div>
            </div>
          </a>

        

        </div>


        <div class="col-12 col-lg-6 col-xl-3">
          <a href="{{url('accounts/payment_voucher')}}">
          <div class="card bg-purple shadow-purple">
            <div class="card-body">
              <div class="media">
              <div class="media-body text-left">
                <h6 class="text-white">{{$payvou}}</h6>
                <span class="text-white">Voucher Pembayaran</span>
              </div>
                  <div class="align-self-center" style="color: #ffffff;">
                    <i class="fa fa-undo fa-2x"></i>
                  </div>
            </div>
            </div>
          </div>
          </a>
        </div>

    <div class="col-12 col-lg-6 col-xl-3">
        <a href="{{url('accounts/receive_voucher')}}">
          <div class="card bg-info shadow-info">
            <div class="card-body">
              <div class="media">
              <div class="media-body text-left">
                <h6 class="text-white">{{$recvou}}</h6>
                <span class="text-white">Voucher Penerimaan</span>
              </div>
                  <div class="align-self-center" style="color: #ffffff;">
                    <i class="fa fa-repeat fa-2x"></i>
                  </div>
            </div>
            </div>
          </div>
        </a>
        </div>
       

        

        

      <!--End Row-->

       <!--End Dashboard Content-->

    </div>
    <!-- End container-fluid-->
    
    </div><!--End content-wrapper-->
   

  @include('expert.copyright')

  @endsection

  @section('js')
    <script src="{{ asset('/expert/assets/plugins/Chart.js/Chart.min.js') }}"></script>
    <script>
    $(document).ready(function() {
      //Income-Expense
      var ctx = document.getElementById('incomeExpense').getContext('2d');
      var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: ['<?php echo implode("','",$incExp_label); ?>'],
          datasets: [{
            label: 'Pendapatan',
            data: [<?php echo implode(',',$incExp_income); ?>],
            backgroundColor: "rgba(21, 202, 32, 0.5)",
            borderColor: "rgba(21, 202, 32)",
            borderWidth: 1
          }, {
            label: 'Pengeluaran',
            data: [<?php echo implode(',',$incExp_expense); ?>],
            backgroundColor: "rgba(253, 53, 81, 0.5)",
            borderColor: "rgba(253, 53, 81)",
            borderWidth: 1
          }]
        }
      });

      //Receivable-Payable
      var ctx = document.getElementById('receivablePayable').getContext('2d');
      var myChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: ['<?php echo implode("','",$recPay_label); ?>'],
          datasets: [{
            label: 'Piutang',
            data: [<?php echo implode(',',$recPay_receivable); ?>],
            backgroundColor: "rgba(0, 140, 255, 0.5)",
            borderColor: "rgba(0, 140, 255)",
            borderWidth: 1
          }, {
            label: 'Hutang',
            data: [<?php echo implode(',',$recPay_payable); ?>],
            backgroundColor: "rgba(184, 28, 255, 0.5)",
            borderColor: "rgba(184, 28, 255)",
            borderWidth: 1
          }]
        }
      });

      //CashIn-CashOut
      var ctx = document.getElementById('cashInOut').getContext('2d');
      var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: ['<?php echo implode("','",$cashInOut_label); ?>'],
          datasets: [{
            label: 'Pemasukan',
            data: [<?php echo implode(',',$cashInOut_cashIn); ?>],
            backgroundColor: "rgba(56, 118, 129, 0.5)",
            borderColor: "rgba(56, 118, 129)",
            borderWidth: 1,
            type: 'bar'
          }, {
            label: 'Pengeluaran',
            data: [<?php echo implode(',',$cashInOut_cashOut); ?>],
            backgroundColor: "rgba(128, 0, 0, 0.5)",
            borderColor: "rgba(128, 0, 0)",
            borderWidth: 1,
            type: 'bar'
          },
          {
            label: 'Saldo',
            data: [<?php echo implode(',',$cashInOut_cashBalance); ?>],
            borderColor: "rgba(184, 28, 255)",
            borderWidth: 1,
            type: 'line'
          }]
        }
      });

      //Cash-Balance
      var ctx = document.getElementById('cashBalance').getContext('2d');
      var myChart = new Chart(ctx, {
        type: 'polarArea',
        data: {
          labels: ['<?php echo implode("','",$cashB_label); ?>'],
          datasets: [{
            backgroundColor: ['<?php echo implode("','",$cashB_color); ?>'],
            data: [<?php echo implode(',',$cashB_balance); ?>]
          }]
        }
      });


    });
    </script>
  @endsection