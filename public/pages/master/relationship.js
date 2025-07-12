

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
    // var kota = $('.sKabupaten').val();
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
            url: "/master/relationship/table",
            type: "post",
            dataType: "json"
        },
        columns: [
            { data: "RelationshipID", name: "RelationshipID", autoWidth: true },
            { data: "name", name: "name", autoWidth: true },

            {
                data: 'RelationshipID',
                render: function (data, type, row) {
                    return `
                        <div class="d-flex justify-content-between gap-1">
                            <button type='button' class='btn btn-sm btn-primary showMe' style='width: 48%;' data-href='/master/relationship/edit/${row.RelationshipID}'>Edit</button>
                            <button type='button' class='btn btn-sm btn-danger btnDelete' style='width: 48%;' data-id='${row.RelationshipID}'>Delete</button>
                        </div>
                    `;
                }
            }
        ],
        order: [[0, "desc"]]
    })
}

$(document).on('click', '.btnDelete', function () {
    let id = $(this).data('id');

    Swal.fire({
        title: 'Yakin ingin menghapus data ini?',
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, hapus!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `/master/relationship/delete/${id}`,
                type: 'POST',
                success: function (res) {
                    if (res.success) {
                        Swal.fire('Berhasil!', res.message, 'success');
                        loadTable(); // reload table
                    } else {
                        Swal.fire('Gagal!', res.message, 'error');
                    }
                },
                error: function () {
                    Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus data.', 'error');
                }
            });
        }
    });
});