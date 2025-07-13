
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    loadTable();
});
function loadContent() {
    loadTable();
}

$(document).on('shown.bs.modal', '#myModal', function () {
    var kota = $('.sKabupaten').val();
    PopulateProvince();
    PopulateRegency();
    PopulateDistrict();
    PopulateVillage();
    // PopulateKabupaten();
    // PopulateKecamatan(kota);
    // var kec = $('.sKecamatan option:selected').val();
    // PopulateKelurahan(kec);
});

function loadTable() {
    $('#tblData').DataTable().clear().destroy();
    $('#tblData').DataTable({
        processing: false,
        serverSide: true,
        lengthMenu: [5, 10, 25, 50],
        stateSave: true,
        filter: true,
        orderMulti: false,
        ajax: {
            url: "/data/puskesmas/table",
            type: "post",
            dataType: "json"
        },
        columns: [
            { data: "name", name: "name", autoWidth: true },
            { data: "email", name: "email", autoWidth: true },
            { data: "telp", name: "telp", autoWidth: true },

            {
                data:  null,
                render: function (data, type, row) { return "<button type='button' class='btn btn-sm btn-primary mr-2 showMe' style='width:100%;' data-href='/data/puskesmas/edit/" + row.id + "'> Edit</button>" }
            }
        ],
        order: [[0, "desc"]]
    })
}

function PopulateProvince() {
    $('.sProvince').select2({
        placeholder: 'Pilih Provinsi...',
        allowClear: true,
        dropdownParent: $("#myModal"),
        ajax: {
            url: "/api/provinces",
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
                            id: item.id,
                            text: item.name,
                        };
                    })
                };
            },
            cache: true
        }
    })
}

function PopulateRegency() {
$('.sRegency').select2({
    placeholder: 'Pilih Kabupaten...',
    allowClear: true,
    dropdownParent: $("#myModal"),
    ajax: {
        url: function () {
            return '/api/regencies/' + $('.sProvince').val();
        },
        dataType: 'json',
        processResults: function (result) {
            return {
                results: $.map(result, function (item) {
                    return {
                        id: item.id,
                        text: item.name,
                    };
                })
            };
        },
        cache: true
    }
}).on('change', function () {
        var kabName = $('.sRegency option:selected').text();

        $('#NamaKab').val(kabName);
    });
}

function PopulateDistrict() {
$('.sDistrict').select2({
    placeholder: 'Pilih Kecamatan...',
    allowClear: true,
    dropdownParent: $("#myModal"),
    ajax: {
        url: function () {
            return '/api/districts/' + $('.sRegency').val();
        },
        dataType: 'json',
        processResults: function (result) {
            return {
                results: $.map(result, function (item) {
                    return {
                        id: item.id,
                        text: item.name,
                    };
                })
            };
        },
        cache: true
    }
}).on('change', function () {
        var kecName = $('.sDistrict option:selected').text();

        $('#NamaKec').val(kecName);
    });
}

function PopulateVillage() {
$('.sVillage').select2({
    placeholder: 'Pilih Kelurahan...',
    allowClear: true,
    dropdownParent: $("#myModal"),
    ajax: {
        url: function () {
            return '/api/village/' + $('.sDistrict').val();
        },
        dataType: 'json',
        processResults: function (result) {
            return {
                results: $.map(result, function (item) {
                    return {
                        id: item.id,
                        text: item.name,
                    };
                })
            };
        },
        cache: true
    }
}).on('change', function () {
        var kelName = $('.sVillage option:selected').text();

        $('#NamaKel').val(kelName);
    });
}
