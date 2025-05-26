
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
            url: "/data/puskesmas/table",
            type: "post",
            dataType: "json"
        },
        columns: [
            { data: "nama", name: "nama", autoWidth: true },
            { data: "alamat", name: "alamat", autoWidth: true },
            { data: "Kabupaten", name: "Kabupaten", autoWidth: true },
            { data: "Kecamatan", name: "Kecamatan", autoWidth: true },
            { data: "Kelurahan", name: "Kelurahan", autoWidth: true },
            { data: "longitude", name: "longitude", autoWidth: true },
            { data: "latitude", name: "latitude", autoWidth: true },

            {
                data: 'PuskesmasID',
                render: function (data, type, row) { return "<button type='button' class='btn btn-sm btn-primary mr-2 showMe' style='width:100%;' data-href='/data/puskesmas/edit/" + row.PuskesmasID + "'> Edit</button>" }
            }
        ],
        order: [[0, "desc"]]
    })
}

