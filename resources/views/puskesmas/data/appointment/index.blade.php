@extends('layouts.layout')

@section('title', 'Tabel Pemeriksaan Stunting')

@push('style')
    <link rel="stylesheet" href="/lib/sweetalert/sweetalert2.min.css" />
    <link rel="stylesheet" href="/lib/select2/css/select2.min.css" />
    <link rel="stylesheet" href="/panel/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
    <link rel="stylesheet" href="/panel/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
@endpush

@section('content')
    <div id='myModal' class='modal fade in' role="dialog" data-bs-keyboard="false" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div id='myModalContent'></div>
            </div>
        </div>
    </div>
    <div id="resultModal" class="modal fade" tabindex="-1" aria-labelledby="resultModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resultModalLabel">Hasil Pemeriksaan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="resultModalContent">
                </div>
                <div class="modal-footer">
                    <a class="btn btn-primary">
                        Download Surat Rujukan
                    </a>
                    <button type="button" onclick="window.location.reload()" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div class="card rounded-big">
        <div class="card-header d-flex flex-column flex-md-row gap-3 flex-column flex-md-row align-content-center justify-content-between">
            <h5 class="card-title mb-0">@yield('title')</h5>
            <a data-href="/data/janji-temu/add" class="btn btn-primary showMe text-white mr-3">Tambah</a>

        </div>
        <div class="card-datatable table-responsive pt-0">
            <table id="tblData" class="datatables-basic table">
                <thead class="text-white bg-primary-200">
                    <tr>
                        <th>Nama Pasien</th>
                        <th>Nama Dokter</th>
                        <th>Puskesmas</th>
                        <th>Jadwal</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('script')
    <script src="/lib/sweetalert/sweetalert2.all.min.js"></script>
    <script src="/lib/select2/js/select2.full.min.js"></script>
    <script src="/panel/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>

    <script src="/js/resultModal.js"></script>
    <script src="/pages/data/appointment.js"></script>
@endpush
