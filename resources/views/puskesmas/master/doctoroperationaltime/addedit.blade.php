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
        <div class="row">
            <div class="col-xl-6">
                <div class="form-group">
                    <label>Nama Dokter</label>
                    <select class="form-control select2 sDoctor" name="DoctorID" required>
                        @if ($data->DoctorID != null)
                            <option value="{{ $data->DoctorID }}" selected="selected">{{ $data->name }}
                            </option>
                        @endif
                    </select>

                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label>Hari</label>
                    <input type="text" name="day" class="form-control" required autocomplete="off"
                        value="{{ $data->day }}" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="form-group">
                    <label>Jam Operasional</label>
                    <select class="form-control select2 sSchedule" name="OperationalTimeID" required>
                        @if ($data->OperationalTimeID != null)
                            <option value="{{ $data->OperationalTimeID }}" selected="selected">{{ $data->name }}
                            </option>
                        @endif
                    </select>

                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-success">Simpan</button>
    </div>
</form>
