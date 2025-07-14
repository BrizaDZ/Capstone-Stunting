@extends('layouts.web.layout')
@section('title', 'Janji Temu')

@push('style')
<link rel="stylesheet" href="/lib/sweetalert/sweetalert2.min.css" />
    <link rel="stylesheet" href="/lib/select2/css/select2.min.css" />
    <script src="/lib/fullcalendar/packages/core/index.global.min.js"></script>
    <script src="/lib/fullcalendar/packages/core/locales/id.global.min.js"></script>
    <script src="/lib/fullcalendar/packages/daygrid/index.global.min.js"></script>
<style>
    .doctor-card.selected-doctor {
    border: 3px solid #4db5ff;
    box-shadow: 0 0 10px rgba(13, 110, 253, 0.5);
    transition: 0.3s ease;
}

</style>
@endpush
@section('content')
<form action="/janji-temu/store" method="post" id="appointmentForm">
    @csrf
    <div class="container py-5">
        <div class="card bg-white shadow border-0">
            <div class="card-header bg-primary p-3">
                <h3 class="text-white text-center fw-bold">Janji Temu Stunting</h3>
            </div>
            <div class="card-body p-5">

                    <input type="hidden" name="doctor_name" id="txtnamadoctor">
                    <input type="hidden" name="patient_name" id="txtnamapatient">
                    <input type="hidden" name="DoctorID" id="inputDoctorID">
                    <input type="hidden" name="DoctorOperationalTimeID"  id="inputDoctorOperationalTimeID">

                    <div class="row mb-3">
                        <div class="col-lg-2">
                            <label class="form-label fw-bold">Nama Pasien</label>
                        </div>
                        <div class="col-lg-10">
                            <select class="form-control select2 sPatient w-100" name="PatientID" required>
                                @if ($data->PatientID != null)
                                    <option value="{{ $data->PatientID }}" selected="selected">{{ $data->name }}
                                    </option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-2">
                            <label class="form-label fw-bold">Puskesmas</label>
                        </div>
                        <div class="col-lg-10">
                            <select class="form-control select2 sPuskesmas" name="PuskesmasID" required>
                                @if ($data->PuskesmasID != null)
                                    <option value="{{ $data->user_id }}" selected="selected">{{ $data->nama }}
                                    </option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-2">
                            <label class="form-label fw-bold">Tanggal</label>
                        </div>
                        <div class="col-lg-10">
                            <input type="date" name="appointment_date" class="form-control" required id="appointment_date" required>
                        </div>
                    </div>
            </div>
        </div>
        <div id="doctorListCard" class="card border-0 shadow mt-4 d-none">
            <div class="card-header bg-primary py-3">
                <h2 class="fw-bold text-white text-center mb-0">Dokter Tersedia</h2>
                <p class="text-center text-white mb-0">( Klik untuk pilih dokter )</p>
            </div>
            <div class="card-body p-5">
                <div id="doctorListContent" class="row g-3"></div>
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary w-75 mx-auto">Submit</button>

                </div>

            </div>
        </div>

        <div id="doctorScheduleCard" class="card mt-4 d-none">
            <div class="card-body p-5">
                <h5 id="doctorScheduleTitle" class="fw-bold mb-3 text-center">Jadwal Dokter:</h5>
                <div id="doctorCalendar"></div>
            </div>
        </div>

    </div>
</form>

@endsection

@push('script')

<script src="/lib/sweetalert/sweetalert2.all.min.js"></script>
<script src="/lib/select2/js/select2.full.min.js"></script>

<script src="/pages/appointment.js"></script>
@endpush
