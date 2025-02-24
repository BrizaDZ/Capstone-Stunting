<form action="/master/doctoroperationaltime/store" method="post">
    <div class="modal-header">
        <h4 class="modal-title">
            @if ($data->DoctorOperationalTimeID != 0)
                Edit Jadwal Dokter
            @else
                Tambah Jadwal Dokter Baru
            @endif
        </h4>
        <button type="button" class="close text-red" data-dismiss="modal">&times;</button>
    </div>

    <div class="modal-body ">
        <input type="hidden" name="id" value="{{ $data->DoctorOperationalTimeID }}" />
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
                    <label>Hari</label>
                    <input type="text" name="day" class="form-control" required autocomplete="off"
                        value="{{ $data->day }}" />
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label>Jam Kerja</label>
                    <input type="time" name="time_start" class="form-control" required autocomplete="off"
                        value="{{ $data->time_start }}" />
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label>Jam Selesai</label>
                    <input type="time" name="time_end" class="form-control" required autocomplete="off"
                        value="{{ $data->time_end }}" />
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-success">Simpan</button>
    </div>
</form>
