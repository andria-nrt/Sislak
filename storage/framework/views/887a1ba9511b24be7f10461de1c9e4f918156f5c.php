<!--Start topbar header-->
<header class="topbar-nav">
 <nav class="navbar navbar-expand fixed-top bg-danger" style="background: #0a51a1 !important;">
  <ul class="navbar-nav mr-auto align-items-center">
    <li class="nav-item">
      <a class="nav-link toggle-menu" href="javascript:void();">
       <i class="icon-menu menu-icon"></i>
     </a>
    </li>
<!--     <li class="nav-item" style="padding: 10px;background: #ffffff;border-radius: 5px;">
      <h5 style="color: #223035;transform: translate(0,18%);">
       <?php echo e($settingsinfo->company_name); ?> 
     </h5>
    </li> -->
  </ul>
     
  <ul class="navbar-nav align-items-center right-nav-link">
   


    <li class="nav-item">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="index3.html#">
        <span class="user-profile">
          <i class="fa fa-user-circle-o fa-lg img-circle"></i>
          <!-- <img src="<?php echo e(asset('/expert/assets/images/avatars/avataruser.png')); ?>" class="img-circle" alt="user avatar"> -->
        </span> <?php echo e(Auth::user()->name); ?>

      </a>

      <ul class="dropdown-menu dropdown-menu-right animated fadeIn">
       <li class="dropdown-item user-details">
        <a href="javaScript:void();">
           <div class="media">
             <div class="avatar"><img class="align-self-start mr-3" src="<?php echo e(asset('/expert/assets/images/avatars/avataruser.png')); ?>" alt="user avatar"></div>
            <div class="media-body">
            <h6 class="mt-2 user-title">
              <?php echo e(Auth::user()->name); ?>

            </h6>
            <p class="user-subtitle">
              <?php echo e(Auth::user()->email); ?>

            </p>
            </div>
           </div>
          </a>
        </li>
        <li class="dropdown-divider"></li>
        <!-- <li class="dropdown-item">
          <a href="<?php echo e(url('logout')); ?>">
            <i class="fa fa-user-circle mr-2"></i>
              My Profile
          </a>
        </li> -->

         <li class="dropdown-item">
          <a href="<?php echo e(url('admin/profileupdate')); ?>">
            <i class="fa fa-user mr-2"></i>
             Profile update
          </a>
        </li>
        <li class="dropdown-divider"></li>

        <li class="dropdown-item">
          <a href="<?php echo e(url('admin/changepassword')); ?>">
            <i class="fa fa-key mr-2"></i>
              Change password
          </a>
        </li>
        <li class="dropdown-divider"></li>

       

        <li class="dropdown-item">
          <a href="<?php echo e(url('logout')); ?>">
            <i class="icon-power mr-2"></i> Logout
          </a>
        </li>
      </ul>

    </li>


  </ul>
</nav>
</header>
<!--End topbar header--><?php /**PATH N:\XAMPP-72\htdocs\TEST\ACCOUNTING\resources\views/expert/topbar.blade.php ENDPATH**/ ?>