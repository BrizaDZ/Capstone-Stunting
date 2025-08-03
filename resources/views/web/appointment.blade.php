@extends('layouts.web.layout')
@section('title', 'Janji Temu')

@push('style')
<link rel="stylesheet" href="/lib/sweetalert/sweetalert2.min.css" />
    <link rel="stylesheet" href="/lib/select2/css/select2.min.css" />
    <script src="/lib/fullcalendar/packages/core/index.global.min.js"></script>
    <script src="/lib/fullcalendar/packages/core/locales/id.global.min.js"></script>
    <script src="/lib/fullcalendar/packages/daygrid/index.global.min.js"></script>
    <link rel="stylesheet" href="/css/progress-bar.css">
<style>
.py-5{
    padding-top: 5em !important;
    padding-bottom: 5em !important;
}

</style>
@endpush
@section('content')
<form action="/janji-temu/store" method="post" id="appointmentForm">
    @csrf
<section class="min-vh-100 align-content-center">
<div class="container py-5 my-5 align-content-center">
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
                <div class="step-label">Pilih Jadwal</div>
            </div>
            <div class="step-item" data-step="6">
                <div class="step-marker"></div>
                <div class="step-label">Submit</div>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-6 order-2 order-md-1">
                <div class="card bg-white shadow border-0">
                            <div class="card-header bg-primary border-0">
                                <h5 class="text-white text-center fw-bold fs-4">Janji Temu Stunting</h3>
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
            <div class="col-md-6 order-1 order-md-2">
                <div id="doctorScheduleCard" class="card border-0 shadow">
                    <div class="card-header bg-primary text-center fw-bold pt-3">
                    <h5 class="mb-3 text-white fw-bold">Jadwal Dokter di Puskesmas</h4>

                    </div>
                    <div class="card-body">
                    <div id="doctorCalendar"></div>

                    </div>
                </div>
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
                    <button type="submit" class="btn btn-primary w-100 mx-auto">Submit</button>

                </div>

            </div>
        </div>
    </div>
</section>

</form>

@endsection

@push('script')

<script src="/lib/sweetalert/sweetalert2.all.min.js"></script>
<script src="/lib/select2/js/select2.full.min.js"></script>

<script src="/pages/appointment.js"></script>
@endpush
