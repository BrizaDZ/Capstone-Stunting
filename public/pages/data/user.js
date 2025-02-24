
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
            url: "/data/user/table",
            type: "post",
            dataType: "json"
        },
        columns: [
            { data: "name", name: "name", autoWidth: true },
            { data: "email", name: "email", autoWidth: true },
            { data: "role_id", name: "role_id", autoWidth: true },

            {
                data: 'id',
                render: function (data, type, row) { return "<button type='button' class='btn btn-sm btn-primary mr-2 showMe' style='width:100%;' data-href='/data/user/edit/" + row.id + "'> Edit</button>" }
            }
        ],
        order: [[0, "desc"]]
    })
}

