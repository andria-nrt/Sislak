@include("accounts.voucher.voucherHeader")

<div class="voucher">
    <table width="100%"  style="border: none;">
        <tr>
            <td class="text-center" align="center" colspan="4" class="border-none" style="border: none;">
                <div class="header">
                    <p class="company_name"><?php echo $companyDetails; ?></p>
                    <p class="title"><?php echo $voucherName; ?></p>
                </div>
            </td>
        </tr>
        <tr>
            <?php $date = DateTime::createFromFormat('Y-m-d', $voucher->transaction_date)->format('d/m/Y'); ?>
            <td width="50%" colspan="2" align="left" valign="middle">Nomor Voucher : {{$voucher->voucher_code}}</td>
            <td width="50%" colspan="2" align="right" valign="middle">Date: {{$date}}</td>
        </tr>
        <tr>
            <td colspan="4" height="10"></td>
        </tr>
        <tr>
            <td colspan="4" class="overflow">
                <table class="particulars">
                    <thead>
                        <tr>
                            <td width="15%" align="center" valign="middle">Kode</td>
                            <td align="center" valign="middle">Detail</td>
                            <td width="20%" align="center" valign="middle">Debit</td>
                            <td width="20%" align="center" valign="middle">Kredit</td>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($tranDetails as $tranBy=>$transaction)
                        <?php
                        $tranByDetails = explode('_', $tranBy);
                        $tranAmount = collect($transaction)->sum("transaction_amount");
                        $debit = $byGrp ? $tranAmount : 0;
                        $credit = $byGrp ? 0 : $tranAmount;
                        $tranBy = $byGrp ? $cashLedgers[$tranByDetails[0]] : $transaction[0];

                        $ledgerSummeryData = '<tr>';
                        $ledgerSummeryData .= '<td align="center">'.@$tranBy->ledger_code.'</td>';
                        $ledgerSummeryData .= '<td'.(($credit!=0)?' style=padding-left:20px;':'').'>'.@$tranBy->ledger_head.'</td>';
                        $ledgerSummeryData .= '<td align="right" valign="middle">'.number_format($debit, 2).'</td>';
                        $ledgerSummeryData .= '<td align="right" valign="middle">'.number_format($credit, 2).'</td>';
                        $ledgerSummeryData .= '</tr>';
                        ?>

                        <?php 
                            if($byGrp) { echo $ledgerSummeryData; } 
                        ?>

                        @foreach($transaction as $tran)
                            <?php
                                $debit = $byGrp ? 0 : $tran->transaction_amount;
                                $credit = $byGrp ? $tran->transaction_amount : 0;
                                $tranData = $byGrp ? $tran : $cashLedgers[$tran->dr_sub_ledger];
                            ?>
                            <tr>
                                <td align="center">{{$tranData->ledger_code}}</td>
                                <td @if($credit!=0){{'style=padding-left:20px;'}}@endif>{{$tranData->ledger_head}}</td>
                                <td align="right" valign="middle">{{number_format($debit, 2)}}</td>
                                <td align="right" valign="middle">{{number_format($credit, 2)}}</td>
                            </tr>
                        @endforeach
                        <?php if(!$byGrp) { echo $ledgerSummeryData; } ?>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td align="right" colspan="2">Total:</td>
                            <td align="right" valign="middle">
        @if($set_currency->currency_position==2){{$set_currency->symbol}}@endif 
          {{number_format($voucher->transaction_amount, 2)}}
           @if($set_currency->currency_position==1){{$set_currency->symbol}}@endif
           {{$set_currency->currency_text}}
           </td>
                            <td align="right" valign="middle">
 @if($set_currency->currency_position==2){{$set_currency->symbol}}@endif 
         {{number_format($voucher->transaction_amount, 2)}}
           @if($set_currency->currency_position==1){{$set_currency->symbol}}@endif
           {{$set_currency->currency_text}}

           </td>
                        </tr>
                    </tfoot>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="4" style="text-transform: capitalize;"><strong>In Word: {{$amount_in_word}} Taka Only</strong></td>
        </tr>
        @if(!empty(@$voucher->remarks))
        <tr>
            <td colspan="4" style="padding-top: 5px;"><strong>Remarks:</strong> {{$voucher->remarks}}</td>
        </tr>
        @endif
        <tr>
            <td colspan="4" height="80"></td>
        </tr>
        <tr class="voucher_footer">
            <td width="30%" align="left" valign="middle">Prepared by</td>
            <td width="40%" align="center" valign="middle">Checked by</td>
            <td width="30%" align="right" valign="middle">Approved by</td>
        </tr>
    </table>
</div>

@include("accounts.voucher.voucherFooter")
