<form action="/profile/patient/store" method="post">
    @csrf
    <div class="modal-header bg-primary text-white">
        <h4 class="modal-title">
            @if ($data->PatientID != null)
                Edit Pasien
            @else
                Tambah Pasien

            @endif
        </h4>
        <button type="button" class="btn btn-light text-red ms-auto" data-dismiss="modal">&times;</button>
    </div>

    <div class="modal-body bg-primary-200">
        <input type="hidden" name="PatientID" value="{{ $data->PatientID }}" />


        <div class="row mb-3">
            <div class="col-lg-6">
                <label class="form-label">NIK</label>
                <input type="text" class="form-control" name="nik" maxlength="16" required value="{{ $data->nik }}">
            </div>
            <div class="col-lg-6">
                <label class="form-label">Nama</label>
                <input type="text" class="form-control" name="name" value="{{ $data->name }}" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-lg-4">
                <label class="form-label">Hubungan dengan pasien</label>
                <select class="form-control select2 sRelationship" name="RelationshipID" required>
                    @if ($data->RelationshipID != null)
                        <option value="{{ $data->RelationshipID }}" selected="selected">{{ $data->relationshipName }}
                        </option>
                    @endif
                </select>
            </div>
            <div class="col-lg-2">
                <label class="form-label">Umur (Bulan)</label>
                <input type="number" class="form-control" name="age" value="{{ $data->age }}" required>
            </div>
            <div class="col-lg-6">
                <label class="form-label">Jenis Kelamin</label>
                <select name="gender" class="form-control" required>
                    <option value="{{$data->gender}}">{{$data->gender}}</option>
                    <option value="Perempuan">Perempuan</option>
                    <option value="Laki-Laki">Laki-Laki</option>
                </select>
            </div>
        </div>
            @if ($data->PatientID == null)
            <input type="hidden" name="kabupaten" id="NamaKab">
            <input type="hidden" name="kecamatan" id="NamaKec">
            <input type="hidden" name="kelurahan" id="NamaKel">
            <div class="row mb-3">
                <div class="col-lg-6">
                    <label class="form-label">Provinsi</label>
                    <select type="text" class="form-control select2 sProvince">

                    </select>
                </div>
                <div class="col-lg-6">
                    <label class="form-label">Kabupaten</label>
                    <select type="text" class="form-control select2 sRegency">
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-3">
                    <label class="form-label">Kecamatan</label>
                    <select type="text" class="form-control select2 sDistrict">

                    </select>

                </div>
                <div class="col-lg-3">
                    <label class="form-label">Kelurahan</label>
                    <select type="text" class="form-control select2 sVillage">
                    </select>
                </div>
                <div class="col-lg-3">
                    <label class="form-label">RT</label>
                    <input type="number" class="form-control" name="rt" value="{{ $data->rt }}">
                </div>
                <div class="col-lg-3">
                    <label class="form-label">RW</label>
                    <input type="number" class="form-control" name="rw" value="{{ $data->rw }}">
                </div>
            </div>
            @endif


        <div class="row mb-3">
            <div class="col-lg-12">
                <label class="form-label">Alamat</label>
                <textarea class="form-control" name="alamat" id="" cols="30" rows="2" value="{{ $data->alamat }}"></textarea>
            </div>
        </div>
    </div>
    <div class="modal-footer bg-primary-200">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>
