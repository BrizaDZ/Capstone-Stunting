$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    PopulatePatient();
    PopulatePuskesmas();
    PopulateDoctor();
    PopulateSchedule();
});
function loadContent() {
}

$(document).on('shown.bs.modal', '#myModal', function () {
    PopulatePatient();
    PopulatePuskesmas()
});


function PopulatePatient() {
    $('.sPatient').select2({
        placeholder: 'Pilih Pasien...',
        allowClear: true,
        ajax: {
            url: "/profile/search/",
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
                            id: item.PatientID,
                            text: item.name,

                        };
                    })
                };
            },
            cache: true
        }
    }).on('change', function () {
        var patientName = $('.sPatient option:selected').text();
        console.log(patientName);
        $('#txtnamapatient').val(patientName);
    });
}

function PopulatePuskesmas() {
    $('.sPuskesmas').select2({
        placeholder: 'Pilih Puskesmas...',
        allowClear: true,
        ajax: {
            url: "/master/puskesmas/search/",
            contentType: "application/json; charset=utf-8",
            data: function (params) {
                return {
                    term: params.term
                };
            },
            processResults: function (result) {
                return {
                    results: $.map(result, function (item) {
                        return {
                            id: item.PuskesmasID,
                            text: item.nama,
                            user_id: item.user_id // <- tambahkan user_id di result
                        };
                    })
                };
            },
            cache: true
        }
    }).on('select2:select', function (e) {
        var selectedData = e.params.data;
        var userId = selectedData.user_id;

        // Reset dokter dulu
        $('.sDoctor').val(null).trigger('change');
        $('.sDoctor').select2('destroy');

        // Populate dokter berdasarkan user_id
        PopulateDoctor(userId);
    });
}


function PopulateDoctor(userId) {
    $('.sDoctor').select2({
        placeholder: 'Pilih Dokter...',
        allowClear: true,
        ajax: {
            url: "/master/doctor/search/",
            contentType: "application/json; charset=utf-8",
            data: function (params) {
                return {
                    term: params.term,
                    user_id: userId
                };
            },
            processResults: function (result) {
                return {
                    results: $.map(result, function (item) {
                        return {
                            id: item.DoctorID,
                            text: item.name
                        };
                    })
                };
            },
            cache: true
        }
    }).on('select2:select', function (e) {
        var doctorId = e.params.data.DoctorID;

        // Reset schedule dropdown
        $('.sSchedule').val(null).trigger('change');
        $('.sSchedule').select2('destroy');

        // Populate jadwal dokter berdasarkan DoctorID
        PopulateSchedule(doctorId);
    }).on('change', function () {
        var doctorName = $('.sDoctor option:selected').text();
        console.log(doctorName);
        $('#txtnamadoctor').val(doctorName);
    });
}

function PopulateSchedule(doctorId) {
    $('.sSchedule').select2({
        placeholder: 'Pilih Jadwal...',
        allowClear: true,
        ajax: {
            url: "/master/doctoroperationaltime/search/",
            contentType: "application/json; charset=utf-8",
            data: function (params) {
                return {
                    term: params.term,
                    DoctorID: doctorId // kirim DoctorID ke backend
                };
            },
            processResults: function (result) {
                return {
                    results: $.map(result, function (item) {
                        return {
                            id: item.DoctorOperationalTimeID,
                            text: item.day // misalnya: "Senin, 08:00 - 12:00"
                        };
                    })
                };
            },
            cache: true
        }
    });
}

