
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
                    data: null,
                    render: function (data, type, row) {
                        return `
                        <div class="d-flex justify-content-between gap-1">
                            <a type='button' class='btn btn-sm btn-primary' style='width: 48%;' href='/data/stunting/detail/${row.PatientID}'><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-icon lucide-eye"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg></a>
                            <button type='button' class='btn btn-sm btn-danger btnDelete' style='width: 48%;' data-id='${row.StuntingID}'><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-icon lucide-trash"><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg></button>
                        </div>
                    `;;
                    },
                }
        ],
        order: [[0, "desc"]]
    })
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
                url: `/data/stunting/delete/${id}`,
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
