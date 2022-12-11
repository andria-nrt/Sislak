<select class="form-control select2" id="sl_id" name="sl_id">
    <option value=""><?php echo e($gl_id>0 ? ('All Subsidiary Ledger of '.$gl_name) : 'Pilih Buku Besar Pembantu'); ?></option>
    <?php $__currentLoopData = $slLedgers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $glName=>$slLedger): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <optgroup label="<?php echo e($glName); ?>">
    <?php $__currentLoopData = $slLedger; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slLedger): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                        
    <option value="<?php echo e($slLedger->id); ?>"><?php echo e($slLedger->ledger_code.' - '.$slLedger->ledger_head); ?></option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </optgroup>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>

<script type="text/javascript">
  $(document).ready(function(){
    $("#sl_id").select2();
  });
</script><?php /**PATH C:\xampp\htdocs\sislak\resources\views/accounts/reports/ledgerReport/gl_slLedger.blade.php ENDPATH**/ ?>