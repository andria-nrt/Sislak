<div class="print_button">
  <button class="btn btn-info" onclick="printReport()"><i class="fa fa-print" aria-hidden="true"></i> Print</button>
</div>

<h5 class="company_name">{{$company_name}}</h4>
<div class="title">Trial Balance</div>
<div class="title small">{{$title_date}}</div>

<table class="responsive table table-bordered">
  <tbody>
  <?php $ttlDebit = 0; $ttlCredit = 0; ?>
  <tr>
    <td class="pl-4 bg-light_2"><b>Detail</b></td>
    <td width="15%" class="text-right bg-light_2"><b>Debit Amount</b></td>
    <td width="15%" class="text-right bg-light_2"><b>Credit Amount</b></td>
  </tr>
@foreach($accTypes as $accType)
    @if(array_key_exists($accType->id, $glLedgers))
    @foreach($glLedgers[$accType->id] as $glLedger)
      @if(array_key_exists($glLedger->id, $slLedgers))
      <?php
      $ttlGl_dr = 0; $ttlGl_cr = 0;
      $html = '';
      $i=0;
      foreach($slLedgers[$glLedger->id] as $slLedger) {
        if(array_key_exists($slLedger->id, $ledgers)) {
          $amount = $ledgers[$slLedger->id];
          $dr_amount = $amount->debit_amount;
          $cr_amount = $amount->credit_amount;
        } else {
          $dr_amount = 0;
          $cr_amount = 0;
        }
        if($dr_amount!=0 || $cr_amount!=0) {
          $html .= '<tr>';
          $html .= '<td class="pl-4"><span class="pl-4">'.$slLedger->ledger_head.'</span></td>';
          $html .= '<td class="text-right">'.number_format($dr_amount, 2).'</td>';
          $html .= '<td class="text-right">'.number_format($cr_amount, 2).'</td>';
          $html .= '</tr>';
          $ttlGl_dr += $dr_amount;
          $ttlGl_cr += $cr_amount;
        }
      }
      $ttlDebit += $ttlGl_dr;
      $ttlCredit += $ttlGl_cr;
      ?>
      @if(!empty($html))
      <tr>
        <td class="pl-4"><b>{{$glLedger->ledger_head}}</b></td>
        <td class="text-right"><b>{{number_format($ttlGl_dr, 2)}}</b></td>
        <td class="text-right"><b>{{number_format($ttlGl_cr, 2)}}</b></td>
      </tr>
      <?php echo $html; ?>
      @endif
      @endif
    @endforeach
    @endif
@endforeach
    <tr>
      <td class="text-right"><b>Total</b></td>
      <td class="text-right"><span class="double-border"><b>
 @if($set_currency->currency_position==2){{$set_currency->symbol}}@endif 
           {{number_format($ttlDebit, 2)}} 
            @if($set_currency->currency_position==1){{$set_currency->symbol}}@endif
           {{$set_currency->currency_text}}
     
    </b></span></td>
      <td class="text-right"><span class="double-border"><b>
         @if($set_currency->currency_position==2){{$set_currency->symbol}}@endif 
           {{number_format($ttlCredit, 2)}}
            @if($set_currency->currency_position==1){{$set_currency->symbol}}@endif
           {{$set_currency->currency_text}}
      
    </b></span></td>
    </tr>
  </tbody>
</table>