<?php $__env->startSection('title', 'Dashboard - '.$settingsinfo->company_name.' - '.$settingsinfo->soft_name.''); ?>

<?php $__env->startSection('content'); ?>

<body onload="info_noti()">

<?php echo $__env->make('expert.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('expert.topbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="clearfix"></div>
    
  <div class="content-wrapper">
    <div class="container-fluid">

      <!--Start Dashboard Content-->

      <div class="row">
        <div class="col-12 col-lg-12 col-xl-12">
          <div class="card bg-success" style="margin-bottom: 0px;">

           <div class="card-header bg-transparent text-white">
                    Accounts Dashboard 
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
                    <?php if($set_currency->currency_position==2): ?><?php echo e($set_currency->symbol); ?><?php endif; ?>
                        <?php echo e(number_format($cash_balance, 2)); ?> 
                    <?php if($set_currency->currency_position==1): ?><?php echo e($set_currency->symbol); ?><?php endif; ?> 
                        <?php echo e($set_currency->currency_text); ?>

                  </h6>
                  <span class="text-white">Cash in Hand</span>
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
                  <?php if($set_currency->currency_position==2): ?><?php echo e($set_currency->symbol); ?><?php endif; ?> <?php echo e(number_format($bank_balance, 2)); ?> 
                  <?php if($set_currency->currency_position==1): ?><?php echo e($set_currency->symbol); ?><?php endif; ?>
                  <?php echo e($set_currency->currency_text); ?>

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
                    <?php if($set_currency->currency_position==2): ?><?php echo e($set_currency->symbol); ?><?php endif; ?> 
                    <?php echo e(number_format($receivable_balance, 2)); ?> 
                    <?php if($set_currency->currency_position==1): ?><?php echo e($set_currency->symbol); ?><?php endif; ?>
                    <?php echo e($set_currency->currency_text); ?>

                  </h6>
                  <span class="text-white">Receivable</span>
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
                    <?php if($set_currency->currency_position==2): ?><?php echo e($set_currency->symbol); ?><?php endif; ?> <?php echo e(number_format($payable_balance, 2)); ?> 
                    <?php if($set_currency->currency_position==1): ?><?php echo e($set_currency->symbol); ?><?php endif; ?>
                    <?php echo e($set_currency->currency_text); ?>

                 </h6>
                  <span class="text-white">Payable</span>
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
            <div class="card-header text-uppercase">Income & Expense</div>
            <div class="card-body">
              <canvas id="incomeExpense"></canvas>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-6">
          <div class="card">
            <div class="card-header text-uppercase">Receivable & Payable</div>
            <div class="card-body">
              <canvas id="receivablePayable"></canvas>
            </div>
          </div>
        </div>

      </div>

      <div class="row">

        <div class="col-12 col-lg-6 col-xl-6">
          <div class="card">
            <div class="card-header text-uppercase">Cash Flow</div>
            <div class="card-body">
              <canvas id="cashInOut"></canvas>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-6">
          <div class="card">
            <div class="card-header text-uppercase">Cash Balance</div>
            <div class="card-body">
              <canvas id="cashBalance"></canvas>
            </div>
          </div>
        </div>

      </div>

      <!-- SAGOR-------------- -->

      <div class="row mt-4">
        <div class="col-12 col-lg-6 col-xl-3">
          <a href="<?php echo e(url('accounts/general_ledger')); ?>">
          <div class="card bg-purple shadow-purple">
            <div class="card-body">
              <div class="media">
              <div class="media-body text-left">
                <h6 class="text-white"><?php echo e($gelled); ?></h6>
                <span class="text-white">General Ledgers</span>
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
          <a href="<?php echo e(url('accounts/subsidiary_ledger')); ?>">
            <div class="card bg-info shadow-info">
              <div class="card-body">
                <div class="media">
                <div class="media-body text-left">
                  <h6 class="text-white"><?php echo e($sublegd); ?></h6>
                  <span class="text-white">Subsidiary Ledger </span>
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
          <a href="<?php echo e(url('accounts/chart_of_accounts')); ?>">
          <div class="card bg-danger shadow-danger">
            <div class="card-body">
              <div class="media">
                <div class="media-body text-left">
                  <h6 class="text-white"><?php echo e($cot); ?></h6>
                  <span class="text-white">Chart of Accounts </span>
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
          <a href="<?php echo e(url('accounts/balance_sheet')); ?>">
            <div class="card bg-success shadow-success">
              <div class="card-body">
                <div class="media">
                <div class="media-body text-left">
                  <?php $__currentLoopData = $accTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $accType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
   
                    <?php $ttlAmount = 0; ?>
                    <?php if(array_key_exists($accType->id, $glLedgers)): ?>
                    <?php $__currentLoopData = $glLedgers[$accType->id]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $glLedger): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php if(array_key_exists($glLedger->id, $slLedgers)): ?>
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
                      
                
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>


                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <h6 class="text-white">
                   <?php if($set_currency->currency_position==2): ?><?php echo e($set_currency->symbol); ?><?php endif; ?> <?php echo e(number_format($ttlAmount, 2)); ?> 
                    <?php if($set_currency->currency_position==1): ?><?php echo e($set_currency->symbol); ?><?php endif; ?>
                   <?php echo e($set_currency->currency_text); ?>

                </h6>
                  <span class="text-white">Balance</span>
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
          <a href="<?php echo e(url('accounts/payment_voucher')); ?>">
          <div class="card bg-purple shadow-purple">
            <div class="card-body">
              <div class="media">
              <div class="media-body text-left">
                <h6 class="text-white"><?php echo e($payvou); ?></h6>
                <span class="text-white">Payment Voucher</span>
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
        <a href="<?php echo e(url('accounts/receive_voucher')); ?>">
          <div class="card bg-info shadow-info">
            <div class="card-body">
              <div class="media">
              <div class="media-body text-left">
                <h6 class="text-white"><?php echo e($recvou); ?></h6>
                <span class="text-white">Receive Voucher </span>
              </div>
                  <div class="align-self-center" style="color: #ffffff;">
                    <i class="fa fa-repeat fa-2x"></i>
                  </div>
            </div>
            </div>
          </div>
        </a>
        </div>

        <div class="col-12 col-lg-6 col-xl-3">
          <a href="<?php echo e(url('accounts/journal_voucher')); ?>">
          <div class="card bg-danger shadow-danger">
            <div class="card-body">
              <div class="media">
        <div class="media-body text-left">
                <h6 class="text-white"><?php echo e($jorvou); ?></h6>
                <span class="text-white">Journal Voucher</span>
              </div>
                  <div class="align-self-center" style="color: #ffffff;">
                    <i class="fa fa-clone fa-2x"></i>
                  </div>
            </div>
            </div>
          </div>
        </a>
        </div>

        <div class="col-12 col-lg-6 col-xl-3">
          <a href="<?php echo e(url('accounts/contra_voucher')); ?>">
          <div class="card bg-success shadow-success">
            <div class="card-body">
              <div class="media">
              <div class="media-body text-left">
                <h6 class="text-white"><?php echo e($convou); ?></h6>
                <span class="text-white">Contra Voucher</span>
              </div>
                  <div class="align-self-center" style="color: #ffffff;">
                    <i class="fa fa-university fa-2x"></i>
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
   

  <?php echo $__env->make('expert.copyright', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <?php $__env->stopSection(); ?>

  <?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('/expert/assets/plugins/Chart.js/Chart.min.js')); ?>"></script>
    <script>
    $(document).ready(function() {
      //Income-Expense
      var ctx = document.getElementById('incomeExpense').getContext('2d');
      var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: ['<?php echo implode("','",$incExp_label); ?>'],
          datasets: [{
            label: 'Income',
            data: [<?php echo implode(',',$incExp_income); ?>],
            backgroundColor: "rgba(21, 202, 32, 0.5)",
            borderColor: "rgba(21, 202, 32)",
            borderWidth: 1
          }, {
            label: 'Expense',
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
            label: 'Receivable',
            data: [<?php echo implode(',',$recPay_receivable); ?>],
            backgroundColor: "rgba(0, 140, 255, 0.5)",
            borderColor: "rgba(0, 140, 255)",
            borderWidth: 1
          }, {
            label: 'Payable',
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
            label: 'Cash In',
            data: [<?php echo implode(',',$cashInOut_cashIn); ?>],
            backgroundColor: "rgba(56, 118, 129, 0.5)",
            borderColor: "rgba(56, 118, 129)",
            borderWidth: 1,
            type: 'bar'
          }, {
            label: 'Cash Out',
            data: [<?php echo implode(',',$cashInOut_cashOut); ?>],
            backgroundColor: "rgba(128, 0, 0, 0.5)",
            borderColor: "rgba(128, 0, 0)",
            borderWidth: 1,
            type: 'bar'
          },
          {
            label: 'Cash Balance',
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
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('expert.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH N:\XAMPP-72\htdocs\TEST\ACCOUNTING\resources\views/accounts/dashboard.blade.php ENDPATH**/ ?>