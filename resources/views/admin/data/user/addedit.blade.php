<form action="/data/user/store" method="post">
    <div class="modal-header">
        <h4 class="modal-title">
                Edit User
        </h4>
        <button type="button" class="close text-red" data-dismiss="modal">&times;</button>
    </div>

    <div class="modal-body ">
        <input type="hidden" name="id" value="{{ $data->id }}" />
        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" required autocomplete="off"
                value="{{ $data->name }}" />
        </div>
        <div class="form-group">
            <label>email</label>
            <input type="text" name="email" class="form-control" required autocomplete="off"
                value="{{ $data->email}}" />
        </div>
        <div class="form-group">
            <label>Role</label>
            <select name="role_id" class="form-control" id="">
                <option value="1">Admin</option>
                <option value="2">User</option>
                <option value="3">Puskesmas</option>
            </select>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-success">Simpan</button>
    </div>
</form>
