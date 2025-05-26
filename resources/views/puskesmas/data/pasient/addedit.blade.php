<form action="/data/pasien/store" method="post">
    @csrf
    <div class="modal-header">
        <h4 class="modal-title">
                Tambah Pasien
        </h4>
        <button type="button" class="close text-red" data-dismiss="modal">&times;</button>
    </div>

    <div class="modal-body ">
        <input type="hidden" name="id" value="{{ $data->PatientID }}" />
        <div class="row mb-3">
            <div class="col-lg-6">
                <label class="form-label">NIK</label>
                <input type="text" class="form-control" name="nik" value="{{ $data->nik }}">
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
                <label class="form-label">Kabupaten</label>
                <input type="text" class="form-control" name="kabupaten" value="{{ $data->kabupaten }}">
            </div>
            <div class="col-lg-6">
                <label class="form-label">Kelurahan</label>
                <input type="text" class="form-control" name="kelurahan" value="{{ $data->kelurahan }}">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-lg-6">
                <label class="form-label">Kecamatan</label>
                <input type="text" class="form-control" name="kecamatan" value="{{ $data->kecamatan }}">
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
        <div class="row mb-3">
            <div class="col-lg-12">
                <label class="form-label">Alamat</label>
                <textarea class="form-control" name="alamat" id="" cols="30" rows="1" >{{$data->alamat}}</textarea>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-success">Simpan</button>
    </div>
</form>
