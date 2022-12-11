<?php $__env->startSection('title', 'Login Panel - '.$settingsinfo->company_name.' - '.$settingsinfo->soft_name.''); ?>

<?php $__env->startSection('content'); ?>

 <!-- Login Here --> 

<body class="authentication-bg ">
 <!-- Start wrapper-->
 <div id="wrapper">
	<div class="card card-authentication1 mx-auto my-5 animated zoomIn bg-dark">
		<div class="card-body">
		 <div class="card-content p-2">
		  <div class="text-center">
		 		<img src="<?php echo e(asset('/logo/'.$settingsinfo->logo)); ?>"/>
		 		<hr class="border-secondary">
		 	</div>
		  <div class="card-title text-uppercase text-center py-2 text-white">
		  	 Software Login
		  </div>
		  <?php if (session('message')): ?>
		  	<div class="alert alert-<?php echo e(session('class')); ?> alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<div class="alert-icon contrast-alert"><i class="icon-close"></i></div>
				<div class="alert-message"><span><?php echo e(session('message')); ?></span></div>
			</div>
        <?php endif; ?>
		    <form class="color-form" method="post" action="<?php echo e(route('login')); ?>">
		    	<?php echo csrf_field(); ?>
			  <div class="form-group">
			   <div class="position-relative has-icon-left">
				  <label for="username" class="sr-only">Username</label>
				  <input required="" type="text" id="username" name="username" class="form-control" placeholder="Username" value="<?php echo e(old('username')); ?>">
				  <div class="form-control-position">
					  <i class="icon-user"></i>
				  </div>
			   </div>
			  </div>
			  <div class="form-group">
			   <div class="position-relative has-icon-left">
				  <label for="password" class="sr-only">Password</label>
				  <input required="" type="password" id="password" name="password" class="form-control" placeholder="Password">
				  <div class="form-control-position">
					  <i class="icon-lock"></i>
				  </div>
			   </div>
			  </div>
			<div class="form-row mr-0 ml-0">
			 <div class="form-group col-6">
			   <div class="demo-checkbox">
                <input type="checkbox" id="remember" name="remember" class="filled-in chk-col-danger" checked="" />
                <label for="remember">Remember me</label>
			  </div>
			 </div>
			 <!-- <div class="form-group col-6 text-right">
			  <a href="authentication-dark-reset-password.html">Reset Password</a>
			 </div> -->
			</div>
			
			 <div class="form-group">
			   <button type="submit" class="btn btn-danger btn-block waves-effect waves-light">Sign In</button>
			 </div>
			  <!-- <div class="form-group text-center">
			   <p class="text-white">Not a Member ? <a href="authentication-dark-signup.html"> Sign Up here</a></p>
			 </div> -->
			 <div class="form-group text-center">
			    <hr class="border-secondary">
				<!-- <h5 class="text-white">OR</h5> -->
			 </div>
			 <!--  <div class="form-group text-center">
				<button type="button" class="btn btn-twitter text-white btn-block waves-effect waves-light"><i class="fa fa-twitter"></i> Sign In With twitter</button>
			  </div> -->
			 
			 </form>
		   </div>
		  </div>
	     </div>
    
     
<?php $__env->stopSection(); ?>
<?php echo $__env->make('expert.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH N:\XAMPP-72\htdocs\ENVATO\ACCOUNTING-SOFTWARE\resources\views/expert/login.blade.php ENDPATH**/ ?>