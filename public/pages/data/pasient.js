
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
