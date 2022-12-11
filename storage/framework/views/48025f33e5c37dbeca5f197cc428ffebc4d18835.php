<div class="print_button">
  <button class="btn btn-info" onclick="printReport()"><i class="fa fa-print" aria-hidden="true"></i> Print</button>
</div>

<h5 class="company_name"><?php echo e($company_name); ?></h4>
<div class="title">Trial Balance</div>
<div class="title small"><?php echo e($title_date); ?></div>

<table class="responsive table table-bordered">
  <tbody>
  <?php $ttlDebit = 0; $ttlCredit = 0; ?>
  <tr>
    <td class="pl-4 bg-light_2"><b>Detail</b></td>
    <td width="15%" class="text-right bg-light_2"><b>Debit Amount</b></td>
    <td width="15%" class="text-right bg-light_2"><b>Credit Amount</b></td>
  </tr>
<?php $__currentLoopData = $accTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $accType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if(array_key_exists($accType->id, $glLedgers)): ?>
    <?php $__currentLoopData = $glLedgers[$accType->id]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $glLedger): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php if(array_key_exists($glLedger->id, $slLedgers)): ?>
      <?php
      $ttlGl_dr = 0; $ttlGl_cr = 0;
      $html = '';
      $i=0;
      foreach($slLedgers[$glLedger->id] as $slLedger) {
        if(array_key_exists($slLedger->id, $ledgers)) {
          $amount = $ledgers[$slLedger->id];
          $dr_amount = $amount->debit_amount;
          $cr_amount = $amount->credit_amount;
        } else {
          $dr_amount = 0;
          $cr_amount = 0;
        }
        if($dr_amount!=0 || $cr_amount!=0) {
          $html .= '<tr>';
          $html .= '<td class="pl-4"><span class="pl-4">'.$slLedger->ledger_head.'</span></td>';
          $html .= '<td class="text-right">'.number_format($dr_amount, 2).'</td>';
          $html .= '<td class="text-right">'.number_format($cr_amount, 2).'</td>';
          $html .= '</tr>';
          $ttlGl_dr += $dr_amount;
          $ttlGl_cr += $cr_amount;
        }
      }
      $ttlDebit += $ttlGl_dr;
      $ttlCredit += $ttlGl_cr;
      ?>
      <?php if(!empty($html)): ?>
      <tr>
        <td class="pl-4"><b><?php echo e($glLedger->ledger_head); ?></b></td>
        <td class="text-right"><b><?php echo e(number_format($ttlGl_dr, 2)); ?></b></td>
        <td class="text-right"><b><?php echo e(number_format($ttlGl_cr, 2)); ?></b></td>
      </tr>
      <?php echo $html; ?>
      <?php endif; ?>
      <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <tr>
      <td class="text-right"><b>Total</b></td>
      <td class="text-right"><span class="double-border"><b>
 <?php if($set_currency->currency_position==2): ?><?php echo e($set_currency->symbol); ?><?php endif; ?> 
           <?php echo e(number_format($ttlDebit, 2)); ?> 
            <?php if($set_currency->currency_position==1): ?><?php echo e($set_currency->symbol); ?><?php endif; ?>
           <?php echo e($set_currency->currency_text); ?>

     
    </b></span></td>
      <td class="text-right"><span class="double-border"><b>
         <?php if($set_currency->currency_position==2): ?><?php echo e($set_currency->symbol); ?><?php endif; ?> 
           <?php echo e(number_format($ttlCredit, 2)); ?>

            <?php if($set_currency->currency_position==1): ?><?php echo e($set_currency->symbol); ?><?php endif; ?>
           <?php echo e($set_currency->currency_text); ?>

      
    </b></span></td>
    </tr>
  </tbody>
</table><?php /**PATH C:\xampp\htdocs\sislak\resources\views/accounts/reports/trialBalance/report.blade.php ENDPATH**/ ?>