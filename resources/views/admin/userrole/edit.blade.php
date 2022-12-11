<form action="{{route('Admin.userrole.update', $data->id)}}" method="put">
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
            
            <div class="col-md-12">
                <div class="form-group">
                    <label for="username">Penamaan </label>
                    <input required="" type="text" class="form-control" id="role_name" name="role_name" placeholder="Enter Role Name" value="{{$data->role_name}}">
                </div>
            </div>
            
            
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-inverse-dark" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
        <button type="submit" class="btn btn-dark"><i class="fa fa-check-square-o"></i> Simpan</button>
    </div>
</form>