<form action="/data/stunting/store" method="post">
    <div class="modal-header">
        <h4 class="modal-title">
            Data Stunting
        </h4>
        <button type="button" class="close text-red" data-dismiss="modal">&times;</button>
    </div>

    <div class="modal-body ">
        <input type="hidden" name="StuntingID" value="{{ $data->StuntingID }}" />
        <input type="hidden" name="PatientID" value="{{ $data->PatientID }}" />
        <div class="form-group">
            <label>Berat</label>
            <input type="number" name="weight" class="form-control" required autocomplete="off"
                value="{{ $data->weight }}" />
        </div>
        <div class="form-group">
            <label>Tinggi Badan</label>
            <input type="number" name="height" class="form-control" required autocomplete="off"
                value="{{ $data->height}}" />
        </div>
        <div class="form-group">
            <label>Umur</label>
            <input type="number" name="age" class="form-control" required autocomplete="off"
                value="{{ $data->age}}" />
        </div>
        <div class="form-group">
            <label>Jenis Kelamin</label>
            <input type="text" name="gender" class="form-control" required autocomplete="off"
                value="{{ $data->gender}}" />
        </div>
        <div class="form-group">
            <label>Cara Mengukur</label>
            <select name="measuretype" id="" class="form-control">
                @if($data->measuretype == 'Berdiri')
                    <option value="Berdiri" selected>Berdiri</option>
                    <option value="Telentang">Telentang</option>

                @else
                    <option value="Berdiri">Berdiri</option>
                    <option value="Telentang" selected>Telentang</option>
                @endif
            </select>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>
