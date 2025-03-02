<form action="/master/doctor/store" method="post">
    <div class="modal-header">
        <h4 class="modal-title">
            @if ($data->DoctorID != 0)
                Edit Dokter Puskesmas
            @else
                Tambah Dokter Baru Puskesmas
            @endif
        </h4>
        <button type="button" class="close text-red" data-dismiss="modal">&times;</button>
    </div>

    <div class="modal-body ">
        <input type="hidden" name="id" value="{{ $data->DoctorID }}" />
        <div class="mb-3 row">
            <div class="col-xl-12">
                <div class="form-group">
                    <label>Nama Dokter</label>
                    <input type="text" name="name" class="form-control" required autocomplete="off"
                        value="{{ $data->name }}" />
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-success">Simpan</button>
    </div>
</form>
