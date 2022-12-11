<form action="<?php echo e(route('Accounts.general_ledger.update', $generalLedger->id)); ?>" method="put">
    <?php echo csrf_field(); ?>
    <div class="modal-header bg-dark">
        <h5 class="modal-title text-white"><i class="fa fa-edit"></i> Update</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Tutup">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="modal-body">
        <div id="validate-error"></div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="type_id">Jenis Akun</label>
                    <select class="form-control" id="type_id" name="type_id" required="">
                        <option value="">Pilih Jenis Akun</option>
                        <?php $__currentLoopData = $accTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $accType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                        
                        <option <?php if($generalLedger->type_id==$accType->id): ?><?php echo e('selected'); ?><?php endif; ?> value="<?php echo e($accType->id); ?>"><?php echo e($accType->type_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="ledger_code">Kode Buku Besar</label>
                    <input readonly="" type="text" class="form-control" id="ledger_code" name="ledger_code" placeholder="Kode Buku Besar" value="<?php echo e($generalLedger->ledger_code); ?>">
                    <input type="hidden" id="ledger_code_exist" value="<?php echo e($generalLedger->ledger_code); ?>">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="ledger_head">Nama Buku Besar</label>
                    <input required="" type="text" class="form-control" id="ledger_head" name="ledger_head" placeholder="Masukan Nama Buku Besar" value="<?php echo e($generalLedger->ledger_head); ?>">
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
    $("#type_id").change(function(){
        var type_id = $(this).val();
        if(type_id) {
            if(type_id==<?php echo e($generalLedger->type_id); ?>) {
                $("#ledger_code").val($("#ledger_code_exist").val());
            } else {
                $.ajax({
                    url: "<?php echo e(url('accounts/general_ledger_code')); ?>",
                    data: {typeId: type_id},
                    dataType: "json",
                    success: function(data){
                        $("#ledger_code").val(data.code);
                    }
                });
            }
        } else {
            $("#ledger_code").val("");
        }
    });
});
</script><?php /**PATH C:\xampp\htdocs\sislak\resources\views/accounts/generalLedger/edit.blade.php ENDPATH**/ ?>