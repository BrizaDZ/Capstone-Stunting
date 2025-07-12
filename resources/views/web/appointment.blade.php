@extends('layouts.web.layout')
@push('style')
<link rel="stylesheet" href="/lib/sweetalert/sweetalert2.min.css" />
    <link rel="stylesheet" href="/lib/select2/css/select2.min.css" />
    <script src="/lib/fullcalendar/packages/core/index.global.min.js"></script>
    <script src="/lib/fullcalendar/packages/core/locales/id.global.min.js"></script>
    <script src="/lib/fullcalendar/packages/daygrid/index.global.min.js"></script>

@endpush
@section('content')
<section>
    <div class="container">
        <div class="card bg-white">
            <div class="card-body p-5">
                <h1 class="text-primary text-center mb-5 fw-bold">Form Janji Temu (Stunting)</h1>
                <form action="/janji-temu/store" method="post" id="appointmentForm">
                    @csrf
                    <input type="hidden" name="doctor_name" id="txtnamadoctor">
                    <input type="hidden" name="patient_name" id="txtnamapatient">
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
                            <label class="form-label fw-bold">Nama Dokter</label>
                        </div>
                        <div class="col-lg-10">
                            <select class="form-control select2 sDoctor" name="DoctorID" required>
                                @if ($data->DoctorID != null)
                                <option value="{{ $data->DoctorID }}" selected="selected">{{ $data->nama }}
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
                    <div class="row mb-3">
                        <div class="col-lg-2">
                            <label class="form-label fw-bold">Pilih Jadwal</label>
                        </div>
                        <div class="col-lg-10">
                            <select class="form-control select2 sSchedule" name="DoctorOperationalTimeID" required>
                                @if ($data->DoctorOperationalTimeID != null)
                                <option value="{{ $data->DoctorOperationalTimeID }}" selected="selected">{{ $data->name }}
                                </option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
        <div id="doctorScheduleCard" class="card mt-4 d-none">
            <div class="card-body p-5">
                <h5 id="doctorScheduleTitle" class="fw-bold mb-3 text-center">Jadwal Dokter:</h5>
                <div id="doctorCalendar"></div>
            </div>
        </div>

    </div>
</section>
@endsection

@push('script')

<script src="/lib/sweetalert/sweetalert2.all.min.js"></script>
<script src="/lib/select2/js/select2.full.min.js"></script>

<script src="/pages/appointment.js"></script>
@endpush
