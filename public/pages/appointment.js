$(document).ready(function () {
    $.ajax({
        url: '/janji-temu',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.success === false) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Data Pasien Belum Lengkap',
                    text: 'Harap isi data pasien terlebih dahulu di menu profil sebelum membuat janji temu.',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = '/profile/patient';
                });
            }
        }
    });

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
                            id: item.LokasiPuskesmasID,
                            text: item.nama,
                            puskesmasid: item.PuskesmasID
                        };
                    })
                };
            },
            cache: true
        }
    }).on('select2:select', function (e) {
        var selectedData = e.params.data;
        var userId = selectedData.user_id;

        $('.sDoctor').val(null).trigger('change');
        $('.sDoctor').select2('destroy');

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

        $('.sSchedule').val(null).trigger('change');
        $('.sSchedule').select2('destroy');

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

document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("appointmentForm");

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const formData = new FormData(form);

        fetch(form.action, {
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Janji Temu Berhasil!',
                    html: `
                        Nomor Antrian Anda: <strong>${data.queue_number}</strong><br><br>
                        <a href="/appointment/print/${data.appointment_id}" target="_blank" class="btn btn-success mt-3 btn-lg">
                            Download Kartu Antrean
                        </a>
                    `,
                    showConfirmButton: true,
                    confirmButtonText: 'Tutup'
                });

                form.reset();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: data.message || 'Terjadi kesalahan saat menyimpan data.',
                });
            }
        })
        .catch(error => {
            console.error(error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Terjadi kesalahan pada server.',
            });
        });
    });
});

