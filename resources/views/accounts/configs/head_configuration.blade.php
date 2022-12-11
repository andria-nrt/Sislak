@extends('expert.master')

@section('title', 'Jurnal Umum - '.$settingsinfo->company_name.' - '.$settingsinfo->soft_name.'')

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
                <i class="fa fa-share"></i><span> Konfigurasi Kepala Akun</span>
            </div>

            <div class="card">
                <div class="card-body">
                  <form method="post" action="{{route('Accounts.headConfigUpdate')}}">
                    @csrf
                    @foreach($configs as $config)
                    <div class="row">
                        @php $i=0; @endphp
                        @foreach($config as $config)
                        <div class="col-lg-6">
                            <div class="form-group row">
                              <label for="basic-input" class="@if($i==0){{'offset-sm-1'}}@endif col-sm-7 col-form-label">{{$config->particular_name.' ('.(($config->coa_level==2)?'General Ledger':'Subsidiary Ledger').')'}}</label>
                              <div class="{{($i==0) ? 'col-sm-4' : 'col-sm-4'}}">
                                <input type="text" name="{{$config->particular}}" value="{{$config->account_code}}" class="form-control">
                              </div>
                            </div>
                        </div>
                        @php $i++; @endphp
                        @endforeach
                    </div>
                    @endforeach
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <button type="submit" class="btn btn-primary shadow-primary px-5"><i class="icon-lock"></i> Simpan</button>
                        </div>
                    </div>
                  </form>
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
    @if(session('configMsg'))
    <script>
    $(document).ready(function() {
        Lobibox.notify('success', {
            pauseDelayOnHover: true,
            continueDelayOnInactiveTab: false,
            position: 'top right',
            icon: 'fa fa-check-circle',
            msg: "{{session('configMsg')}}"
        });
    });
    </script>
    @endif
  @endsection