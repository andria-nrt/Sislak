@extends('expert.master')

@section('title', 'Users - '.$settingsinfo->company_name.' - '.$settingsinfo->soft_name.'')

@section('content')

@include('expert.sidebar')

@include('expert.topbar')

@if($user_role_per->admin == 1)

<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card bg-dark">
      		<div class="card-header border-0 bg-transparent text-white">
                <i class="fa fa-user-circle"></i><span> User Manage</span>
            </div>

            <div class="card">
            <div class="card-header"><div style="display:inline-block; padding-top:5px;"><i class="fa fa-table"></i> User List </div> <button type="button" class="btn btn-dark btn-sm waves-effect waves-light pull-right" id="addNew"> <i class="fa fa-plus"></i> <span>Tambah Baru</span></button></div>
            
            <div class="card-body">

              <div class="table-responsive">
             <table id="dataTable" class="table table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Username</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i=1; @endphp
                    @foreach($users as $user)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->role_name}}</td>
                        <td>{{$user->username}}</td>
                        <td>{{$user->mobile}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->status}}</td>
                        <td><button type="button" class="btn btn-warning btn-sm waves-effect waves-light edit" data="{{$user->id}}"> <i class="fa fa-edit"></i> <span>Edit</span></button> <button type="button" class="btn btn-danger btn-sm waves-effect waves-light delete" data="{{$user->id}}"> <i class="fa fa-times"></i> <span>Delete</span></button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            </div>
          </div>
               
          </div>
        </div>
      </div><!--End Row-->
	  
       <!--End Dashboard Content-->

    </div>
    <!-- End container-fluid-->
    
    </div><!--End content-wrapper-->
   
   @endif

  @include('expert.copyright')

  @endsection

  @section('js')
    <script>
    $(document).ready(function() {
        dataTableLoad({
            curUrl: "{{route('Admin.usermanage.index')}}",
            addUrl: "{{route('Admin.usermanage.create')}}"
        });
    });
    </script>
  @endsection