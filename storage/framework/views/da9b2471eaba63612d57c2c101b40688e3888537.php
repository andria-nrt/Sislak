<!-- Start wrapper -->

 <div id="wrapper">

  <!--Start sidebar-wrapper -->
   <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true" class="border-right border-secondary-light">
     <div class="brand-logo bg-black"><!-- bg-danger shadow-danger -->
      <a href="<?php echo e(url('/')); ?>">
     <img src="<?php echo e(asset('/logo/logo2.png')); ?>"/>
     <!--   <h5 class="logo-text"> CA Expert Acc</h5>  -->
     </a>
   </div>

   <ul class="sidebar-menu do-nicescrol">
      
      <?php if($user_role_per->accounts == 1): ?>

      <!-- Accounts -->
      <li class="sidebar-header">Pengguna</li>
      <li>
        <a href="<?php echo e(url('accounts/dashboard')); ?>" class="waves-effect">
          <i class="icon-home"></i><span>Dashboard</span>
        </a>
      </li>
      <li>
        <a href="#" class="waves-effect">
          <i class="fa fa-th-list"></i><span>Bagan Akun</span><i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="sidebar-submenu">
          <li>
            <a href="<?php echo e(url('accounts/chart_of_accounts')); ?>"><i class="fa fa-th-list"></i> Bagan Akun  </a>
          </li>
          <li>
            <a href="<?php echo e(url('accounts/account_types')); ?>"><i class="fa fa-arrows-h"></i> Jenis Akun  </a>
          </li>
          <li>
            <a href="<?php echo e(url('accounts/general_ledger')); ?>"><i class="fa fa-file"></i> Buku Besar  </a>
          </li>
          <li>
            <a href="<?php echo e(url('accounts/subsidiary_ledger')); ?>"><i class="fa fa-file-o"></i> Buku Besar Pembantu  </a>
          </li>
        </ul>
      </li>


      <li>
        <a href="#" class="waves-effect">
          <i class="fa fa-puzzle-piece"></i><span>Konfigurasi</span><i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="sidebar-submenu">
          <li>
            <a href="<?php echo e(url('accounts/head_configuration')); ?>"><i class="fa fa-cog"></i> Konfigurasi Kepala Akun</a>
          </li>
        </ul>
      </li>


      <li>
        <a href="#" class="waves-effect">
          <i class="fa fa-files-o"></i><span>Voucher</span><i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="sidebar-submenu">
          <li>
            <a href="<?php echo e(url('accounts/payment_voucher')); ?>"><i class="fa fa-book"></i> Voucher Pembayaran  </a>
          </li>
          <li>
            <a href="<?php echo e(url('accounts/receive_voucher')); ?>"><i class="fa fa-book"></i> Voucher Penerimaan</a>
          </li>
          <!-- <li>
            <a href="<?php echo e(url('accounts/journal_voucher')); ?>"><i class="fa fa-book"></i> Jurnal Voucher  </a>
          </li> -->
          <!-- <li>
            <a href="<?php echo e(url('accounts/contra_voucher')); ?>"><i class="fa fa-book"></i> Kontra Voucher </a>
          </li> -->
        </ul>
      </li>
      <?php if($user_role_per->admin == 1): ?>
      <li>
        <a href="#" class="waves-effect">
          <i class="fa fa-check-square"></i><span>Laporan</span><i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="sidebar-submenu">
          <li>
            <a href="<?php echo e(url('accounts/balance_sheet')); ?>"><i class="fa fa-window-restore"></i> Neraca </a>
          </li>
          <li>
            <a href="<?php echo e(url('accounts/income_statement')); ?>"><i class="fa fa-window-restore"></i> Laporan Laba Rugi </a>
          </li>
          <li>
            <a href="<?php echo e(url('accounts/receipts_payments')); ?>"><i class="fa fa-window-restore"></i> Penerimaan &amp; Pembayaran </a>
          </li>
          <li>
            <a href="<?php echo e(url('accounts/trial_balance')); ?>"><i class="fa fa-window-restore"></i> Neraca saldo </a>
          </li>
          <li>
            <a href="<?php echo e(url('accounts/ledger_report')); ?>"><i class="fa fa-window-restore"></i> Laporan Buku Besar </a>
          </li>
        </ul>
      </li>
      <?php endif; ?>

      <?php endif; ?>

      <?php if($user_role_per->admin == 1): ?>
      <!-- Admin -->
      <li class="sidebar-header">ADMIN</li>

      <li>
        <a href="<?php echo e(url('admin/userrole')); ?>" class="waves-effect">
          <i class="fa fa-user-circle"></i><span>Penamaan </span>
        </a>
      </li>

      <li>
        <a href="<?php echo e(url('admin/usermanage')); ?>" class="waves-effect">
          <i class="fa fa-users"></i><span>Kelola Pengguna</span>
        </a>
      </li>

      <?php endif; ?>

     

    </ul>

   </div>

<!-- End sidebar-wrapper
<?php /**PATH C:\xampp\htdocs\sislak\resources\views/expert/sidebar.blade.php ENDPATH**/ ?>