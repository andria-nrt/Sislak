@extends('expert.master')

@section('title', 'Settings - '.$settingsinfo->company_name.' - '.$settingsinfo->soft_name.'')

@section('content')

@include('expert.sidebar')

@include('expert.topbar')

<style type="text/css">
  table.dataTable tbody tr td {
    word-wrap: break-word;
    word-break: break-all;
}
</style>

<div class="clearfix"></div>
  
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card bg-dark">
          <div class="card-header border-0 bg-transparent text-white">
                <i class="fa fa-university"></i><span> Profile Update</span>
            </div>

            <div class="card">

            <div class="card-body">

          <?php if (session('message')): ?>
              <div class="alert alert-{{session('class')}} alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <div class="alert-icon contrast-alert"><i class="icon-close"></i></div>
                <div class="alert-message"><span>{{session('message')}}</span></div>
              </div>
        <?php endif; ?>

  <form action="{{url('admin/updateuser')}}" enctype="multipart/form-data" method="post">
    <input type="hidden" name="id" id="id" value="{{$data->id}}">
    @csrf

    <div class="modal-body">
        <div id="validate-error"></div>
        <div class="row">
            
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Update Name</label>
                    <input required="" type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="{{$data->name}}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="mobile">Update Mobile</label>
                    <input required="" type="number" class="form-control" id="mobile" name="mobile" placeholder="Enter Mobile" value="{{$data->mobile}}">
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-group">
                    <label for="mobile">Update Address</label>
                    <input required="" type="text" class="form-control" id="address" name="address" placeholder="Enter Address" value="{{$data->address}}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Update Email</label>
                    <input required="" type="email" class="form-control" id="email" name="email" placeholder="Enter Address" value="{{$data->email}}">
                </div>
            </div>



            
            
        </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-dark"><i class="fa fa-check-square-o"></i> Update</button>
    </div>
</form>
            </div>
          </div>
               
          </div>
        </div>
      </div><!--End Row-->
    
       <!--End Dashboard Content-->

    </div>
    <!-- End container-fluid-->
    
    </div><!--End content-wrapper-->
   

  @include('expert.copyright')

  @endsection
