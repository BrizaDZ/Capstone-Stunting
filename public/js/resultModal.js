function bindForm(dialog) {
    $('form', dialog).submit(function () {
        $.ajax({
            url: this.action,
            type: this.method,
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    $('#myModal').modal('hide');
                    showResultModal(result.data); // Tambahkan logika untuk menampilkan resultModal
                } else if (result.invalid) {
                    showInvalidMessage();
                } else if (result.Exits) {
                    $('#myModal').modal('hide');
                    showExitsMessage();
                } else {
                    $('#myModalContent').html(result);
                    bindForm();
                    loadPlugin();
                }
            }
        });
        return false;
    });
}

$(document).on('click', '.showMe', function () {
    $('#myModalContent').load($(this).attr('data-href'), function () {

        $('#myModal').modal();

        bindForm(this);
    });




    return false;
});


function showResultModal(data) {
    // Isi konten modal dengan hasil
    let content = `
        <p><strong>Nama Pasien:</strong> ${data.name}</p>
        <p><strong>Jenis Kelamin:</strong> ${data.gender}</p>
        <p><strong>Berat Badan:</strong> ${data.weight} kg</p>
        <p><strong>Tinggi Badan:</strong> ${data.height} cm</p>
        <p><strong>Umur:</strong> ${data.age} tahun</p>
        <p><strong>Status Gizi:</strong> ${data.weightage}</p>
        <p><strong>Status Tinggi Badan:</strong> ${data.heightage}</p>
        <p><strong>Status BB/TB:</strong> ${data.weightheight}</p>
    `;
    $('#resultModalContent').html(content);

    $('#resultModal .btn-primary').attr('href', `/surat-rujukan/download/${data.StuntingID}`);

    // Tampilkan modal
    $('#resultModal').modal('show');
}
