<form action="/master/doctoroperationaltime/store" method="post">
    <div class="modal-header">
        <h4 class="modal-title">
            @if ($data->DoctorOperationalTimeID != 0)
                Edit Jadwal Dokter
            @else
                Tambah Jadwal Dokter Baru
            @endif
        </h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

    </div>

    <div class="modal-body ">
        <input type="hidden" name="id" value="{{ $data->DoctorOperationalTimeID }}" />

        <div class="row mb-3">
            <div class="col-xl-6">
                <div class="form-group">
                    <label>Nama Dokter</label>
                    <select class="form-control select2 sDoctor" name="DoctorID" required>
                        @if ($data->DoctorID != null)
                            <option value="{{ $data->DoctorID }}" selected="selected">{{ $data->doctor_name }}
                            </option>
                        @endif
                    </select>

                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" name="date" class="form-control" required autocomplete="off"
                        value="{{ $data->date }}" />
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-xl-6">
                <div class="form-group">
                    <label>Jam Operasional</label>
                    <select class="form-control select2 sSchedule" name="OperationalTimeID" required>
                        @if ($data->OperationalTimeID != null)
                            <option value="{{ $data->OperationalTimeID }}" selected="selected">{{ $data->operational_time_name }}
                            </option>
                        @endif
                    </select>

                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label>Quota</label>
                    <input type="number" name="quota" required class="form-control"
                        value="{{ $data->quota }}" />

                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>
