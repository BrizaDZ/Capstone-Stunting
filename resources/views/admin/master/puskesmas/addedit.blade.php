<form action="/data/puskesmas/store" method="post">
    <div class="modal-header">
        <h4 class="modal-title">
            @if ($data->PuskesmasID != 0)
                Edit Lokasi Puskesmas
            @else
                Tambah Lokasi Puskesmas Baru
            @endif
        </h4>
        <button type="button" class="close text-red" data-dismiss="modal">&times;</button>
    </div>

    <div class="modal-body ">
        <input type="hidden" name="id" value="{{ $data->PuskesmasID }}" />
        <div class="mb-3 row">
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
        <div class="mb-3 row">
            <div class="col-xl-4">
                <div class="form-group">
                    <label>Kabupaten</label>
                    <input type="text" name="kabupaten" class="form-control select2 sKabupaten">
                        {{-- @if ($data->KabupatenID != null)
                            <option value="{{ $data->KabupatenID }}" selected="selected">{{ $data->NamaKabupaten }}
                            </option>
                        @endif --}}
                </div>
            </div>
            <div class="col-xl-4">
                <div class="form-group">
                    <label>Kecamatan</label>
                    <input type="text" name="kecamatan" class="form-control select2 sKecamatan">
                        {{-- @if ($data->KecamatanID != null)
                            <option value="{{ $data->KecamatanID }}" selected="selected">{{ $data->NamaKecamatan }}
                            </option>
                        @endif --}}
                </div>
            </div>
            <div class="col-xl-4">
                <div class="form-group">
                    <label>Kelurahan</label>
                    <input type="text" name="kelurahan" class="form-control select2 sKelurahan">
                        {{-- @if ($data->KelurahanID != 0)
                            <option value="{{ $data->KelurahanID }}" selected="selected">{{ $data->NamaKelurahan }}
                            </option>
                        @endif --}}
                </div>
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
