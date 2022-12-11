<style type="text/css">
    textarea#remarks {
        height: 2.5em;
        transition: all 0.5s ease;
    }
    textarea#remarks:focus {
        height: 4em;
    }

    .modal-body .table {
        margin-bottom: 0;
    }
    .modal-body .table td, .modal-body .table th {
        padding: .50rem;
    }
    .modal-body .table .removeTran {
        padding: 2px 12px;
    }
</style>
<form action="{{route('Accounts.contra_voucher.update', $voucher->id)}}" method="put">
    @csrf
    <div class="modal-header bg-dark">
        <h5 class="modal-title text-white"><i class="fa fa-edit"></i> Update</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Tutup">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="modal-body">
        <div id="validate-error"></div>
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="form-group row">
                    <label class="col-md-4 col-sm-12 control-label" for="voucher_no">Nomor Voucher</label>
                    <div class="col-md-8 col-sm-12">
                        <input readonly="" type="text" class="form-control" id="voucher_no" name="voucher_no" placeholder="Auto" value="{{$voucher->voucher_code}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-sm-12 control-label" for="total_amount">Total Nominal</label>
                    <div class="col-md-8 col-sm-12">
                        <input readonly="" type="text" class="form-control" id="total_amount" name="total_amount" placeholder="Total Nominal" value="{{$voucher->transaction_amount}}">
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group row">
                    <label class="col-md-4 col-sm-12 control-label required" for="trans_date">Tanggal</label>
                    <div class="col-md-8 col-sm-12">
                        <input type="text" class="form-control" id="trans_date" name="trans_date" placeholder="Tanggal" required="" value="{{$tran_date}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-sm-12 control-label" for="remarks">Keterangan</label>
                    <div class="col-md-8 col-sm-12">
                        <textarea class="form-control" name="remarks" id="remarks">{{$voucher->remarks}}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <hr style="margin:-.2rem 0 0.7rem 0;">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="form-group row">
                    <label class="col-md-4 col-sm-12 control-label required" for="dr_sl_id">Buku Besar Debit</label>
                    <div class="col-md-8 col-sm-12">
                        <select class="form-control select2" id="dr_sl_id" name="dr_sl_id">
                            <option value="">Pilih Buku Besar Pembantu</option>
                            @foreach($slLedgers as $slLedger)                      
                            <option value="{{$slLedger->id}}">{{$slLedger->ledger_code.' - '.$slLedger->ledger_head}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="form-group row">
                    <label class="col-md-4 col-sm-12 control-label required" for="cr_sl_id">Credit Ledger</label>
                    <div class="col-md-8 col-sm-12">
                        <select class="form-control select2" id="cr_sl_id" name="cr_sl_id">
                            <option value="">Pilih Buku Besar Pembantu</option>
                            @foreach($slLedgers as $slLedger)                      
                            <option value="{{$slLedger->id}}">{{$slLedger->ledger_code.' - '.$slLedger->ledger_head}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="form-group row">
                    <label class="col-md-4 col-sm-12 control-label required" for="amount">Nominal</label>
                    <div class="col-md-8 col-sm-12">
                        <input type="text" class="form-control" id="amount" name="amount" placeholder="Nominal" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-0">&nbsp;</div>
            <div class="col-md-4 col-sm-12">
                <button type="button" class="btn btn-dark btn-sm" id="addTran"><i class="fa fa-plus"></i> Tambah Transaksi</button>
            </div>
        </div>
        <hr style="margin:-.2rem 0 0.7rem 0;">
        <div class="row">
            <div class="col-sm-12">
                <table class="responsive table table-striped table-bordered" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="4%">No.</th>
                            <th>Buku Besar Pembantu Debit</th>
                            <th>Buku Besar Pembantu Kredit</th>
                            <th width="15%">Nominal</th>
                            <th class="text-center" width="4%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="selected_account">
                        @php $i=1; @endphp
                        @forelse($voucherDtl as $voucherDtl)
                            <tr class="tran_dtl">
                                <td class="text-center"><span class="slNo">{{$i++}}</span><input type="hidden" name="tran_dtl_id[]" value="{{$voucherDtl->id}}"></td>
                                <td>{{$voucherDtl->drSlHead}}<input type="hidden" name="dr_sl_id[]" value="{{$voucherDtl->dr_sub_ledger}}"></td>
                                <td>{{$voucherDtl->crSlHead}}<input type="hidden" name="cr_sl_id[]" value="{{$voucherDtl->cr_sub_ledger}}"></td>
                                <td>{{$voucherDtl->transaction_amount}}<input type="hidden" class="dtlAmount" name="amount[]" value="{{$voucherDtl->transaction_amount}}"></td>
                                <td class="text-center"><button type="button" class="btn btn-danger btn-sm removeTran"><b><i class="fa fa-times"></i></b></button></td>
                            </tr>
                        @empty
                            <tr class="nothing_here">
                                <td colspan="5" class="text-center">Tidak ada disini</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr class="ttl_acc_foot">
                            <th colspan="3"><b class="pull-right">Nominal</b></th>
                            <th colspan="2"><b id="total_amount_tbl">{{$voucher->transaction_amount}}</b></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-inverse-dark" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
        <button type="submit" class="btn btn-dark"><i class="fa fa-check-square-o"></i> Simpan</button>
    </div>
</form>

<script>
$(document).ready(function() {
    var slLedgerData = JSON.parse('<?php echo $slLedgerData; ?>');

    $("#trans_date").datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true
    });

    $(".select2").select2();

    $("#addTran").click(function(e){
        e.preventDefault();

        var dr_sl_id = $("#dr_sl_id").val();
        var cr_sl_id = $("#cr_sl_id").val();
        var amount = $("#amount").val();

        if(!dr_sl_id) {
            alert("Silahkan Pilih Buku Besar Pembantu Debit");
        } else if(!cr_sl_id) {
            alert("Silahkan Pilih Buku Besar Pembantu Kredit");
        } else if(!amount) {
            alert("Silakan Masukkan Nominal");
        } else {
            if(amount>0) {
                if($("#selected_account").find(".nothing_here").length>0) {
                    $("#selected_account").find(".nothing_here").remove();
                }
                var slNo = $("#selected_account").find(".tran_dtl").length+1;
                var html = '<tr class="tran_dtl">';
                html += '<td class="text-center"><span class="slNo">'+slNo+'</span><input type="hidden" name="tran_dtl_id[]" value=""></td>';
                html += '<td>'+slLedgerData[dr_sl_id].ledger_head+'<input type="hidden" name="dr_sl_id[]" value="'+dr_sl_id+'"></td>';
                html += '<td>'+slLedgerData[cr_sl_id].ledger_head+'<input type="hidden" name="cr_sl_id[]" value="'+cr_sl_id+'"></td>';
                html += '<td>'+amount+'<input type="hidden" class="dtlAmount" name="amount[]" value="'+amount+'"></td>';
                html += '<td class="text-center"><button type="button" class="btn btn-danger btn-sm removeTran"><b><i class="fa fa-times"></i></b></button></td>';
                html += '</tr>';
                $("#selected_account").append(html);

                //Refresh
                $("#amount").val("");
                //ttl
                ttlAmountCalc();
            } else {
                alert("Jumlahnya harus lebih besar dari nol");
            }
        }
    });

    $("#selected_account").on("click", ".removeTran", function(){
        $(this).parents("tr").first().remove();
        //Sl no
        var slNo=1;
        $("#selected_account").find(".slNo").each(function(){
            $(this).html(slNo++);
        });
        //Nothing
        if($("#selected_account").find(".tran_dtl").length<=0) {
            $("#selected_account").html('<tr class="nothing_here"><td colspan="5" class="text-center">Tidak ada disini</td></tr>');
        }
        //ttl
        ttlAmountCalc();
    });

    function ttlAmountCalc() {
        var ttlAmount = 0;
        $("#selected_account").find(".dtlAmount").each(function(){
            ttlAmount += parseFloat($(this).val());
        });
        ttlAmount = (ttlAmount==0) ? "" : ttlAmount;
        $("#total_amount").val(ttlAmount);
        $("#total_amount_tbl").html(ttlAmount);
    }
});
</script>