function bindForm(dialog) {
    $('form', dialog).submit(function (e) {
        e.preventDefault();

        $.ajax({
            url: this.action,
            type: this.method,
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    $('#myModal').modal('hide');
                    showResultModal(result.data);
                }
                else if (result.invalid) {
                    showInvalidMessage();
                }
                else if (result.exits) {
                    $('#myModal').modal('hide');
                    showExitsMessage();
                }else {
                    $('#myModalContent').html(result);
                    bindForm();
                }
            },
            error: function(xhr) {
            if(xhr.status === 422){
                let msg = 'NIK sudah terdaftar, silahkan gunakan yang lain';
                Swal.fire('Gagal', msg, 'error');
            }}
        });
        return false;
    });
}

function showSuccessMessage() {
    Swal.fire(
        {
            position: 'top-end',
            type: 'success',
            title: 'Data berhasil disimpan!',
            showConfirmButton: false,
            timer: 1000
        }).then(function () {
            loadContent();
        });
}

function showExitsMessage() {
    Swal.fire(
        {
            type: 'warning',
            title: 'Data Bulan Ini sudah Ada!!',
            showConfirmButton: false,
            timer: 1000
        }).then(function () {
            loadContent();
        });
}

function showInvalidMessage() {
    $('.mod-warning').css("visibility", "visible");
}

$(document).on('shown.bs.modal', function () {
    $(this).find('[autofocus]').focus();
});

$(document).on('click', '.showMe', function () {
    $('#myModalContent').load($(this).attr('data-href'), function () {

        $('#myModal').modal('show');

        bindForm(this);
    });

    return false;
});

function showResultModal(data) {
    let content = `
        <p><strong>Nama Pasien:</strong> ${data.name}</p>
        <p><strong>Jenis Kelamin:</strong> ${data.gender}</p>
        <p><strong>Berat Badan:</strong> ${data.weight} kg</p>
        <p><strong>Tinggi Badan:</strong> ${data.height} cm</p>
        <p><strong>Umur:</strong> ${data.age} bulan</p>
        <p><strong>Status Gizi:</strong> ${data.weightage}</p>
        <p><strong>Status Tinggi Badan:</strong> ${data.heightage}</p>
        <p><strong>Status BB/TB:</strong> ${data.weightheight}</p>
    `;
    $('#resultModalContent').html(content);

    $('#resultModal .btn-primary').attr('href', `/surat-rujukan/download/${data.StuntingID}`);

    var modal = new bootstrap.Modal(document.getElementById('resultModal'));
    modal.show();
}
