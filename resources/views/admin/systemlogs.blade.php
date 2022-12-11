@extends('expert.master')

@section('title', 'System Logs - '.$settingsinfo->company_name.' - '.$settingsinfo->soft_name.'')

@section('content')

@include('expert.sidebar')

@include('expert.topbar')

<style type="text/css">

.table-responsive {
    white-space: normal;
}
</style>

<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card bg-dark">
      		<div class="card-header border-0 bg-transparent text-white">
                <i class="fa fa-university"></i><span> System Logs</span>
            </div>

            <div class="card">

            <div class="card-header">
              <div style="display:inline-block; padding-top:5px;">
                <i class="fa fa-table"></i> Logs List
              </div> 
             
            </div>

            <div class="card-body">
              <div class="table-responsive">
              <table id="dataTable" class="table table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th style="width: 5%;">SN</th>
                        <th style="width: 15%;">Tanggal</th>
                        <th style="width: 10%;">ID - User </th>
                        <th style="width: 15%;">Menu</th>
                        <th style="width: 10%;">Aksi</th>
                        <th style="width: 35%;">Changes</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @php $i=1; @endphp
                    @foreach($logs as $logdata)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$logdata->date_time}}</td>
                        <td>{{$logdata->user_id}} - {{$logdata->user_name}}</td>
                        <td>{{$logdata->table}}</td>
                        <td>{{$logdata->action}}</td>
                        <td><?php echo trim($logdata->changes); ?></td>
                        
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
   

  @include('expert.copyright')

  @endsection

  @section('js')
    <script>
    $(document).ready(function() {
        dataTableLoad({
            curUrl: "{{route('Admin.userrole.index')}}",
            addUrl: "{{route('Admin.userrole.create')}}"
        });
    });
    </script>
  @endsection

