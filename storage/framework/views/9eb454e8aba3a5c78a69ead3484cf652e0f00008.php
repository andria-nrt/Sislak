<?php echo $__env->make('expert.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php echo $__env->yieldContent('content'); ?>

    <div class="modal fade" id="darkmodal">
      <div class="modal-dialog modal-lg">
        <div class="modal-content border-dark"></div>
      </div>
    </div>

<?php echo $__env->make('expert.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH N:\XAMPP-72\htdocs\TEST\ACCOUNTING\resources\views/expert/master.blade.php ENDPATH**/ ?>