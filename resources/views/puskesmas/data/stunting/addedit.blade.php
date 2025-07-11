<form action="/data/user/store" method="post">
    <div class="modal-header">
        <h4 class="modal-title">
            Form Checkup
        </h4>
        <button type="button" class="close text-red" data-dismiss="modal">&times;</button>
    </div>

    <div class="modal-body ">
        <input type="hidden" name="AppointmentID" value="{{ $data->AppointmentID }}" />
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
                <option value=""></option>
            </select>
        </div>
        <div class="form-group">
            <label>BB/U</label>
            <input type="number" name="weightage" class="form-control" required autocomplete="off"
                value="{{ $data->weightage}}" />
        </div>
        <div class="form-group">
            <label>TB/U</label>
            <input type="number" name="heightage" class="form-control" required autocomplete="off"
                value="{{ $data->heightage}}" />
        </div>
        <div class="form-group">
            <label>BB/TB</label>
            <input type="number" name="weightheight" class="form-control" required autocomplete="off"
                value="{{ $data->weightheight}}" />
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>
