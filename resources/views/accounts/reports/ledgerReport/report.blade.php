<div class="print_button">
  <button class="btn btn-info" onclick="printReport()"><i class="fa fa-print" aria-hidden="true"></i> Print</button>
</div>

<h5 class="company_name">{{$company_name}}</h4>
<div class="title">{{$report_title}}</div>
@if(!empty($report_head))<div class="title small">{{$report_head}}</div>@endif
<div class="title small">{{$title_date}}</div>

<table class="responsive table table-bordered">
  <thead>
    <tr>
      @if(empty($sl_id))
      <th width="20%" class="bg-light_2">Account Head</th>
      @endif
      <th width="8%" class="text-center bg-light_2">Tanggal</th>
      <th width="7%" class="text-center bg-light_2">Voucher</th>
      <th class="bg-light_2">Detail</th>
      <th class="bg-light_2">Keterangan</th>
      <th width="14%" class="text-right bg-light_2">Debit</th>
      <th width="14%" class="text-right bg-light_2">Kredit</th>
      <th width="14%" class="text-right bg-light_2">Saldo</th>
    </tr>
  </thead>
  <tbody>
<?php
  $ttlDebit = 0;
  $ttlCredit = 0;
  $balance = ($accHead->type_id<=2) ? $opening->debit_amount-$opening->credit_amount : $opening->credit_amount-$opening->debit_amount;
?>
    <tr>
      @if(empty($sl_id))
      <td>{{$accHead->ledger_head}}</td>
      @endif
      <td class="text-center">{{$from_date}}</td>
      <td class="text-center">---</td>
      <td>Opening Balance</td>
      <td></td>
      <td class="text-right">---</td>
      <td class="text-right">---</td>
      <td class="text-right">{{number_format($balance, 2)}}</td>
    </tr>
<!-- Opening Entry -->
@foreach($opening_ledgers as $ledger)
    <?php
      $ledger_date = new DateTime($ledger->transaction_date);
      $ledger_date = $ledger_date->format('d/m/Y');
      $ttlDebit += $ledger->debit_amount;
      $ttlCredit += $ledger->credit_amount;
      $balance += ($accHead->type_id<=2) ? $ledger->debit_amount-$ledger->credit_amount : $ledger->credit_amount-$ledger->debit_amount;
    ?>
    <tr>
      @if(empty($sl_id))
      <td>{{@$slHead[$ledger->sub_ledger]->ledger_head}}</td>
      @endif
      <td class="text-center">{{$ledger_date}}</td>
      <td class="text-center">---</td>
      <td>Opening Entry</td>
      <td></td>
      <td class="text-right">{{$ledger->debit_amount}}</td>
      <td class="text-right">{{$ledger->credit_amount}}</td>
      <td class="text-right">{{number_format($balance, 2)}}</td>
    </tr>
@endforeach
<!-- Ledgers -->
@foreach($ledgers as $ledger)
    <?php
      $ledger_date = new DateTime($ledger->transaction_date);
      $ledger_date = $ledger_date->format('d/m/Y');
      $ttlDebit += $ledger->debit_amount;
      $ttlCredit += $ledger->credit_amount;
      $balance += ($accHead->type_id<=2) ? $ledger->debit_amount-$ledger->credit_amount : $ledger->credit_amount-$ledger->debit_amount;
    ?>
    <tr>
      @if(empty($sl_id))
      <td>{{@$slHead[$ledger->sub_ledger]->ledger_head}}</td>
      @endif
      <td class="text-center">{{$ledger_date}}</td>
      <td class="text-center">{{$ledger->voucher_code}}</td>
      <td>{{@$slHead[$ledger->particular_sl]->ledger_head}}</td>
      <td>{{$ledger->remarks}}</td>
      <td class="text-right">{{$ledger->debit_amount}}</td>
      <td class="text-right">{{$ledger->credit_amount}}</td>
      <td class="text-right">{{number_format($balance, 2)}}</td>
    </tr>
@endforeach
  </tbody>
  <tfoot>
    <tr>
      <th class="text-right" colspan="{{empty($sl_id)?5:4}}">Total</th>
      <th class="text-right">
       @if($set_currency->currency_position==2){{$set_currency->symbol}}@endif 
             {{number_format($ttlDebit, 2)}}
            @if($set_currency->currency_position==1){{$set_currency->symbol}}@endif
           {{$set_currency->currency_text}}
       </th>
      <th class="text-right">
       @if($set_currency->currency_position==2){{$set_currency->symbol}}@endif 
            {{number_format($ttlCredit, 2)}}
            @if($set_currency->currency_position==1){{$set_currency->symbol}}@endif
           {{$set_currency->currency_text}}
        </th>
      <th class="text-right">
       @if($set_currency->currency_position==2){{$set_currency->symbol}}@endif 
           {{number_format($balance, 2)}}
            @if($set_currency->currency_position==1){{$set_currency->symbol}}@endif
           {{$set_currency->currency_text}}
         </th>
    </tr>
  </tfoot>
</table>