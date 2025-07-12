$(document).ready(function () {
    $.ajax({
        url: '/janji-temu',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.success === false) {
                Swal.fire({
                    type: 'warning',
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
        var userId = selectedData.puskesmasid;

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
        var doctorId = e.params.data.id;

        $('.sSchedule').val(null).trigger('change');
        $('.sSchedule').select2('destroy');

        PopulateSchedule(doctorId);
        $('#doctorScheduleTitle').text('Jadwal Dokter: ' + e.params.data.text);
        renderDoctorCalendar(doctorId);
    }).on('change', function () {
        var doctorName = $('.sDoctor option:selected').text();
        console.log(doctorName);
        $('#txtnamadoctor').val(doctorName);
    });
}
function renderDoctorCalendar(doctorId) {
    $('#doctorScheduleCard').removeClass('d-none');

    $('#doctorCalendar').html('');

    fetch(`/master/doctoroperationaltime/search?DoctorID=${doctorId}`)
        .then(response => response.json())
        .then(data => {
            const calendarEl = document.getElementById('doctorCalendar');

            const events = data.map(item => ({
                title: item.name,
                start: item.date,
                allDay: true
            }));

            const calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'id',
                initialView: 'dayGridMonth',
                height: 500,
                events: events
            });

            calendar.render();
        });
}

$('#appointment_date').on('change', function () {
    const doctorId = $('.sDoctor').val();
    if (doctorId) {
        $('.sSchedule').val(null).trigger('change');
        $('.sSchedule').select2('destroy');
        PopulateSchedule(doctorId);
    }
});
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
                    DoctorID: doctorId,
                    appointment_date: $('#appointment_date').val()
                };
            },
            processResults: function (result) {
                return {
                    results: $.map(result, function (item) {
                        return {
                            id: item.DoctorOperationalTimeID,
                            text: item.date
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
                    type: 'success',
                    title: 'Janji Temu Berhasil!',
                    html: `
                        Nomor Antrian Anda: <strong>${data.queue_number}</strong><br><br>
                        <a href="/appointment/print/${data.appointment_id}" target="_blank" class="btn btn-success mt-3 btn-lg">
                            Download Kartu Antrean
                        </a>
                    `,
                    showConfirmButton: true,
                    confirmButtonText: 'Tutup'
                }).then(() => {
                    window.location.reload();
                });

                form.reset();
            } else {
                Swal.fire({
                    type: 'error',
                    title: 'Gagal!',
                    text: data.message || 'Terjadi kesalahan saat menyimpan data.',
                }).then(() => {
                    window.location.reload();
                });
            }
        })
        .catch(error => {
            console.error(error);
            Swal.fire({
                type: 'error',
                title: 'Error',
                text: 'Terjadi kesalahan pada server.',
            });
        });
    });
});

