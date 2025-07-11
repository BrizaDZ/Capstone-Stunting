<form id="formPasien" action="/data/pasien/store" method="post">
    @csrf
    <div class="modal-header">
        <h4 class="modal-title">
                Tambah Pasien
        </h4>
        <button type="button" class="close text-red" data-dismiss="modal">&times;</button>
    </div>

    <div class="modal-body ">
        <input type="hidden" name="id" value="{{ $data->PatientID }}" />
        <input type="hidden" name="kabupaten" id="NamaKab">
        <input type="hidden" name="kecamatan" id="NamaKec">
        <input type="hidden" name="kelurahan" id="NamaKel">

        <div class="row mb-3">
            <div class="col-lg-6">
                <label class="form-label">NIK</label>
                <input type="text" class="form-control" name="nik" value="{{ $data->nik }}" maxlength="16">

            </div>
            <div class="col-lg-6">
                <label class="form-label">Nama</label>
                <input type="text" class="form-control" name="name" value="{{ $data->name }}">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-lg-4">
                <label class="form-label">Hubungan dengan pasien</label>
                <select class="form-control select2 sRelationship" name="RelationshipID" required>
                    @if ($data->RelationshipID != null)
                        <option value="{{ $data->RelationshipID }}" selected="selected">{{ $data->RelationshipID }}
                        </option>
                    @endif
                </select>
            </div>
            <div class="col-lg-2">
                <label class="form-label">Umur</label>
                <input type="number" class="form-control" name="age" value="{{ $data->age }}">
            </div>
            <div class="col-lg-6">
                <label class="form-label">Jenis Kelamin</label>
                <select name="gender" class="form-control">
                    <option value="{{$data->gender}}"></option>
                    <option value="Perempuan">Perempuan</option>
                    <option value="Laki-Laki">Laki-Laki</option>
                </select>
            </div>
        </div>
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
                <select type="text" class="form-control select2 sDistrict"></select>
            </div>
            <div class="col-lg-3">
                <label class="form-label">Kelurahan</label>
                <select type="text" class="form-control select2 sVillage"></select>
            </div>
            <div class="col-lg-3">
                <label class="form-label">RT</label>
                <input type="number" class="form-control" name="rt">
            </div>
            <div class="col-lg-3">
                <label class="form-label">RW</label>
                <input type="number" class="form-control" name="rw">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-lg-12">
                <label class="form-label">Alamat</label>
                <textarea class="form-control" name="alamat" id="" cols="30" rows="2" >{{$data->alamat}}</textarea>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>



