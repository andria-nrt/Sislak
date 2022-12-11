@extends('expert.master')

@section('title', 'Kontra Voucher - '.$settingsinfo->company_name.' - '.$settingsinfo->soft_name.'')

@section('content')

@include('expert.sidebar')

@include('expert.topbar')

<style type="text/css">
  .modal-dialog {
    max-width: 950px !important;
  }
</style>

<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card bg-dark">
      		<div class="card-header border-0 bg-transparent text-white">
                <i class="fa fa-share"></i><span> Kontra Voucher</span>
            </div>

            <div class="card">

            <div class="card-header">
              <div style="display:inline-block; padding-top:5px;">
                <i class="fa fa-table"></i> List Kontra Voucher
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
                        <th width="8%">Nomor Voucher</th>
                        <th width="18%">Nominal</th>
                        <th width="15%">Tanggal</th>
                        <th>Keterangan</th>
                        
                        <th width="8%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i=1; @endphp
                    @foreach($vouchers as $voucher)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$voucher->voucher_code}}</td>
                        <td>
 @if($set_currency->currency_position==2){{$set_currency->symbol}}@endif 
{{$voucher->transaction_amount}}       
            @if($set_currency->currency_position==1){{$set_currency->symbol}}@endif
           {{$set_currency->currency_text}}
           </td>
                        <td>{{date('d/m/Y', strtotime($voucher->transaction_date))}}</td>
                        <td>{{$voucher->remarks}}</td>
   
                        <td>
                          <button type="button" class="btn btn-info btn-sm waves-effect waves-light printView" data="{{$voucher->id}}"> 
                            <i class="fa fa-eye"></i> <span>Lihat</span>
                          </button>
                          <button type="button" class="btn btn-warning btn-sm waves-effect waves-light edit" data="{{$voucher->id}}"> 
                            <i class="fa fa-edit"></i> <span>Edit</span>
                          </button> 
                          <button type="button" class="btn btn-danger btn-sm waves-effect waves-light delete" data="{{$voucher->id}}"> 
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
            curUrl: "{{route('Accounts.contra_voucher.index')}}",
            addUrl: "{{route('Accounts.contra_voucher.create')}}"
        });
    });
    </script>
  @endsection