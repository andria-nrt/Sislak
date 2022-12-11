<!-- Start wrapper -->

 <div id="wrapper">

  <!--Start sidebar-wrapper -->
   <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true" class="border-right border-secondary-light">
     <div class="brand-logo bg-blue"><!-- bg-danger shadow-danger -->
      <a href="<?php echo e(url('/')); ?>">
     <img src="<?php echo e(asset('/logo/'.$settingsinfo->logo)); ?>"/>
     <!--   <h5 class="logo-text"> CA Expert Acc</h5>  -->
     </a>
   </div>

   <ul class="sidebar-menu do-nicescrol">
      
      <?php if($user_role_per->accounts == 1): ?>

      <!-- Accounts -->
      <li class="sidebar-header">Accounts</li>
      <li>
        <a href="<?php echo e(url('accounts/dashboard')); ?>" class="waves-effect">
          <i class="icon-home"></i><span>Accounts Dashboard</span>
        </a>
      </li>
      <li>
        <a href="#" class="waves-effect">
          <i class="fa fa-th-list"></i><span>Chart of Accounts</span><i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="sidebar-submenu">
          <li>
            <a href="<?php echo e(url('accounts/chart_of_accounts')); ?>"><i class="fa fa-th-list"></i> Chart of Accounts  </a>
          </li>
          <li>
            <a href="<?php echo e(url('accounts/account_types')); ?>"><i class="fa fa-arrows-h"></i> Account Types  </a>
          </li>
          <li>
            <a href="<?php echo e(url('accounts/general_ledger')); ?>"><i class="fa fa-file"></i> General Ledger  </a>
          </li>
          <li>
            <a href="<?php echo e(url('accounts/subsidiary_ledger')); ?>"><i class="fa fa-file-o"></i> Subsidiary Ledger  </a>
          </li>
        </ul>
      </li>


      <li>
        <a href="#" class="waves-effect">
          <i class="fa fa-puzzle-piece"></i><span>Configuration</span><i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="sidebar-submenu">
          <li>
            <a href="<?php echo e(url('accounts/head_configuration')); ?>"><i class="fa fa-cog"></i> Head Configuration</a>
          </li>
          <li>
            <a href="<?php echo e(url('accounts/migration')); ?>"><i class="fa fa-share"></i> Accounts Migration  </a>
          </li>
        </ul>
      </li>


      <li>
        <a href="#" class="waves-effect">
          <i class="fa fa-files-o"></i><span>Vouchers</span><i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="sidebar-submenu">
          <li>
            <a href="<?php echo e(url('accounts/payment_voucher')); ?>"><i class="fa fa-book"></i> Payment Voucher  </a>
          </li>
          <li>
            <a href="<?php echo e(url('accounts/receive_voucher')); ?>"><i class="fa fa-book"></i> Receive Voucher </a>
          </li>
          <li>
            <a href="<?php echo e(url('accounts/journal_voucher')); ?>"><i class="fa fa-book"></i> Journal Voucher </a>
          </li>
          <li>
            <a href="<?php echo e(url('accounts/contra_voucher')); ?>"><i class="fa fa-book"></i> Contra Voucher </a>
          </li>
        </ul>
      </li>
      <?php if($user_role_per->admin == 1): ?>
      <li>
        <a href="#" class="waves-effect">
          <i class="fa fa-check-square"></i><span>Reports</span><i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="sidebar-submenu">
          <li>
            <a href="<?php echo e(url('accounts/balance_sheet')); ?>"><i class="fa fa-window-restore"></i> Balance Sheet </a>
          </li>
          <li>
            <a href="<?php echo e(url('accounts/income_statement')); ?>"><i class="fa fa-window-restore"></i> Income Statement </a>
          </li>
          <li>
            <a href="<?php echo e(url('accounts/receipts_payments')); ?>"><i class="fa fa-window-restore"></i> Receipts &amp; Payments </a>
          </li>
          <li>
            <a href="<?php echo e(url('accounts/trial_balance')); ?>"><i class="fa fa-window-restore"></i> Trial Balance </a>
          </li>
          <li>
            <a href="<?php echo e(url('accounts/ledger_report')); ?>"><i class="fa fa-window-restore"></i> Ledger Report </a>
          </li>
          <li>
            <a href="<?php echo e(url('accounts/cash_book')); ?>"><i class="fa fa-window-restore"></i> Cash Book </a>
          </li>
          <li>
            <a href="<?php echo e(url('accounts/bank_book')); ?>"><i class="fa fa-window-restore"></i> Bank Book </a>
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
          <i class="fa fa-user-circle"></i><span>Designation </span>
        </a>
      </li>

      <li>
        <a href="<?php echo e(url('admin/usermanage')); ?>" class="waves-effect">
          <i class="fa fa-users"></i><span>User Manage</span>
        </a>
      </li>

      <li>
        <a href="<?php echo e(url('admin/currency')); ?>">
            <i class="fa fa-usd"></i> Currency 
        </a>
      </li>

      
      <li>
        <a href="<?php echo e(url('admin/settings')); ?>">
            <i class="fa fa-cogs"></i> Settings 
        </a>
      </li>

      <li>
        <a href="<?php echo e(url('admin/systemlogs')); ?>">
            <i class="fa fa-list"></i> Logs 
          </a>
      </li>


      <li>
        <a href="<?php echo e(url('admin/backup')); ?>">
            <i class="fa fa-database"></i> Backup 
        </a>
      </li>

      <?php endif; ?>

     

    </ul>

   </div>

<!-- End sidebar-wrapper
<?php /**PATH N:\XAMPP-72\htdocs\TEST\ACCOUNTING\resources\views/expert/sidebar.blade.php ENDPATH**/ ?>