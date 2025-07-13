let currentDoctorId = null;

$(document).ready(function () {
    $.ajax({
        url: '/janji-temu',
        type: 'GET',
        dataType: 'json',
        success: function (response) {
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
    fetchAvailableDoctors();

    $('#appointment_date').on('change', function () {
        currentDoctorId = null;
        fetchAvailableDoctors();
    });

    $('.sPuskesmas').on('change', function () {
        currentDoctorId = null;
        fetchAvailableDoctors();
    });
});

function PopulatePatient() {
    $('.sPatient').select2({
        placeholder: 'Pilih Pasien...',
        allowClear: true,
        ajax: {
            url: "/profile/search/",
            data: function (params) {
                return { term: params.term };
            },
            processResults: function (result) {
                return {
                    results: $.map(result, function (item) {
                        return {
                            id: item.PatientID,
                            text: item.name
                        };
                    })
                };
            },
            cache: true
        }
    }).on('change', function () {
        var patientName = $('.sPatient option:selected').text();
        $('#txtnamapatient').val(patientName);
    });
}

function PopulatePuskesmas() {
    $('.sPuskesmas').select2({
        placeholder: 'Pilih Puskesmas...',
        allowClear: true,
        ajax: {
            url: "/master/puskesmas/search/",
            data: function (params) {
                return { term: params.term };
            },
            processResults: function (result) {
                return {
                    results: $.map(result, function (item) {
                        return {
                            id: item.PuskesmasID,
                            text: item.nama
                        };
                    })
                };
            },
            cache: true
        }
    });
}

function fetchAvailableDoctors() {
    const puskesmasId = $('.sPuskesmas').val();
    const date = $('#appointment_date').val();

    if (!puskesmasId || !date) {
        $('#doctorListCard').addClass('d-none');
        return;
    }

    $.ajax({
        url: '/master/doctoroperationaltime/search',
        type: 'GET',
        data: {
            puskesmas_id: puskesmasId,
            appointment_date: date
        },
        success: function (response) {
            const container = $('#doctorListContent');
            container.empty();

            if (response.length > 0) {
                response.forEach(item => {
                    const card = `
                        <div class="col-md-3">
                            <div class="card h-100 shadow doctor-card" style="cursor: pointer;"
                                data-doctor-id="${item.DoctorID}"
                                data-doctor-name="${item.doctor_name}">
                                <img src="/images/doctor/${item.photo}" class="card-img-top object-fit-cover" height="300" alt="${item.doctor_name}">
                                <div class="card-body p-4">
                                    <h5 class="card-title mb-1 text-primary fw-bold">${item.doctor_name}</h5>
                                    <p class="card-text mb-0">${item.puskesmas_name}</p>
                                </div>
                                <div class="card-footer bg-white">
                                    <small class="text-muted">Pilih Jam: </small>
                                    <div class="sSchedule w-100 text-center">
                                        <button class="btn btn-sm btn-primary w-100">Klik untuk pilih</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    container.append(card);
                });

                $('#doctorListCard').removeClass('d-none');
            } else {
                $('#doctorListCard').addClass('d-none');
            }
        },
        error: function () {
            $('#doctorListCard').addClass('d-none');
        }
    });
}

$(document).on('click', '.doctor-card', function () {
    const doctorId = $(this).data('doctor-id');
    const doctorName = $(this).data('doctor-name');

    if (currentDoctorId === doctorId) return;
    currentDoctorId = doctorId;

    $('.doctor-card').removeClass('selected-doctor');
    $(this).addClass('selected-doctor');

    $('#txtnamadoctor').val(doctorName);
    $('#inputDoctorID').val(doctorId);

    $('html, body').animate({
        scrollTop: $('#appointmentForm').offset().top + 500
    }, 500);

    const $container = $(this).find('.sSchedule');
    $container.html(`<span class="text-muted small">Memuat...</span>`);

    const appointmentDate = $('#appointment_date').val();
    if (!appointmentDate) {
        $container.html(`<span class="text-danger">Pilih tanggal terlebih dahulu</span>`);
        return;
    }

    $.ajax({
        url: "/master/doctoroperationaltime/search/",
        type: "GET",
        data: {
            DoctorID: doctorId,
            appointment_date: appointmentDate
        },
        success: function (result) {
            if (result.length > 0) {
                const selectedShiftId = $('#inputDoctorOperationalTimeID').val();
                let buttons = '';
                result.forEach(item => {
                    const isActive = item.DoctorOperationalTimeID == selectedShiftId ? 'active' : '';
                    buttons += `
                        <button type="button" class="btn btn-outline-primary btn-sm mb-1 w-100 btn-shift ${isActive}"
                            data-id="${item.DoctorOperationalTimeID}"
                            data-text="${item.shift_name}">
                            ${item.shift_name}
                        </button>
                    `;
                });

                $container.html(buttons);
            } else {
                $container.html('<span class="text-danger">Tidak ada jadwal</span>');
            }
        },
        error: function () {
            $container.html('<span class="text-danger">Gagal ambil jadwal</span>');
        }
    });
});

$(document).on('click', '.btn-shift', function () {
    $('.btn-shift').removeClass('active');
    $(this).addClass('active');

    const shiftId = $(this).data('id');

    $('#inputDoctorOperationalTimeID').val(shiftId);
});

document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("appointmentForm");

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const doctorId = document.getElementById('inputDoctorID').value;
        const shiftId = document.getElementById('inputDoctorOperationalTimeID').value;

        if (!doctorId) {
            Swal.fire({
                icon: 'warning',
                title: 'Pilih Dokter',
                text: 'Silakan pilih dokter terlebih dahulu dengan mengklik salah satu kartu dokter.',
            });
            return;
        }

        if (!shiftId) {
            Swal.fire({
                icon: 'warning',
                title: 'Pilih Jam Praktik',
                text: 'Silakan pilih jam praktik dari dokter yang telah dipilih.',
            });
            return;
        }

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
                }).then(() => {
                    window.location.reload();
                });

                form.reset();
            } else {
                Swal.fire({
                    icon: 'error',
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
                icon: 'error',
                title: 'Error',
                text: 'Terjadi kesalahan pada server.',
            });
        });
    });

});
