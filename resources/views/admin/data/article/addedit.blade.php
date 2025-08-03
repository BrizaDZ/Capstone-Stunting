<form id="formartikel" method="post">
    <div class="modal-header">
        <h4 class="modal-title">
            @if ($data->ArticleID != 0)
                Edit Artikel
            @else
                Tambah Artikel Baru
            @endif
        </h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

    </div>

    <div class="modal-body ">
        <input type="hidden" name="id" value="{{ $data->ArticleID }}" />
        <div class="mb-3 row g-3">
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
                    <label for="customEditor">Deskripsi</label>
                    <div class="border rounded p-2" id="customEditor" contenteditable="true" style="min-height: 150px;"></div>
                    <input type="hidden" name="description" id="description">
                </div>
                <div class="btn-group mt-2">
                    <button type="button" class="btn btn-sm btn-outline-primary toggle-btn" data-command="bold"><b>B</b></button>
                    <button type="button" class="btn btn-sm btn-outline-primary toggle-btn" data-command="italic"><i>I</i></button>
                    <button type="button" class="btn btn-sm btn-outline-primary toggle-btn" data-command="underline"><u>U</u></button>
                    <button type="button" class="btn btn-sm btn-outline-primary toggle-btn" data-command="insertUnorderedList">• List</button>
                </div>
            </div>

        </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-success" id="btn-photo">Simpan</button>
    </div>
</form>

