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
        <button type="submit" class="btn btn-success" id="btn-photo">Simpan</button>
    </div>
</form>

<script>
    function execCmd(command) {
        document.execCommand(command, false, null);
        updateButtonStates();
    }

    document.getElementById('formartikel').addEventListener('submit', function () {
        let editorContent = document.getElementById('customEditor').innerHTML;
        document.getElementById('description').value = editorContent;
    });

    document.addEventListener('DOMContentLoaded', function () {
        const oldContent = `{!! $data->description !!}`;
        document.getElementById('customEditor').innerHTML = oldContent;
    });

    document.querySelectorAll('.toggle-btn').forEach(button => {
        button.addEventListener('click', function () {
            execCmd(this.dataset.command);
        });
    });

    function updateButtonStates() {
    document.querySelectorAll('.toggle-btn').forEach(button => {
        const command = button.dataset.command;
        try {
            const isActive = document.queryCommandState(command);
            if (isActive) {
                button.classList.add('btn-primary');
                button.classList.remove('btn-outline-primary');
            } else {
                button.classList.remove('btn-primary');
                button.classList.add('btn-outline-primary');
            }
        } catch (e) {

        }
    });
}


    document.getElementById('customEditor').addEventListener('keyup', updateButtonStates);
    document.getElementById('customEditor').addEventListener('mouseup', updateButtonStates);
</script>
