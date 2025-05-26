

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

$(document).on("shown.bs.modal", function () {
    $(document).ready(function () {
        $("#btn-photo").click(function () {
            var postData = new FormData($("#formartikel")[0]);
            $.ajax({
                type: "POST",
                url: "/data/artikel/store",
                processData: false,
                contentType: false,
                data: postData,
                success: function (result) {
                    if (result.success) {
                        $("#myModal").modal("hide");
                        showSuccessMessage();
                    } else if (result.invalid) {
                        showInvalidMessage();
                    }else {
                        printErrorMsg(result.error);
                    }
                },
            });
        });
    });
});

function loadTable() {
    $('#tblData').DataTable().clear().destroy();
    $('#tblData').DataTable({
        processing: false,
        // serverSide: true,
        // lengthMenu: [5, 10, 25, 50],
        // stateSave: true,
        // filter: true,
        // orderMulti: false,
        // ajax: {
        //     url: "/master/artikel/table",
        //     type: "post",
        //     dataType: "json"
        // },
        // columns: [
        //     { data: "RelationshipID", name: "RelationshipID", autoWidth: true },
        //     { data: "name", name: "name", autoWidth: true },

        //     {
        //         data: 'RelationshipID',
        //         render: function (data, type, row) { return "<button type='button' class='btn btn-sm btn-primary mr-2 showMe' style='width:100%;' data-href='/master/relationship/edit/" + row.RelationshipID + "'> Edit</button>" }
        //     }
        // ],
        // order: [[0, "desc"]]
    })
}

