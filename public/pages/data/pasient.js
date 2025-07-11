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
    PopulateRelationship();
    PopulateProvince();
    PopulateRegency();
    PopulateDistrict();
    PopulateVillage();
    $('#formPasien').off('submit').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: form.serialize(),
            error: function(xhr) {
                if(xhr.status === 422){
                    let msg = 'NIK sudah terdaftar, silahkan gunakan yang lain';
                    Swal.fire('Gagal', msg, 'error');
                }
            }
        });
    });
});

function PopulateRelationship() {
    $('.sRelationship').select2({
        placeholder: 'Pilih Hubungan...',
        allowClear: true,
        dropdownParent: $("#myModal"),
        ajax: {
            url: "/master/relationship/search/",
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
                            id: item.RelationshipID,
                            text: item.name,

                        };
                    })
                };
            },
            cache: true
        }
    })
}

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
            url: "/data/pasien/table",
            type: "post",
            dataType: "json"
        },
        columns: [
            { data: "PatientID", name: "PatientID", autoWidth: true },
            { data: "name", name: "name", autoWidth: true },
            { data: "age", name: "age", autoWidth: true },
            { data: "gender", name: "gender", autoWidth: true },
            { data: "kabupaten", name: "kabupaten", autoWidth: true },
            { data: "kecamatan", name: "kecamatan", autoWidth: true },
            { data: "kelurahan", name: "age", autoWidth: true },

            {
                data: 'PatientID',
                render: function (data, type, row) { return "<button type='button' class='btn btn-sm btn-primary mr-2 showMe' style='width:100%;' data-href='/data/pasien/edit/" + row.PatientID + "'> Edit</button>" }
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
