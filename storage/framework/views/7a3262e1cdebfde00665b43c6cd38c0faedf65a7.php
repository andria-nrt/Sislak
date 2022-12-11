<form action="<?php echo e(route('Accounts.subsidiary_ledger.store')); ?>" method="post">
    <?php echo csrf_field(); ?>
    <div class="modal-header bg-dark">
        <h5 class="modal-title text-white"><i class="fa fa-plus"></i> Tambah Baru</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Tutup">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="modal-body">
        <div id="validate-error"></div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="general_ledger_id">Jurnal Umum</label>
                    <select class="form-control" id="general_ledger_id" name="general_ledger_id" required="">
                        <option value="">Pilh Jurnal Umum</option>
                        <?php $__currentLoopData = $generalLedgers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $accTypeName=>$generalLedger): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <optgroup label="<?php echo e($accTypeName); ?>">
                        <?php $__currentLoopData = $generalLedger; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $generalLedger): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                        
                        <option value="<?php echo e($generalLedger->id); ?>"><?php echo e($generalLedger->ledger_code.' - '.$generalLedger->ledger_head); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </optgroup>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="ledger_code">Kode Buku Besar Pembantu</label>
                    <input readonly="" type="text" class="form-control" id="ledger_code" name="ledger_code" placeholder="Kode Buku Besar Pembantu">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="ledger_head">Nama Buku Besar Pembantu</label>
                    <input required="" type="text" class="form-control" id="ledger_head" name="ledger_head" placeholder="Masukan Nama Buku Besar Pembantu">
                </div>
            </div>
            
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-inverse-dark" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
        <button type="submit" class="btn btn-dark"><i class="fa fa-check-square-o"></i> Simpan</button>
    </div>
</form>

<script>
$(document).ready(function() {
    $("#general_ledger_id").select2();

    $("#general_ledger_id").change(function(){
        var general_ledger_id = $(this).val();
        if(general_ledger_id) {
            $.ajax({
                url: "<?php echo e(url('accounts/subsidiary_ledger_code')); ?>",
                data: {glId: general_ledger_id},
                dataType: "json",
                success: function(data){
                    $("#ledger_code").val(data.code);
                }
            });
        } else {
            $("#ledger_code").val("");
        }
    });
});
</script><?php /**PATH C:\xampp\htdocs\sislak\resources\views/accounts/subsidiaryLedger/create.blade.php ENDPATH**/ ?>