@extends('expert.master')

@section('title', 'Jurnal umum - '.$settingsinfo->company_name.' - '.$settingsinfo->soft_name.'')

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
                <i class="fa fa-share"></i><span> Jurnal umum</span>
            </div>

            <div class="card">

            <div class="card-header">
              <div style="display:inline-block; padding-top:5px;">
                <i class="fa fa-table"></i> Daftar Buku Besar
              </div> 
              <button type="button" class="btn btn-dark btn-sm waves-effect waves-light pull-right" id="addNew"> 
                <i class="fa fa-plus"></i> <span>Tambah Baru</span>
              </button>
            </div>

            <div class="card-body">
              <div class="table-responsive">
              <table id="dataTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th width="5%">SN</th>
                        <th>Kode Buku Besar</th>
                        <th>Nama Buku Besar</th>
                        <th>Jenis Akun</th>
                        
                        <th width="8%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i=1; @endphp
                    @foreach($generalLedger as $generalLedger)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$generalLedger->ledger_code}}</td>
                        <td>{{$generalLedger->ledger_head}}</td>
                        <td>{{$generalLedger->type_name}}</td>
   
                        <td>
                          <button type="button" class="btn btn-warning btn-sm waves-effect waves-light edit" data="{{$generalLedger->id}}"> 
                            <i class="fa fa-edit"></i> <span>Edit</span>
                          </button> 
                          <button type="button" class="btn btn-danger btn-sm waves-effect waves-light delete" data="{{$generalLedger->id}}"> 
                            <i class="fa fa-times"></i> <span>Hapus</span>
                          </button>
                        </td>
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
            curUrl: "{{route('Accounts.general_ledger.index')}}",
            addUrl: "{{route('Accounts.general_ledger.create')}}"
        });
    });
    </script>
  @endsection