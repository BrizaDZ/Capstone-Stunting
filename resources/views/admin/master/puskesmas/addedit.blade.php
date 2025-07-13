<form action="/data/puskesmas/store" method="post">
    <div class="modal-header">
        <h4 class="modal-title">
            Data Puskesmas
        </h4>
        <button type="button" class="close text-red" data-dismiss="modal">&times;</button>
    </div>

    <div class="modal-body ">
        <input type="hidden" name="id" value="{{ $data->user_id }}" />
        <input type="hidden" name="lokasiid" value="{{ $data->LokasiPuskesmasID ?? 0 }}">
        <input type="hidden" name="kabupaten" id="NamaKab" value="{{ $data->kabupaten }}">
        <input type="hidden" name="kecamatan" id="NamaKec" value="{{ $data->kecamatan }}">
        <input type="hidden" name="kelurahan" id="NamaKel" value="{{ $data->kelurahan }}">
        <div class="row">
            <div class="col-xl-6">
                <div class="form-group">
                    <label>Nama Puskesmas</label>
                    <input type="text" name="nama" class="form-control" required autocomplete="off"
                        value="{{ $data->nama }}" />
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label>alamat</label>
                    <input type="text" name="alamat" class="form-control" required autocomplete="off"
                        value="{{ $data->alamat }}" />
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-xl-6">
                <label class="form-label">Provinsi</label>
                <select type="text" class="form-control select2 sProvince">
                </select>
            </div>
            <div class="col-xl-6">
                <label class="form-label">Kabupaten</label>
                <select type="text" class="form-control select2 sRegency">
                    @if ($data->kabupaten != null)
                        <option value="{{ $data->kabupaten }}" selected="selected">{{ $data->kabupaten }}</option>
                    @endif
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-xl-6">
                <label class="form-label">Kecamatan</label>
                <select type="text" class="form-control select2 sDistrict">
                    @if ($data->kecamatan != null)
                        <option value="{{ $data->kecamatan }}" selected="selected">{{ $data->kecamatan }}</option>
                    @endif
                </select>
            </div>
            <div class="col-xl-6">
                <label class="form-label">Kelurahan</label>
                <select type="text" class="form-control select2 sVillage">
                    @if ($data->kelurahan != null)
                        <option value="{{ $data->kelurahan }}" selected="selected">{{ $data->kelurahan }}</option>
                    @endif
                </select>
            </div>
        </div>
        {{-- <div class="mb-3 row">
            <div class="col-xl-3">
                <div class="form-group">
                    <label>RW</label>
                    <select name="rw" class="form-control select2 rw">
                        <option value="">Pilih RW</option>
                        @for ($i = 1; $i <= 20; $i++)
                            <option value="{{ $i }}" {{ $data->rw == $i ? 'selected' : '' }}>
                                {{ $i }}</option>
                        @endfor
                    </select>
                </div>
            </div>
            <div class="col-xl-3">
                <div class="form-group">
                    <label>RT</label>
                    <select name="rt" class="form-control select2 rt">
                        <option value="">Pilih RW</option>
                        @for ($i = 1; $i <= 20; $i++)
                            <option value="{{ $i }}" {{ $data->rt == $i ? 'selected' : '' }}>
                                {{ $i }}
                            </option>
                        @endfor
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" name="alamat" class="form-control" required autocomplete="off"
                        value="{{ $data->alamat }}" />
                </div>
            </div>
        </div> --}}
        <div class="mb-3 row">
            <div class="col-xl-6">
                <div class="form-group">
                    <label>Latitude</label>
                    <input type="text" name="latitude" class="form-control" required autocomplete="off"
                        value="{{ $data->latitude }}" />
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label>Longitude</label>
                    <input type="text" name="longitude" class="form-control" required autocomplete="off"
                        value="{{ $data->longitude }}" />
                </div>
            </div>
        </div>
        {{-- <div class="mb-3 row">
            <div class="col-xl-6">
                <div class="form-group">
                    <label>Hari Kerja</label>
                    <input type="text" name="Hari_Kerja" class="form-control" required autocomplete="off"
                        value="{{ $data->Hari_Kerja }}" />
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label>Jam Operasional</label>
                    <input type="text" name="Jam_Operasional" class="form-control" required autocomplete="off"
                        value="{{ $data->Jam_Operasional }}" />
                </div>
            </div>
        </div> --}}
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>
