function bindForm(dialog) {
    $('form', dialog).submit(function () {
        $.ajax({
            url: this.action,
            type: this.method,
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    $('#myModal').modal('hide');
                    showSuccessMessage();
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

function showSuccessMessage() {
    swal({
        position: 'top-end',
        type: 'success',
        title: 'Data berhasil disimpan!',
        showConfirmButton: false,
        timer: 1000
    }).then(function () {
        loadContent();
    });
}

function showInvalidMessage() {
    $('.mod-warning').css("visibility", "visible");
}





$(document).on('click', '.showMe', function () {
    $('#myModalContent').load($(this).attr('data-href'), function () {

        $('#myModal').modal();

        bindForm(this);
    });




    return false;
});

function showExitsMessage() {
    swal({
        position: 'top-end',
        type: 'danger',
        title: 'Data Sudah Ada!',
        showConfirmButton: false,
        timer: 1000
    }).then(function () {
        loadContent();
    });
}

function PopulateBarang() {
    $('.sBarang').select2({
        placeholder: 'Pilih Barang...',
        dropdownParent: $("#myModal"),
        allowClear: true,
        ajax: {
            url: `/master/barang/search`,
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

function PopulateJenisBarang() {
    $('.sJenisBarang').select2({
        placeholder: 'Pilih Jenis Barang...',
        dropdownParent: $("#myModal"),
        allowClear: true,
        ajax: {
            url: `/master/jenisbarang/search`,
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
                            text: item.namajenisbarang,
                            id: item.jenisbarangID,
                        }
                    })
                }
            },
            cache: true
        }
    });
}
