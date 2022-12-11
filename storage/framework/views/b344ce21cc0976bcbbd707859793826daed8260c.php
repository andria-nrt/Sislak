<div class="print_button">
  <button class="btn btn-info" onclick="printReport()"><i class="fa fa-print" aria-hidden="true"></i> Print</button>
</div>

<h5 class="company_name"><?php echo e($company_name); ?></h4>
<div class="title"><?php echo e($report_title); ?></div>
<?php if(!empty($report_head)): ?><div class="title small"><?php echo e($report_head); ?></div><?php endif; ?>
<div class="title small"><?php echo e($title_date); ?></div>

<table class="responsive table table-bordered">
  <thead>
    <tr>
      <?php if(empty($sl_id)): ?>
      <th width="20%" class="bg-light_2">Account Head</th>
      <?php endif; ?>
      <th width="8%" class="text-center bg-light_2">Tanggal</th>
      <th width="7%" class="text-center bg-light_2">Voucher</th>
      <th class="bg-light_2">Detail</th>
      <th class="bg-light_2">Keterangan</th>
      <th width="14%" class="text-right bg-light_2">Debit</th>
      <th width="14%" class="text-right bg-light_2">Kredit</th>
      <th width="14%" class="text-right bg-light_2">Saldo</th>
    </tr>
  </thead>
  <tbody>
<?php
  $ttlDebit = 0;
  $ttlCredit = 0;
  $balance = ($accHead->type_id<=2) ? $opening->debit_amount-$opening->credit_amount : $opening->credit_amount-$opening->debit_amount;
?>
    <tr>
      <?php if(empty($sl_id)): ?>
      <td><?php echo e($accHead->ledger_head); ?></td>
      <?php endif; ?>
      <td class="text-center"><?php echo e($from_date); ?></td>
      <td class="text-center">---</td>
      <td>Opening Balance</td>
      <td></td>
      <td class="text-right">---</td>
      <td class="text-right">---</td>
      <td class="text-right"><?php echo e(number_format($balance, 2)); ?></td>
    </tr>
<!-- Opening Entry -->
<?php $__currentLoopData = $opening_ledgers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ledger): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
      $ledger_date = new DateTime($ledger->transaction_date);
      $ledger_date = $ledger_date->format('d/m/Y');
      $ttlDebit += $ledger->debit_amount;
      $ttlCredit += $ledger->credit_amount;
      $balance += ($accHead->type_id<=2) ? $ledger->debit_amount-$ledger->credit_amount : $ledger->credit_amount-$ledger->debit_amount;
    ?>
    <tr>
      <?php if(empty($sl_id)): ?>
      <td><?php echo e(@$slHead[$ledger->sub_ledger]->ledger_head); ?></td>
      <?php endif; ?>
      <td class="text-center"><?php echo e($ledger_date); ?></td>
      <td class="text-center">---</td>
      <td>Opening Entry</td>
      <td></td>
      <td class="text-right"><?php echo e($ledger->debit_amount); ?></td>
      <td class="text-right"><?php echo e($ledger->credit_amount); ?></td>
      <td class="text-right"><?php echo e(number_format($balance, 2)); ?></td>
    </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<!-- Ledgers -->
<?php $__currentLoopData = $ledgers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ledger): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
      $ledger_date = new DateTime($ledger->transaction_date);
      $ledger_date = $ledger_date->format('d/m/Y');
      $ttlDebit += $ledger->debit_amount;
      $ttlCredit += $ledger->credit_amount;
      $balance += ($accHead->type_id<=2) ? $ledger->debit_amount-$ledger->credit_amount : $ledger->credit_amount-$ledger->debit_amount;
    ?>
    <tr>
      <?php if(empty($sl_id)): ?>
      <td><?php echo e(@$slHead[$ledger->sub_ledger]->ledger_head); ?></td>
      <?php endif; ?>
      <td class="text-center"><?php echo e($ledger_date); ?></td>
      <td class="text-center"><?php echo e($ledger->voucher_code); ?></td>
      <td><?php echo e(@$slHead[$ledger->particular_sl]->ledger_head); ?></td>
      <td><?php echo e($ledger->remarks); ?></td>
      <td class="text-right"><?php echo e($ledger->debit_amount); ?></td>
      <td class="text-right"><?php echo e($ledger->credit_amount); ?></td>
      <td class="text-right"><?php echo e(number_format($balance, 2)); ?></td>
    </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </tbody>
  <tfoot>
    <tr>
      <th class="text-right" colspan="<?php echo e(empty($sl_id)?5:4); ?>">Total</th>
      <th class="text-right">
       <?php if($set_currency->currency_position==2): ?><?php echo e($set_currency->symbol); ?><?php endif; ?> 
             <?php echo e(number_format($ttlDebit, 2)); ?>

            <?php if($set_currency->currency_position==1): ?><?php echo e($set_currency->symbol); ?><?php endif; ?>
           <?php echo e($set_currency->currency_text); ?>

       </th>
      <th class="text-right">
       <?php if($set_currency->currency_position==2): ?><?php echo e($set_currency->symbol); ?><?php endif; ?> 
            <?php echo e(number_format($ttlCredit, 2)); ?>

            <?php if($set_currency->currency_position==1): ?><?php echo e($set_currency->symbol); ?><?php endif; ?>
           <?php echo e($set_currency->currency_text); ?>

        </th>
      <th class="text-right">
       <?php if($set_currency->currency_position==2): ?><?php echo e($set_currency->symbol); ?><?php endif; ?> 
           <?php echo e(number_format($balance, 2)); ?>

            <?php if($set_currency->currency_position==1): ?><?php echo e($set_currency->symbol); ?><?php endif; ?>
           <?php echo e($set_currency->currency_text); ?>

         </th>
    </tr>
  </tfoot>
</table><?php /**PATH C:\xampp\htdocs\sislak\resources\views/accounts/reports/ledgerReport/report.blade.php ENDPATH**/ ?>