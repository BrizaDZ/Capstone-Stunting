
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
            url: "/data/stunting/table",
            type: "post",
            dataType: "json"
        },
        columns: [
            { data: "created_date", name: "created_date", autoWidth: true },
            { data: "name", name: "name", autoWidth: true },
            { data: "age", name: "age", autoWidth: true },
            { data: "gender", name: "gender", autoWidth: true },
            { data: "weight", name: "weight", autoWidth: true },
            { data: "height", name: "height", autoWidth: true },
            { data: "measuretype", name: "meassuretype", autoWidth: true },
            { data: "zscoreweightage", name: "zscoreweightage", autoWidth: true },
            { data: "zscoreheightage", name: "zscoreheightage", autoWidth: true },
            { data: "zscoreweightheight", name: "zscoreweightheight", autoWidth: true },
            { data: "weightage", name: "weightage", autoWidth: true },
            { data: "heightage", name: "heightage", autoWidth: true },
            { data: "weightheight", name: "weightheight", autoWidth: true },
            { data: "status", name: "status", autoWidth: true },
            {
                data: 'PatientID',
                render: function (data, type, row) { return "<a class='btn btn-sm btn-primary mr-2' target='_blank' style='width:100%;' href='/data/stunting/detail/" + row.PatientID + "'>Detail</a>" }
            }
        ],
        order: [[0, "desc"]]
    })
}

