<div class="print_button">
  <button class="btn btn-info" onclick="printReport()"><i class="fa fa-print" aria-hidden="true"></i> Print</button>
</div>

<h5 class="company_name"><?php echo e($company_name); ?></h4>
<div class="title">Receipts &amp; Payments</div>
<div class="title small"><?php echo e($title_date); ?></div>

<table class="responsive table table-bordered">
  <tbody>
<?php $__currentLoopData = [1=>'Receipts', 2=>'Payments']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$recPay): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <?php $ttlAmount = 0; ?>
    <tr>
      <td colspan="2" class="bg-light_1"><b><?php echo e($recPay); ?></b></td>
    </tr>
    <tr>
      <td class="pl-4 bg-light_2"><b>Detail</b></td>
      <td width="20%" class="text-right bg-light_2"><b>AmoNominalunt</b></td>
    </tr>
    <?php if($index==1): ?>
      <?php if(array_key_exists($cash_glId, $slLedgers)): ?>
      <?php
      $ttlGl = 0;
      $html = '';
      $i=0;
      foreach($slLedgers[$cash_glId] as $slLedger) {
        $amount = (array_key_exists($slLedger->id, $cash_opening)) ? $cash_opening[$slLedger->id]->balanceAmount : 0;
        $html .= '<tr>';
        $html .= '<td class="pl-4"><span class="pl-4">'.$slLedger->ledger_head.'</span></td>';
        $html .= '<td class="text-right">'.number_format($amount, 2).'</td>';
        $html .= '</tr>';
        $ttlGl += $amount;
      }
      $ttlAmount += $ttlGl;
      ?>
      <tr>
        <td class="pl-4"><b>Opening Balance</b></td>
        <td class="text-right"><b><?php echo e(number_format($ttlGl, 2)); ?></b></td>
      </tr>
      <?php echo $html; ?>
      <?php endif; ?>
    <?php endif; ?>

    <?php $__currentLoopData = $accTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $accType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php if(array_key_exists($accType->id, $glLedgers)): ?>
      <?php $__currentLoopData = $glLedgers[$accType->id]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $glLedger): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(array_key_exists($glLedger->id, $slLedgers)): ?>
        <?php
        $ttlGl = 0;
        $html = '';
        $i=0;
        foreach($slLedgers[$glLedger->id] as $slLedger) {
          $amount = 0;
          if(array_key_exists($slLedger->id, $ledgers)) {
            $amount = $ledgers[$slLedger->id];
            $amount = ($index==1) ? $amount->credit_amount : $amount->debit_amount;
          }
          if($amount!=0) {
            $html .= '<tr>';
            $html .= '<td class="pl-4"><span class="pl-4">'.$slLedger->ledger_head.'</span></td>';
            $html .= '<td class="text-right">'.number_format($amount, 2).'</td>';
            $html .= '</tr>';
            $ttlGl += $amount;
          }
        }
        $ttlAmount += $ttlGl;
        ?>
        <?php if(!empty($html)): ?>
        <tr>
          <td class="pl-4"><b><?php echo e($glLedger->ledger_head); ?></b></td>
          <td class="text-right"><b><?php echo e(number_format($ttlGl, 2)); ?></b></td>
        </tr>
        <?php echo $html; ?>
        <?php endif; ?>
        <?php endif; ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php if($index==2): ?>
      <?php if(array_key_exists($cash_glId, $slLedgers)): ?>
      <?php
      $ttlGl = 0;
      $html = '';
      $i=0;
      foreach($slLedgers[$cash_glId] as $slLedger) {
        $amount = (array_key_exists($slLedger->id, $cash_closing)) ? $cash_closing[$slLedger->id]->balanceAmount : 0;
        $html .= '<tr>';
        $html .= '<td class="pl-4"><span class="pl-4">'.$slLedger->ledger_head.'</span></td>';
        $html .= '<td class="text-right">'.number_format($amount, 2).'</td>';
        $html .= '</tr>';
        $ttlGl += $amount;
      }
      $ttlAmount += $ttlGl;
      ?>
      <tr>
        <td class="pl-4"><b>Closing Balance</b></td>
        <td class="text-right"><b><?php echo e(number_format($ttlGl, 2)); ?></b></td>
      </tr>
      <?php echo $html; ?>
      <?php endif; ?>
    <?php endif; ?>
  
    <tr>
      <td class="text-right"><b>Total</b></td>
      <td class="text-right"><span class="double-border"><b>
  <?php if($set_currency->currency_position==2): ?><?php echo e($set_currency->symbol); ?><?php endif; ?> 
            <?php echo e(number_format($ttlAmount, 2)); ?>

            <?php if($set_currency->currency_position==1): ?><?php echo e($set_currency->symbol); ?><?php endif; ?>
           <?php echo e($set_currency->currency_text); ?>     
     
    </b></span></td>
    </tr>
    <?php if($index==1): ?>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </tbody>
</table><?php /**PATH C:\xampp\htdocs\sislak\resources\views/accounts/reports/receiptsPayments/report.blade.php ENDPATH**/ ?>