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
    PopulateDoctors();
    PopulateSchedule();
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
            url: "/master/doctoroperationaltime/table",
            type: "post",
            dataType: "json"
        },
        columns: [
            { data: "doctor_id", name: "doctor_id", autoWidth: true },
            { data: "operationaltime_id", name: "operationaltime_id", autoWidth: true },
            { data: "day", name: "day", autoWidth: true },

            {
                data: 'DoctorOperationalTimeID',
                render: function (data, type, row) { return "<button type='button' class='btn btn-sm btn-primary mr-2 showMe' style='width:100%;' data-href='/master/doctoroperationaltime/edit/" + row.DoctorOperationalTimeID + "'> Edit</button>" }
            }
        ],
        order: [[0, "desc"]]
    })
}


function PopulateDoctors() {
    $('.sDoctor').select2({
        placeholder: 'Pilih Dokter...',
        allowClear: true,
        dropdownParent: $("#myModal"),
        ajax: {
            url: "/master/doctor/search/",
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
                            id: item.DoctorID,
                            text: item.name,

                        };
                    })
                };
            },
            cache: true
        }
    })
}

function PopulateSchedule() {
    $('.sSchedule').select2({
        placeholder: 'Pilih Jadwal Dokter...',
        allowClear: true,
        dropdownParent: $("#myModal"),
        ajax: {
            url: "/master/operationaltime/search/",
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
                            id: item.OperationalTimeID,
                            text: item.name,

                        };
                    })
                };
            },
            cache: true
        }
    })
}


