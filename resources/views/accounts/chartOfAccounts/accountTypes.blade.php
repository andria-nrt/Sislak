@extends('expert.master')

@section('title', 'Jenis Akun - '.$settingsinfo->company_name.' - '.$settingsinfo->soft_name.'')

@section('content')

@include('expert.sidebar')

@include('expert.topbar')

<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card bg-dark">
      		<div class="card-header border-0 bg-transparent text-white">
                <i class="fa fa-share"></i><span> Jenis Akun</span>
            </div>

            <div class="card">

            <div class="card-body">
              <div class="table-responsive">
              <table id="dataTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th width="5%">SN</th>
                        <th>Kode Buku Besar</th>
                        <th>Kode Buku Besar</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i=1; @endphp
                    @foreach($accountTypes as $accountType)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$accountType->type_code}}</td>
                        <td>{{$accountType->type_name}}</td>
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