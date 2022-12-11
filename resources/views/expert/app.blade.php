@extends('expert.master')

@section('title', 'Dashboard - '.$settingsinfo->company_name.' - '.$settingsinfo->soft_name.'')

@section('content')

<body onload="info_noti()">

@include('expert.sidebar')

@include('expert.topbar')

<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">

      <!--Start Dashboard Content-->

      <div class="card-group">
  	     <div class="card bg-success border-right border-secondary-light">
            <div class="card-header bg-transparent text-white">
               <i class="fa fa-indent" aria-hidden="true"></i> 
               All Modules 
  	        </div>
  	      </div>
  		</div>
      
      <div class="row mt-4">
        @if($user_role_per->admin == 1)
        <div class="col-12 col-lg-6 col-xl-4">
          <a href="">
          <div class="card bg-purple shadow-purple">
            <div class="card-body">
              <div class="media">
              <div class="media-body text-left">
                <h4 class="text-white">Admin </h4>
                <span class="text-white">All User and Role Manage</span>
              </div>
			  <div class="align-self-center">
			  	<i class="fa fa-user-circle fa-5x" style="color: #fff;"></i>
			  </div>
            </div>
            </div>
          </div>
          </a>
        </div>
        @endif
        @if($user_role_per->inventory == 1)
        <div class="col-12 col-lg-6 col-xl-4">
          <div class="card bg-danger shadow-danger">
            <a href="{{url('inventory/dashboard')}}">
            <div class="card-body">
              <div class="media">
			  <div class="media-body text-left">
                <h4 class="text-white">Inventory</h4>
                <span class="text-white">All Products Manage</span>
              </div>
               <div class="align-self-center">
               	<i class="fa fa-archive fa-5x" style="color: #fff;"></i>
               </div>
            </div>
            </div>
            </a>
          </div>
        </div>
        @endif
        @if($user_role_per->service == 1)
        <div class="col-12 col-lg-6 col-xl-4">
          <div class="card bg-success shadow-success">
            <a href="{{url('service/dashboard')}}">
            <div class="card-body">
              <div class="media">
              <div class="media-body text-left">
                <h4 class="text-white">Service</h4>
                <span class="text-white">All Service Support Manage</span>
              </div>
			  <div class="align-self-center">
			  	<i class="fa fa-wrench fa-5x" style="color: #fff;"></i>
			  </div>
            </div>
            </div>
          </a>
          </div>
        </div>
        @endif
        @if($user_role_per->hr == 1)
        <div class="col-12 col-lg-6 col-xl-4">
          <div class="card bg-purple shadow-purple">
            <a href="{{url('hr/dashboard')}}">
            <div class="card-body">
              <div class="media">
              <div class="media-body text-left">
                <h4 class="text-white">HR</h4>
                <span class="text-white">Human Research Manage</span>
              </div>
			  <div class="align-self-center">
			  	<i class="fa fa-users fa-5x" style="color: #fff;"></i>
			  </div>
            </div>
            </div>
          </a>
          </div>
        </div>
        @endif
        @if($user_role_per->payroll == 1)
        <div class="col-12 col-lg-6 col-xl-4">
          <div class="card bg-danger shadow-danger">
            <a href="{{url('payroll/dashboard')}}">
            <div class="card-body">
              <div class="media">
              <div class="media-body text-left">
                <h4 class="text-white">Payroll </h4>
                <span class="text-white">All Payroll Manage</span>
              </div>
			  <div class="align-self-center">
			  	<i class="fa fa-credit-card fa-5x" style="color: #fff;"></i>
			  </div>
            </div>
            </div>
          </a>
          </div>
        </div>
        @endif
        @if($user_role_per->accounts == 1)
        <div class="col-12 col-lg-6 col-xl-4">
          <div class="card bg-success shadow-success">
            <a href="{{url('accounts/dashboard')}}">
            <div class="card-body">
              <div class="media">
			  <div class="media-body text-left">
                <h4 class="text-white">Accounts </h4>
                <span class="text-white">All Accounting Manage</span>
              </div>
               <div class="align-self-center">
               	<i class="fa fa-book fa-5x" style="color: #fff;"></i>
               </div>
            </div>
            </div>
          </a>
          </div>
        </div>
        @endif
        @if($user_role_per->admin == 1)
        <div class="col-12 col-lg-6 col-xl-4">
          <div class="card bg-purple shadow-purple">
            <a href="{{url('admin/systemlogs')}}">
            <div class="card-body">
              <div class="media">
			  <div class="media-body text-left">
                <h4 class="text-white">Logs </h4>
                <span class="text-white">All System Logs</span>
              </div>
               <div class="align-self-center">
               	<i class="fa fa-th-list fa-5x" style="color: #fff;"></i>
               </div>
            </div>
            </div>
          </a>
          </div>
        </div>
        @endif
        @if($user_role_per->admin == 1)
        <div class="col-12 col-lg-6 col-xl-4">
          <div class="card bg-danger shadow-danger">
            <a href="{{url('admin/settings')}}">
            <div class="card-body">
              <div class="media">
              <div class="media-body text-left">
                <h4 class="text-white">Settings</h4>
                <span class="text-white">All Configuration</span>
              </div>
			  <div class="align-self-center">
			  	<i class="fa fa-cogs fa-5x" style="color: #fff;"></i>
			  </div>
            </div>
            </div>
          </a>
          </div>
        </div>
        @endif
        @if($user_role_per->admin == 1)
        <div class="col-12 col-lg-6 col-xl-4">
          <div class="card bg-success shadow-success">
            <a href="{{url('/')}}">
            <div class="card-body">
              <div class="media">
              <div class="media-body text-left">
                <h4 class="text-white">Backup </h4>
                <span class="text-white">Backup All Database </span>
              </div>
			  <div class="align-self-center">
			  	<i class="fa fa-database fa-5x" style="color: #fff;"></i>
			  </div>
            </div>
            </div>
          </a>
          </div>
        </div>
        @endif
      </div><!--End Row-->

      
	  
	  
	  
       <!--End Dashboard Content-->

    </div>
    <!-- End container-fluid-->
    
    </div><!--End content-wrapper-->
   
    
  @include('expert.copyright')

  @endsection