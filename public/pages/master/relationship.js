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
                            <button type='button' class='btn btn-sm btn-primary showMe' style='width: 48%;' data-href='/master/relationship/edit/${row.RelationshipID}'><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen-icon lucide-square-pen"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/></svg></button>
                            <button type='button' class='btn btn-sm btn-danger btnDelete' style='width: 48%;' data-id='${row.RelationshipID}'><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-icon lucide-trash"><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg></button>
                        </div>
                    `;
                }
            }
        ],
        order: [[0, "desc"]]
    });
}

$(document).on('click', '.btnDelete', function () {
    const id = $(this).data('id');

    if (!id) {
        return;
    }

    Swal.fire({
        title: 'Yakin ingin menghapus data ini?',
        text: "Data yang dihapus tidak dapat dikembalikan!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, hapus!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: `/master/relationship/delete/${id}`,
                type: 'DELETE',
                success: function (res) {
                    if (res.success) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: res.message,
                            type: 'success'
                        });
                        loadTable();
                    } else {
                        Swal.fire({
                            title: 'Gagal!',
                            text: res.message || 'Gagal menghapus.',
                            type: 'error'
                        });
                    }
                },
                error: function () {
                    Swal.fire({
                        title: 'Gagal!',
                        text: 'Terjadi kesalahan saat menghapus data.',
                        type: 'error'
                    });
                }
            });
        }
    });
});
