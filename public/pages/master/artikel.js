
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        loadTable();

        $(document).on("shown.bs.modal", function () {
            document.getElementById('customEditor').innerHTML = '';

            document.querySelectorAll('.toggle-btn').forEach(button => {
                button.addEventListener('click', function () {
                    execCmd(this.dataset.command);
                });
            });

            document.getElementById('customEditor').addEventListener('keyup', updateButtonStates);
            document.getElementById('customEditor').addEventListener('mouseup', updateButtonStates);

            $("#btn-photo").off("click").on("click", function () {
                var editorContent = $("#customEditor").html().trim();
                if (editorContent === '' || editorContent === '<br>') {
                    alert("Deskripsi tidak boleh kosong!");
                    return;
                }

                $("#description").val(editorContent);

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
                            loadTable();
                        } else if (result.invalid) {
                            showInvalidMessage();
                        } else {
                            printErrorMsg(result.error);
                        }
                    },
                });
            });
        });
    });

    function execCmd(command) {
        document.execCommand(command, false, null);
        updateButtonStates();
    }

    function updateButtonStates() {
        document.querySelectorAll('.toggle-btn').forEach(button => {
            const command = button.dataset.command;
            try {
                const isActive = document.queryCommandState(command);
                if (isActive) {
                    button.classList.add('btn-primary');
                    button.classList.remove('btn-outline-primary');
                } else {
                    button.classList.remove('btn-primary');
                    button.classList.add('btn-outline-primary');
                }
            } catch (e) {
            }
        });
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
                url: "/data/artikel/table",
                type: "post",
                dataType: "json"
            },
            columns: [
                { data: "title", name: "title", autoWidth: true },
                { data: "date", name: "date", autoWidth: true },
                {
                    data: 'ArticleID',
                    render: function (data, type, row) {
                        return "<button type='button' class='btn btn-sm btn-primary mr-2 showMe' style='width:100%;' data-href='/data/article/edit/" + row.ArticleID + "'> Edit</button>";
                    },
                }
            ],
            order: [[0, "desc"]]
        });
    }
