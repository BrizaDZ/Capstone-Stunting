<form action="/master/relationship/store" method="post">
    <div class="modal-header">
        <h4 class="modal-title">
            @if ($data->RelationshipID != 0)
                Edit Relationship
            @else
                Tambah Relationship Baru
            @endif
        </h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

    </div>

    <div class="modal-body ">
        <input type="hidden" name="id" value="{{ $data->RelationshipID }}" />
        <div class="mb-3 row">
            <div class="col-xl-12">
                <div class="form-group">
                    <label>Relationship</label>
                    <input type="text" name="name" class="form-control" required autocomplete="off"
                        value="{{ $data->name }}" />
                </div>
            </div>
        </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-success">Simpan</button>
    </div>
</form>
