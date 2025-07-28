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
    border: 3px solid #4db5ff !important;
    box-shadow: 0 0 10px rgba(13, 110, 253, 0.5) !important;
    transition: 0.3s ease !important;
}

.progressbar {
    counter-reset: step;
    list-style: none;
    padding: 0;
    margin: 0;
}

.progressbar .step {
    position: relative;
    flex: 1;
    text-align: center;
    font-weight: 500;
    color: #ccc;
}

.progressbar .step::before {
    content: counter(step);
    counter-increment: step;
    width: 30px;
    height: 30px;
    border: 2px solid #ccc;
    display: block;
    text-align: center;
    margin: 0 auto 10px auto;
    border-radius: 50%;
    background-color: white;
    line-height: 26px;
}

.progressbar .step::after {
    content: '';
    position: absolute;
    width: 100%;
    height: 2px;
    background-color: #ccc;
    top: 15px;
    left: -50%;
    z-index: -1;
}

.progressbar .step:first-child::after {
    content: none;
}

.progressbar .step.active {
    color: #007bff;
}

.progressbar .step.active::before {
    border-color: #007bff;
    background-color: #007bff;
    color: white;
}

.progressbar .step.active + .step::after {
    background-color: #007bff;
}

.step-progress {
    display: flex;
    justify-content: space-between;
    position: relative;
    margin-bottom: 30px;
}

.step-item {
    text-align: center;
    flex: 1;
    position: relative;
    z-index: 1;
    transition: all 0.3s ease-in-out;
}

.step-item::before {
    content: '';
    position: absolute;
    top: 15px;
    left: -50%;
    height: 4px;
    width: 100%;
    background-color: #dee2e6;
    z-index: -1;
    transition: background-color 0.3s ease-in-out;
}

.step-item:first-child::before {
    content: none;
}

.step-marker {
    width: 30px;
    height: 30px;
    background-color: #dee2e6;
    border-radius: 50%;
    margin: 0 auto;
    position: relative;
    z-index: 2;
    transition: all 0.3s ease-in-out;
    border: 3px solid white;
    box-shadow: 0 0 0 3px #dee2e6;
}

.step-label {
    margin-top: 10px;
    font-size: 14px;
    color: #6c757d;
    font-weight: 500;
}

.step-item.active .step-marker {
    background-color: #4db5ff;
    box-shadow: 0 0 0 3px #4db5ff;
}

.step-item.active .step-label {
    color: #4db5ff;
    font-weight: 600;
}

.step-item.active::before {
    background-color: #4db5ff;
}

.step-item.completed .step-marker {
    background-color: #0f2750;
    box-shadow: 0 0 0 3px #0f2750;
}

.step-item.completed .step-label {
    color: #0f2750;
}


</style>
@endpush
@section('content')



<form action="/janji-temu/store" method="post" id="appointmentForm">
    @csrf
    <div class="container py-5">
        <div class="step-progress mb-5">
            <div class="step-item active" data-step="1">
                <div class="step-marker"></div>
                <div class="step-label">Pilih Pasien</div>
            </div>
            <div class="step-item" data-step="2">
                <div class="step-marker"></div>
                <div class="step-label">Pilih Puskesmas</div>
            </div>
            <div class="step-item" data-step="3">
                <div class="step-marker"></div>
                <div class="step-label">Pilih Tanggal</div>
            </div>
            <div class="step-item" data-step="4">
                <div class="step-marker"></div>
                <div class="step-label">Pilih Dokter</div>
            </div>
            <div class="step-item" data-step="5">
                <div class="step-marker"></div>
                <div class="step-label">Pilih Jadwal Dokter</div>
            </div>
            <div class="step-item" data-step="6">
                <div class="step-marker"></div>
                <div class="step-label">Submit</div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card bg-white shadow border-0">
                            <div class="card-header bg-primary border-0">
                                <h3 class="text-white text-center fw-bold fs-4">Janji Temu Stunting</h3>
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
            </div>
            <div class="col-md-6">
                <div id="doctorCalendar"></div>S
            </div>
        </div>

        <div id="doctorListCard" class="card border-0 shadow mt-4 d-none">
            <div class="card-header bg-primary border-0">
                <h2 class="fw-bold text-white text-center mb-0 fs-4">Dokter Tersedia</h2>
                <p class="text-center text-white mb-0">( Klik untuk pilih dokter )</p>
            </div>
            <div class="card-body p-5">
                <div id="doctorListContent" class="row g-3"></div>
                <div class="text-center mt-5">
                    <button type="submit" class="btn btn-primary w-25 mx-auto">Submit</button>

                </div>

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
