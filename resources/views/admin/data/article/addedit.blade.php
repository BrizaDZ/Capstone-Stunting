<form id="formartikel">
    <div class="modal-header">
        <h4 class="modal-title">
            @if ($data->ArtikelID != 0)
                Edit Artikel
            @else
                Tambah Artikel Baru
            @endif
        </h4>
        <button type="button" class="close text-red" data-dismiss="modal">&times;</button>
    </div>

    <div class="modal-body ">
        <input type="hidden" name="id" value="{{ $data->ArtikelID }}" />
        <div class="mb-3 row">
            <div class="col-xl-12">
                <div class="form-group">
                    <label>Judul Artikel</label>
                    <input type="text" name="title" class="form-control" required autocomplete="off"
                        value="{{ $data->title }}" />
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" name="date" class="form-control" required autocomplete="off"
                        value="{{ $data->date }}" />
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label>Photo</label>
                    <input type="file" class="form-control" name="photo" required>
                </div>
            </div>

            <div class="col-xl-12">
                <div class="form-group">
                    <div class="form-floating">
                        <label for="floatingTextarea2">Deskripsi</label>
                        <textarea class="form-control" id="floatingTextarea2" style="height: 100px" name="description"></textarea>
                    </div>
                </div>
            </div>
        </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-success" id="btn-photo">Simpan</button>
    </div>
</form>
