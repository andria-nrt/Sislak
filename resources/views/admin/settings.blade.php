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
                <i class="fa fa-university"></i><span> Pengaturan</span>
            </div>

            <div class="card">

            <div class="card-header">
              <div style="display:inline-block; padding-top:5px;">
                <i class="fa fa-table"></i> Pengaturan Aplikasi
              </div> 
             
            </div>

            <div class="card-body">

          <?php if (session('message')): ?>
              <div class="alert alert-{{session('class')}} alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <div class="alert-icon contrast-alert"><i class="icon-close"></i></div>
                <div class="alert-message"><span>{{session('message')}}</span></div>
              </div>
        <?php endif; ?>

  <form action="{{url('admin/settingsupdate')}}" enctype="multipart/form-data" method="post">
    @csrf
    

    <div class="modal-body">
        <div id="validate-error"></div>
        <div class="row">

             

            
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Nama Perusahaan</label>
                    <input required="" type="text" class="form-control" id="company_name" name="company_name" placeholder="Enter Company name" value="{{$settings->company_name}}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="designation">Nomer Telepon</label>
                    <input required="" type="number" class="form-control" id="phone" name="phone" placeholder="Enter Phone" value="{{$settings->phone}}">
                </div>
            </div>

            
            <div class="col-md-6">
                <div class="form-group">
                    <label for="mobile">Email</label>
                    <input required="" type="email" class="form-control" id="email" name="email" placeholder="Enter Telephone Number" value="{{$settings->email}}">
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-group">
                    <label for="address">Alamat</label>
                    <input class="form-control" id="address" name="address" placeholder="Enter Address" value="{{$settings->address}}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="images">Logo</label>
                      <input type="file" class="form-control" class="form-control" id="logo" name="logo">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="images">Favicon</label>
                      <input type="file" class="form-control" class="form-control" id="favicon" name="favicon">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group" align="center">
                      <img src="{{ asset('/logo/'.$settings->logo)}}" class="img-responsive" style="background-color: #515151;" >
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group" align="center">
                    <img src="{{ asset('/favicon/'.$settings->favicon)}}" class="img-responsive" style="background-color: #515151;" >
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

