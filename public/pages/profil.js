$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    loadTable();
    loadTableAppointment();
    loadTableResult()
});
function loadContent() {
    loadTable();
    loadTableAppointment()
    loadTableResult()
}

$(document).on('shown.bs.modal', '#myModal', function () {
    PopulateRelationship();
    PopulateProvince();
    PopulateRegency();
    PopulateDistrict();
    PopulateVillage();
});

function showForm(formId, listItem) {
    document.querySelectorAll('.form-container').forEach(form => {
        form.style.display = 'none';
    });
    document.getElementById(formId).style.display = 'block';
    document.querySelectorAll('.list-group-item').forEach(item => {
        item.classList.remove('active');
    });
    listItem.classList.add('active');


}

document.addEventListener("DOMContentLoaded", function () {
    var modalTambahAnak = document.getElementById("modalTambahAnak");
    if (modalTambahAnak) {
        modalTambahAnak.addEventListener("shown.bs.modal", function () {
            console.log("Modal Tambah Anak terbuka!");
        });
    }
});



document.addEventListener("DOMContentLoaded", function () {
    const urlParams = new URLSearchParams(window.location.search);
    const activeTab = urlParams.get("tab");
    if (activeTab) {
        document.querySelectorAll(".nav-link").forEach(tab => {
            tab.classList.remove("active");
        });
        document.querySelectorAll(".tab-pane").forEach(tabPane => {
            tabPane.classList.remove("show", "active");
        });
        const selectedTab = document.getElementById(activeTab + "-tab");
        if (selectedTab) {
            selectedTab.classList.add("active");
            document.getElementById(activeTab).classList.add("show", "active");
        }
    }
});

function showTab(event, tabId) {
event.preventDefault();
document.querySelectorAll('.tab-pane').forEach(tab => {
    tab.classList.remove('show', 'active');
});
document.getElementById(tabId).classList.add('show', 'active');

document.querySelectorAll('.nav-link').forEach(link => {
    link.classList.remove('active');
});
document.getElementById(tabId + '-tab').classList.add('active');
}

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

function PopulateProvince() {
    $('.sProvince').select2({
        placeholder: 'Pilih Provinsi...',
        allowClear: true,
        dropdownParent: $("#myModal"),
        ajax: {
            url: "/api/provinces",
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
                            id: item.id,
                            text: item.name,
                        };
                    })
                };
            },
            cache: true
        }
    })
}

function PopulateRegency() {
$('.sRegency').select2({
    placeholder: 'Pilih Kabupaten...',
    allowClear: true,
    dropdownParent: $("#myModal"),
    ajax: {
        url: function () {
            return '/api/regencies/' + $('.sProvince').val();
        },
        dataType: 'json',
        processResults: function (result) {
            return {
                results: $.map(result, function (item) {
                    return {
                        id: item.id,
                        text: item.name,
                    };
                })
            };
        },
        cache: true
    }
}).on('change', function () {
        var kabName = $('.sRegency option:selected').text();

        $('#NamaKab').val(kabName);
    });
}

function PopulateDistrict() {
$('.sDistrict').select2({
    placeholder: 'Pilih Kecamatan...',
    allowClear: true,
    dropdownParent: $("#myModal"),
    ajax: {
        url: function () {
            return '/api/districts/' + $('.sRegency').val();
        },
        dataType: 'json',
        processResults: function (result) {
            return {
                results: $.map(result, function (item) {
                    return {
                        id: item.id,
                        text: item.name,
                    };
                })
            };
        },
        cache: true
    }
}).on('change', function () {
        var kecName = $('.sDistrict option:selected').text();

        $('#NamaKec').val(kecName);
    });
}

function PopulateVillage() {
$('.sVillage').select2({
    placeholder: 'Pilih Kelurahan...',
    allowClear: true,
    dropdownParent: $("#myModal"),
    ajax: {
        url: function () {
            return '/api/village/' + $('.sDistrict').val();
        },
        dataType: 'json',
        processResults: function (result) {
            return {
                results: $.map(result, function (item) {
                    return {
                        id: item.id,
                        text: item.name,
                    };
                })
            };
        },
        cache: true
    }
}).on('change', function () {
        var kelName = $('.sVillage option:selected').text();

        $('#NamaKel').val(kelName);
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
            url: "/profile/patient/table",
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
                render: function (data, type, row) { return "<button type='button' class='btn btn-sm btn-primary mr-2 showMe' style='width:100%;' data-href='/profile/patient/edit/" + row.PatientID + "'> Edit</button>" }
            }
        ],
        order: [[0, "desc"]]
    })
}

function loadTableAppointment() {
    $('#tblSchedule').DataTable().clear().destroy();
    $('#tblSchedule').DataTable({
        processing: false,
        serverSide: true,
        lengthMenu: [5, 10, 25, 50],
        stateSave: true,
        responsive: true,
        filter: true,
        orderMulti: false,
        ajax: {
            url: "/janji-temu/table",
            type: "post",
            dataType: "json"
        },
        columns: [
            { data: 'patient_name', name: 'appointment.patient_name' },
            { data: 'puskesmas_name', name: 'puskesmas_name' },
            { data: 'doctor_name', name: 'appointment.doctor_name' },

            { data: 'date', name: 'date' },
            { data: 'status', name: 'appointment.status' },


            {
                data: 'AppointmentID',
                render: function (data, type, row) { return "<a class='btn btn-sm btn-primary mr-2' style='width:100%;' href='/appointment/print/" + row.AppointmentID + "'> Download</button>" }
                // render: function (data, type, row) { return "<button type='button' class='btn btn-sm btn-primary mr-2 showMe' style='width:100%;' data-href='/profile/patient/edit/" + row.PatientID + "'> Edit</button>" }
            }
        ],
        order: [[0, "desc"]]
    })
}

function loadTableResult() {
    $('#tblResult').DataTable().clear().destroy();
    $('#tblResult').DataTable({
        processing: false,
        serverSide: true,
        lengthMenu: [5, 10, 25, 50],
        stateSave: true,
        filter: true,
        orderMulti: false,
        ajax: {
            url: "/profile/patient/table-result",
            type: "post",
            dataType: "json"
        },
        columns: [
            { data: 'name', name: 'name' },
            { data: "age", name: "age", autoWidth: true },
            { data: "gender", name: "gender", autoWidth: true },
            { data: "weight", name: "weight", autoWidth: true },
            { data: "height", name: "height", autoWidth: true },
            { data: "zscoreweightage", name: "zscoreweightage", autoWidth: true },
            { data: "zscoreheightage", name: "zscoreheightage", autoWidth: true },
            { data: "zscoreweightheight", name: "zscoreweightheight", autoWidth: true },
            { data: "status", name: "status", autoWidth: true }
        ],
        order: [[0, "desc"]]
    })
}
