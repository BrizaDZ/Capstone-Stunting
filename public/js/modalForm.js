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
                    showSuccessMessage();
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


function PopulateDoctor() {
    $('.sDoctor').select2({
        placeholder: 'Pilih Dokter...',
        dropdownParent: $("#myModal"),
        allowClear: true,
        ajax: {
            url: `/master/doctor/search`,
            contentType: "application/json; charset=utf-8",
            data: function (params) {
                var query = {
                    term: params.term,
                };
                return query;
            },
            processResults: function (result) {
                return {
                    results: $.map(result, function (item) {
                        return {
                            text: item.nama,
                            id: item.BarangID,
                        }
                    })
                }
            },
            cache: true
        }
    });
}
