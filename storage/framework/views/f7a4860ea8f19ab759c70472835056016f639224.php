<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Software Installation</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- MATERIAL DESIGN ICONIC FONT -->
		<link rel="stylesheet" href="<?php echo e(asset('/expert/wizard/fonts/material-design-iconic-font/css/material-design-iconic-font.css')); ?>">
		<!-- DATE-PICKER -->
		<link rel="stylesheet" href="<?php echo e(asset('/expert/wizard/vendor/date-picker/css/datepicker.min.css')); ?>">
		<!-- STYLE CSS -->
		<link rel="stylesheet" href="<?php echo e(asset('/expert/wizard/css/style.css')); ?>">
		<!-- notifications css -->
		<link rel="stylesheet" href="<?php echo e(asset('/expert/assets/plugins/notifications/css/lobibox.min.css')); ?>"/>
		<!-- Icons CSS-->
		<link href="<?php echo e(asset('/expert/assets/css/icons.css')); ?>" rel="stylesheet" type="text/css"/>

		<style type="text/css">
			.form-holder i:not(.zmdi-chevron-down) {
				top: 21px;
			}
			label.error {
				color: #f00 !important;
			}
			input.error {
				border-color: #f00 !important;
			}
			.actions li a.disabled {
				opacity: 0.8;
			}
		</style>
	</head>
	<body>
		<div class="wrapper">
            <div id="wizard">
        		<!-- SECTION 1 -->
                <h4></h4>
                <section>
                	<form id="db-info" form-validate="0">
                		<?php echo csrf_field(); ?>
	                    <h3>Database Setup</h3>
	                	<div class="form-row">
	                        <div class="form-col">
	                            <label for="">
	                                Database Name
	                            </label>
	                            <div class="form-holder">
	                            <div class="input-group">
	                                <i class="zmdi zmdi-language-css3"></i>
	                                <input type="text" class="form-control" name="db_name" required="" autocomplete="off">
	                            </div>
	                            </div>
	                        </div>
	                        <div class="form-col">
	                            <label for="">
	                                Database Host
	                            </label>
	                            <div class="form-holder">
	                                <i class="zmdi zmdi-cloud-outline"></i>
	                                <input type="text" class="form-control" name="db_host" required="" autocomplete="off">
	                            </div>
	                        </div>
	                	</div>
	                    <div class="form-row">
	                        <div class="form-col">
	                            <label for="">
	                                User Name
	                            </label>
	                            <div class="form-holder">
	                                <i class="zmdi zmdi-account-o"></i>
	                                <input type="text" class="form-control" name="db_user" required="" autocomplete="off">
	                            </div>
	                        </div>
	                        <div class="form-col">
	                            <label for="">
	                                Password
	                            </label>
	                            <div class="form-holder password">
	                                <i class="zmdi zmdi-eye"></i>
	                                <input type="password" class="form-control" name="db_password" autocomplete="off">
	                            </div>
	                        </div>
	                    </div>
	                </form>
                </section>
                
				<!-- SECTION 2 -->
                <h4></h4>
                <section>
                	<form id="company-info" form-validate="0">
	                	<h3>Company Profile</h3>
	                    <div class="form-row">
	                        <div class="form-col">
	                            <label for="">
	                                Company Name
	                            </label>
	                            <div class="form-holder">
	                                <i class="zmdi zmdi-home"></i>
	                                <input type="text" class="form-control" name="company_name" required="" autocomplete="off">
	                            </div>
	                        </div>
	                        <div class="form-col">
	                            <label for="">
	                                Phone
	                            </label>
	                            <div class="form-holder">
	                                <i class="zmdi zmdi-phone"></i>
	                                <input type="text" class="form-control" name="phone" required="" autocomplete="off">
	                            </div>
	                        </div>
	                    </div>
	                    <div class="form-row">
	                        <div class="form-col">
	                            <label for="">
	                                Email
	                            </label>
	                            <div class="form-holder">
	                                <i class="zmdi zmdi-email"></i>
	                                <input type="email" class="form-control" name="email" required="" autocomplete="off">
	                            </div>
	                        </div>
	                        <div class="form-col">
	                            <label for="">
	                                Address
	                            </label>
	                            <div class="form-holder">
	                                <i class="zmdi zmdi-pin-drop"></i>
	                                <input type="text" class="form-control" name="address" required="" autocomplete="off">
	                            </div>
	                        </div>
	                    </div>
	                </form>
                </section>

				<!-- SECTION 3 -->
                <h4></h4>
                <section>
                	<form id="user-info">
	                	<h3>User Profile</h3>
	                    <div class="form-row">
	                        <div class="form-col">
	                            <label for="">
	                                Full Name
	                            </label>
	                            <div class="form-holder">
	                                <i class="zmdi zmdi-account-o"></i>
	                                <input type="text" class="form-control" name="user_fullname" required="" autocomplete="off">
	                            </div>
	                        </div>
	                        <div class="form-col">
	                            <label for="">
	                                Designation
	                            </label>
	                            <div class="form-holder">
	                                <i class="zmdi zmdi-card"></i>
	                                <input type="text" class="form-control" name="user_designation" required="" autocomplete="off">
	                            </div>
	                        </div>
	                    </div>
	                    <div class="form-row">
	                        <div class="form-col">
	                            <label for="">
	                                Username
	                            </label>
	                            <div class="form-holder">
	                                <i class="zmdi zmdi-account-circle"></i>
	                                <input type="text" class="form-control" name="user_username" required="" autocomplete="off">
	                            </div>
	                        </div>
	                        <div class="form-col">
	                            <label for="">
	                                Password
	                            </label>
	                            <div class="form-holder password">
	                                <i class="zmdi zmdi-eye"></i>
	                                <input type="password" class="form-control" name="user_password" required="" autocomplete="off">
	                            </div>
	                        </div>
	                    </div>
	                </form>
                </section>
            </div>
		</div>

		<script src="<?php echo e(asset('/expert/wizard/js/jquery-3.3.1.min.js')); ?>"></script>
		
		<!-- JQUERY STEP -->
		<script src="<?php echo e(asset('/expert/wizard/js/jquery.steps.js')); ?>"></script>

		<!-- DATE-PICKER -->
		<script src="<?php echo e(asset('/expert/wizard/vendor/date-picker/js/datepicker.js')); ?>"></script>
		<script src="<?php echo e(asset('/expert/wizard/vendor/date-picker/js/datepicker.en.js')); ?>"></script>

		<!--Form Validatin Script-->
  		<script src="<?php echo e(asset('/expert/assets/plugins/jquery-validation/js/jquery.validate.min.js')); ?>"></script>

  		<!--notification js -->
		<script src="<?php echo e(asset('/expert/assets/plugins/notifications/js/lobibox.min.js')); ?>"></script>
		<script src="<?php echo e(asset('/expert/assets/plugins/notifications/js/notifications.min.js')); ?>"></script>

		<script type="text/javascript">
			$(function(){
				$("#wizard").steps({
			        headerTag: "h4",
			        bodyTag: "section",
			        transitionEffect: "fade",
			        enableAllSteps: true,
			        transitionEffectSpeed: 300,
			        labels: {
			            next: "Next",
			            previous: "Back"
			        },
			        onStepChanging: function (event, currentIndex, newIndex) {
			        	if(currentIndex===0 && $("#db-info").attr("form-validate")!=1) {
		        			$("#db-info").submit();
		        			return false;
			        	} else if(currentIndex===1 && $("#company-info").attr("form-validate")!=1) {
		        			$("#company-info").submit();
		        			return false;
			        	}
			        	if(currentIndex===0) {
			        		$("#db-info").attr("form-validate", "0");
			        	} else if(currentIndex===1) {
			        		$("#company-info").attr("form-validate", "0");
			        	}

			            $('.steps ul').removeClass('step-2');
			            $('.steps ul').removeClass('step-3');
			            if ( newIndex === 1 ) {
			                $('.steps ul').addClass('step-2');
			            } else if ( newIndex === 2 ) {
			                $('.steps ul').addClass('step-3');
			                
			            }
			            return true; 
			        }
			    });

			    $(".actions").on("click", "a[href='#finish']", function(){
			    	$("#user-info").submit();
			    });

				$("#db-info").validate();
				$("#company-info").validate();
				$("#user-info").validate();

			    // Click to see password 
			    $('.password i').click(function(){
			        if ( $('.password input').attr('type') === 'password' ) {
			            $(this).next().attr('type', 'text');
			        } else {
			            $('.password input').attr('type', 'password');
			        }
			    });

			    $("#db-info").submit(function(e){
			    	e.preventDefault();
			    	var nonValidate = $(this).find('input.error');
			    	var $btn = $(".actions").find("a[href='#next']");
			    	if(nonValidate.length==0 && !($btn.hasClass('disabled'))) {
			    		var btnText = $btn.html();
      					$btn.html('Loading...').addClass('disabled');
      					var inputData = $(this).serializeArray();

      					$.ajax({
							url: "<?php echo e(route('dbConnection')); ?>",
							method: 'POST',
							data: inputData,
							dataType: "json",
							success: function(data){
								$btn.html(btnText).removeClass('disabled');
								if(data.status=='success') {
									$("#db-info").attr("form-validate", "1");
									Lobibox.notify('success', {
										pauseDelayOnHover: true,
										continueDelayOnInactiveTab: false,
										position: 'top right',
										icon: 'fa fa-check-circle',
										msg: data.message
									});
									$("#wizard").steps('next');
								} else {
									$("#db-info").attr("form-validate", "0");
									Lobibox.notify('error', {
										pauseDelayOnHover: true,
										continueDelayOnInactiveTab: false,
										position: 'top right',
										icon: 'fa fa-times-circle',
										msg: data.message
									});
								}
							},
							error: function(data) {
								$btn.html(btnText).removeClass('disabled');
								$("#db-info").attr("form-validate", "0");
								Lobibox.notify('error', {
									pauseDelayOnHover: true,
									continueDelayOnInactiveTab: false,
									position: 'top right',
									icon: 'fa fa-times-circle',
									msg: 'Something went wrong!'
								});
							}
						});
			    	}
			    });

			    $("#company-info").submit(function(e){
			    	e.preventDefault();
			    	var nonValidate = $(this).find('input.error');
			    	if(nonValidate.length==0) {
			    		$("#company-info").attr("form-validate", "1");
			    		$("#wizard").steps('next');
			    	}
			    });

			    $("#user-info").submit(function(e){
			    	e.preventDefault();
			    	var nonValidate = $(this).find('input.error');
			    	var $btn = $(".actions").find("a[href='#finish']");
			    	if(nonValidate.length==0 && !($btn.hasClass('disabled'))) {
			    		var btnText = $btn.html();
      					$btn.html('Loading...').addClass('disabled');
      					var inputData = $(this).serializeArray();
      					$.each($("#db-info").serializeArray(), function(i, obj){
      						inputData[inputData.length] = {
      							name: obj.name,
      							value: obj.value
      						};
      					});
      					$.each($("#company-info").serializeArray(), function(i, obj){
      						inputData[inputData.length] = {
      							name: obj.name,
      							value: obj.value
      						};
      					});

      					$.ajax({
							url: "<?php echo e(route('wizardAction')); ?>",
							method: 'POST',
							data: inputData,
							dataType: "json",
							success: function(data){
								$btn.html(btnText).removeClass('disabled');
								if(data.status=='success') {
									Lobibox.notify('success', {
										pauseDelayOnHover: true,
										continueDelayOnInactiveTab: false,
										position: 'top right',
										icon: 'fa fa-check-circle',
										msg: data.message
									});
									setTimeout(function(){ location.replace('<?php echo e(route("home")); ?>'); }, 500);
								} else {
									Lobibox.notify('error', {
										pauseDelayOnHover: true,
										continueDelayOnInactiveTab: false,
										position: 'top right',
										icon: 'fa fa-times-circle',
										msg: data.message
									});
								}
							},
							error: function(data) {
								$btn.html(btnText).removeClass('disabled');
								Lobibox.notify('error', {
									pauseDelayOnHover: true,
									continueDelayOnInactiveTab: false,
									position: 'top right',
									icon: 'fa fa-times-circle',
									msg: 'Something went wrong!'
								});
							}
						});
			    	}
			    });
			});
		</script>

</body>
</html><?php /**PATH N:\XAMPP-72\htdocs\ENVATO\ACCOUNTING-SOFTWARE\resources\views/expert/wizard.blade.php ENDPATH**/ ?>