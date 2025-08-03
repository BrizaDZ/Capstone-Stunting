<form action="/data/janji-temu/store" method="post">
    <div class="modal-header">
        <h4 class="modal-title">
            Form Checkup
        </h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

    </div>

    <div class="modal-body ">
        <input type="hidden" name="AppointmentID" value="{{ $data->AppointmentID }}" />
        {{-- <input type="hidden" name="StuntingID" value="{{ $data2->StuntingID }}" /> --}}


        @if ($data->AppointmentID != null)
        <div class="form-group mb-3">
            <label>ID Pasien</label>
            <input type="text" name="PatientID" class="form-control" readonly
                value="{{ $data2->PatientID }}" />
        </div>
        @else
        <div class="form-group mb-3">
            <label>ID Pasien</label>
            <div class="row">
                <div class="col-10">
                    <input type="text" name="PatientID" id="PatientIDSearch" class="form-control" value="{{ $data2->PatientID }}"/>
                </div>
                <div class="col-2">
                    <button class="btn btn-primary" id="searchPatient">Cari</button>

                </div>
            </div>
        </div>
        @endif
        <div class="form-group mb-3">
            <label>Nama</label>
            <input type="text" name="name" id="PatientName" class="form-control" readonly
                value="{{ $data2->name }}" />
        </div>
        <div class="form-group mb-3">
            <label>Jenis Kelamin</label>
            <input type="text" name="gender" id="PatientGender" class="form-control"
                value="{{ $data2->gender }}" readonly/>
        </div>
        <div class="form-group mb-3">
            <label>Berat</label>
            <input type="number" name="weight" step="any" class="form-control" required autocomplete="off"
                value="{{ $data->weight }}" />
        </div>
        <div class="form-group mb-3">
            <label>Tinggi Badan</label>
            <input type="number" name="height" step="any" class="form-control" required autocomplete="off"
                value="{{ $data->height}}" />
        </div>
        <div class="form-group mb-3">
            <label>Umur</label>
            <input type="number" name="age" class="form-control" required autocomplete="off"
                value="{{ $data->age}}" />
        </div>
        <div class="form-group mb-3">
            <label>Cara Mengukur</label>
            <select name="measuretype" id="" class="form-control" required>
                <option value=""></option>
                <option value="Telentang">Telentang</option>
                <option value="Berdiri">Berdiri</option>
            </select>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>

<script>
    $(document).on('click', '#searchPatient', function (e) {
    e.preventDefault();

    // Ambil nilai ID Pasien dari input
    var patientId = $('#PatientIDSearch').val();

    if (patientId === '') {
        alert('Harap masukkan ID Pasien.');
        return;
    }

    // Kirim permintaan AJAX ke server
    $.ajax({
        url: '/data/patient/search', // Ganti dengan URL endpoint untuk mencari pasien
        type: 'GET',
        data: { id: patientId },
        success: function (response) {
            if (response.success) {
                // Isi input nama dan jenis kelamin dengan data yang diterima
                $('#PatientName').val(response.data.name);
                $('#PatientGender').val(response.data.gender);
                $('#PatientID').val(patientId); // Set ID Pasien ke input hidden
            } else {
                alert('Pasien tidak ditemukan.');
            }
        },
        error: function () {
            alert('Terjadi kesalahan saat mencari pasien.');
        }
    });
});
</script>
