<div class="print_button">
  <button class="btn btn-info" onclick="printReport()"><i class="fa fa-print" aria-hidden="true"></i> Print</button>
</div>

<h5 class="company_name">{{$company_name}}</h4>
<div class="title">Balance Sheet</div>
<div class="title small">{{$title_date}}</div>

<table class="responsive table table-bordered">
  <tbody>
@foreach($accTypes as $accType)
    <tr>
      <td colspan="2" class="bg-light_1"><b>{{$accType->type_name}}</b></td>
    </tr>
    <tr>
      <td class="pl-4 bg-light_2"><b>Detail</b></td>
      <td width="20%" class="text-right bg-light_2"><b>Nominal</b></td>
    </tr>

    <?php $ttlAmount = 0; ?>
    @if(array_key_exists($accType->id, $glLedgers))
    @foreach($glLedgers[$accType->id] as $glLedger)
      @if(array_key_exists($glLedger->id, $slLedgers))
      <?php
      $ttlGl = 0;
      $html = '';
      $i=0;
      foreach($slLedgers[$glLedger->id] as $slLedger) {
        $amount = 0;
        if(array_key_exists($slLedger->id, $ledgers)) {
          $amount = $ledgers[$slLedger->id];
          $amount = ($slLedger->type_id==1) ? $amount->debit_amount-$amount->credit_amount : $amount->credit_amount-$amount->debit_amount;
        }
        //Surplus
        if($surplus_id==$slLedger->id) {
          $amount += $surplusBalance->balanceAmount;
        }
        //---
        $html .= '<tr>';
        $html .= '<td class="pl-4"><span class="pl-4">'.$slLedger->ledger_head.'</span></td>';
        $html .= '<td class="text-right">'.number_format($amount, 2).'</td>';
        $html .= '</tr>';
        $ttlGl += $amount;
      }
      $ttlAmount += $ttlGl;
      ?>
      <tr>
        <td class="pl-4"><b>{{$glLedger->ledger_head}}</b></td>
        <td class="text-right"><b>{{number_format($ttlGl, 2)}}</b></td>
      </tr>
      <?php echo $html; ?>
      @endif
    @endforeach
    @endif

    <tr>
      <td class="text-right"><b>Total</b></td>
      <td class="text-right"><span class="double-border"><b>
       @if($set_currency->currency_position==2){{$set_currency->symbol}}@endif 
            {{number_format($ttlAmount, 2)}}
            @if($set_currency->currency_position==1){{$set_currency->symbol}}@endif
           {{$set_currency->currency_text}}
          
    </b></span></td>
    </tr>

    @if($accType->id==1)
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    @endif
@endforeach
  </tbody>
</table>