<div class="print_button">
  <button class="btn btn-info" onclick="printReport()"><i class="fa fa-print" aria-hidden="true"></i> Print</button>
</div>

<h5 class="company_name">{{$company_name}}</h4>
<div class="title">Receipts &amp; Payments</div>
<div class="title small">{{$title_date}}</div>

<table class="responsive table table-bordered">
  <tbody>
@foreach([1=>'Receipts', 2=>'Payments'] as $index=>$recPay)
  <?php $ttlAmount = 0; ?>
    <tr>
      <td colspan="2" class="bg-light_1"><b>{{$recPay}}</b></td>
    </tr>
    <tr>
      <td class="pl-4 bg-light_2"><b>Detail</b></td>
      <td width="20%" class="text-right bg-light_2"><b>AmoNominalunt</b></td>
    </tr>
    @if($index==1)
      @if(array_key_exists($cash_glId, $slLedgers))
      <?php
      $ttlGl = 0;
      $html = '';
      $i=0;
      foreach($slLedgers[$cash_glId] as $slLedger) {
        $amount = (array_key_exists($slLedger->id, $cash_opening)) ? $cash_opening[$slLedger->id]->balanceAmount : 0;
        $html .= '<tr>';
        $html .= '<td class="pl-4"><span class="pl-4">'.$slLedger->ledger_head.'</span></td>';
        $html .= '<td class="text-right">'.number_format($amount, 2).'</td>';
        $html .= '</tr>';
        $ttlGl += $amount;
      }
      $ttlAmount += $ttlGl;
      ?>
      <tr>
        <td class="pl-4"><b>Opening Balance</b></td>
        <td class="text-right"><b>{{number_format($ttlGl, 2)}}</b></td>
      </tr>
      <?php echo $html; ?>
      @endif
    @endif

    @foreach($accTypes as $accType)
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
            $amount = ($index==1) ? $amount->credit_amount : $amount->debit_amount;
          }
          if($amount!=0) {
            $html .= '<tr>';
            $html .= '<td class="pl-4"><span class="pl-4">'.$slLedger->ledger_head.'</span></td>';
            $html .= '<td class="text-right">'.number_format($amount, 2).'</td>';
            $html .= '</tr>';
            $ttlGl += $amount;
          }
        }
        $ttlAmount += $ttlGl;
        ?>
        @if(!empty($html))
        <tr>
          <td class="pl-4"><b>{{$glLedger->ledger_head}}</b></td>
          <td class="text-right"><b>{{number_format($ttlGl, 2)}}</b></td>
        </tr>
        <?php echo $html; ?>
        @endif
        @endif
      @endforeach
      @endif
    @endforeach

    @if($index==2)
      @if(array_key_exists($cash_glId, $slLedgers))
      <?php
      $ttlGl = 0;
      $html = '';
      $i=0;
      foreach($slLedgers[$cash_glId] as $slLedger) {
        $amount = (array_key_exists($slLedger->id, $cash_closing)) ? $cash_closing[$slLedger->id]->balanceAmount : 0;
        $html .= '<tr>';
        $html .= '<td class="pl-4"><span class="pl-4">'.$slLedger->ledger_head.'</span></td>';
        $html .= '<td class="text-right">'.number_format($amount, 2).'</td>';
        $html .= '</tr>';
        $ttlGl += $amount;
      }
      $ttlAmount += $ttlGl;
      ?>
      <tr>
        <td class="pl-4"><b>Closing Balance</b></td>
        <td class="text-right"><b>{{number_format($ttlGl, 2)}}</b></td>
      </tr>
      <?php echo $html; ?>
      @endif
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
    @if($index==1)
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    @endif
@endforeach
  </tbody>
</table>