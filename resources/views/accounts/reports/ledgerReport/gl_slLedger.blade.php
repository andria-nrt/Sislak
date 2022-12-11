<select class="form-control select2" id="sl_id" name="sl_id">
    <option value="">{{$gl_id>0 ? ('All Subsidiary Ledger of '.$gl_name) : 'Pilih Buku Besar Pembantu'}}</option>
    @foreach($slLedgers as $glName=>$slLedger)
    <optgroup label="{{$glName}}">
    @foreach($slLedger as $slLedger)                        
    <option value="{{$slLedger->id}}">{{$slLedger->ledger_code.' - '.$slLedger->ledger_head}}</option>
    @endforeach
    </optgroup>
    @endforeach
</select>

<script type="text/javascript">
  $(document).ready(function(){
    $("#sl_id").select2();
  });
</script>