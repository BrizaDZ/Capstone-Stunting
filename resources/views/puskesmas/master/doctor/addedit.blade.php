<form id="formdoctor" method="post">
    <div class="modal-header">
        <h4 class="modal-title">
            @if ($data->DoctorID != 0)
                Edit Dokter Puskesmas
            @else
                Tambah Dokter Baru Puskesmas
            @endif
        </h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

    </div>

    <div class="modal-body ">
        <input type="hidden" name="id" value="{{ $data->DoctorID }}" />
        <div class="mb-3 row">
            <div class="col-xl-6">
                <div class="form-group">
                    <label>Nama Dokter</label>
                    <input type="text" name="name" class="form-control" required autocomplete="off"
                        value="{{ $data->name }}" />
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label>Photo</label>
                    <input type="file" class="form-control" name="photo" required>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary" id="btn-photo">Simpan</button>
    </div>
</form>
