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
            url: "/data/janji-temu/table",
            type: "post",
            dataType: "json"
        },
        columns: [
            { data: 'patient_name', name: 'appointment.patient_name' },
            { data: 'doctor_name', name: 'appointment.doctor_name' },
            { data: 'puskesmas_name', name: 'puskesmas_name' },
            { data: 'date', name: 'date' },

            {
                data: 'AppointmentID',
                render: function (data, type, row) { return "<button type='button' class='btn btn-sm btn-primary mr-2 showMe' style='width:100%;' data-href='/data/janji-temu/edit/" + row.AppointmentID + "'> Periksa</button>" }
            }
        ],
        order: [[0, "desc"]]
    })
}



