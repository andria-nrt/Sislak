<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
  <title><?php echo $__env->yieldContent('title'); ?></title>
  <!--favicon-->
  <link rel="icon" href="<?php echo e(asset('/favicon/'.$settingsinfo->favicon)); ?>" type="image/x-icon">
  <!-- Bootstrap core CSS-->
  <link href="<?php echo e(asset('/expert/assets/css/bootstrap.min.css')); ?>" rel="stylesheet"/>

  <!--Select Plugins-->
  <link href="<?php echo e(asset('/expert/assets/plugins/select2/css/select2.min.css')); ?>" rel="stylesheet" />
  
  <!--Bootstrap Datepicker-->
  <link href="<?php echo e(asset('/expert/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')); ?>" rel="stylesheet" type="text/css">
  <!--Data Tables -->
  <link href="<?php echo e(asset('/expert/assets/plugins/bootstrap-datatable/css/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet" type="text/css">
  
  <!-- animate CSS-->
  <link href="<?php echo e(asset('/expert/assets/css/animate.css')); ?>" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="<?php echo e(asset('/expert/assets/css/icons.css')); ?>" rel="stylesheet" type="text/css"/>
  <!-- Custom Style-->
  <link href="<?php echo e(asset('/expert/assets/css/app-style.css')); ?>" rel="stylesheet"/>

  <!-- Vector CSS -->
  <link href="<?php echo e(asset('/expert/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css')); ?>" rel="stylesheet"/>
  <!-- simplebar CSS-->
  <link href="<?php echo e(asset('/expert/assets/plugins/simplebar/css/simplebar.css')); ?>" rel="stylesheet"/>
  <!-- Sidebar CSS-->
  <link href="<?php echo e(asset('/expert/assets/css/sidebar-menu.css')); ?>" rel="stylesheet"/>
  <!-- notifications css -->
  <link rel="stylesheet" href="<?php echo e(asset('/expert/assets/plugins/notifications/css/lobibox.min.css')); ?>"/>

  <link href="<?php echo e(asset('/expert/assets/css/custom.css')); ?>" rel="stylesheet"/>
  <link href="<?php echo e(asset('/expert/assets/plugins/summernote/dist/summernote-bs4.css')); ?>" rel="stylesheet"/>


    <?php echo $__env->yieldContent('script'); ?>  
    <?php echo $__env->yieldContent('css'); ?>  
</head>

<body><?php /**PATH N:\XAMPP-72\htdocs\ENVATO\ACCOUNTING-SOFTWARE\resources\views/expert/head.blade.php ENDPATH**/ ?>