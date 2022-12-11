@extends('expert.master')

@section('title', 'Jenis Akun - '.$settingsinfo->company_name.' - '.$settingsinfo->soft_name.'')

@section('content')

@include('expert.sidebar')

@include('expert.topbar')

<style type="text/css" id="treeview5-style"> 
  .treeview .list-group-item{cursor:pointer}.treeview span.indent{margin-left:20px;margin-right:20px}.treeview span.icon{width:12px;margin-right:10px}.treeview .node-disabled{color:silver;cursor:not-allowed}.node-treeview5{color:#000;}.node-treeview5:not(.node-disabled):hover{background-color:#F5F5F5;} 

  .list-group-item > .badge {
    float: right;
}

.badge {
    display: inline-block;
    min-width: 10px;
    padding: 3px 7px;
    font-size: 12px;
    font-weight: bold;
    line-height: 1;
    color: 
#fff;
text-align: center;
white-space: nowrap;
vertical-align: baseline;
background-color:
    #777;
    border-radius: 3px;
}
</style>


<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card bg-dark">
      		<div class="card-header border-0 bg-transparent text-white">
                <i class="fa fa-share"></i><span> Bagan Akun</span>
            </div>

            <div class="card">

            <div class="card-body">
              <div id="treeview5" class="treeview"></div>
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
      @php $coa = [1=>'Asset', 2=>'Expense', 3=>'Liability', 4=>'Income']; @endphp

      $('#treeview5').treeview({
        color: "#000",
        expandIcon: 'fa fa-angle-double-right',
        collapseIcon: 'fa fa-angle-double-down',
        nodeIcon: 'fa fa-clone',
        showTags: true,
        levels: 3,
        data: [
          @foreach($accountTypes as $accountType)
          {
            text: '{{$accountType->type_code." - ".$accountType->type_name}}',
            tags: ['{{$coa[$accountType->id]}}'],
            @if(array_key_exists($accountType->id, $generalLedgers))
            nodes: [
              @foreach($generalLedgers[$accountType->id] as $generalLedger)
              {
                text: '{{$generalLedger->ledger_code." - ".$generalLedger->ledger_head}}',
                tags: ['{{$coa[$accountType->id]}}'],
                @if(array_key_exists($generalLedger->id, $subsidiaryLedgers))
                nodes: [
                  @foreach($subsidiaryLedgers[$generalLedger->id] as $subsidiaryLedger)
                  {
                    text: '{{$subsidiaryLedger->ledger_code." - ".$subsidiaryLedger->ledger_head}}',
                    tags: ['{{$coa[$accountType->id]}}']
                  },
                  @endforeach
                ]
                @endif
              },
              @endforeach
            ]
            @endif
          },
          @endforeach
        ]
      });
    });
    </script>
  @endsection