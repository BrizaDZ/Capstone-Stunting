@extends('layouts.layout')

@section('title', 'Tabel Pemeriksaan Stunting')

@push('style')
    <link rel="stylesheet" href="/lib/sweetalert/sweetalert2.min.css" />
    <link rel="stylesheet" href="/lib/select2/css/select2.min.css" />
    <link rel="stylesheet" href="/css/datagrid/datatables/datatables.bundle.css" />
    {{-- <link rel="stylesheet" href="/css/addon.css" /> --}}
@endpush

@section('content')
    <!--Modal Window-->
    <div id='myModal' class='modal fade' data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div id='myModalContent'></div>
            </div>
        </div>
    </div>
    <div id="resultModal" class="modal fade" tabindex="-1" aria-labelledby="resultModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resultModalLabel">Hasil Pemeriksaan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="resultModalContent">
                    <!-- Hasil akan ditampilkan di sini -->
                </div>
                <div class="modal-footer">
                    <a href="/surat-rujukan/download/{{$data->StuntingID}}" class="btn btn-primary" target="_blank">
                        Download PDF
                    </a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div id="panel-8" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Tabel Pemeriksaan Stunting <span class="fw-300"><i></i></span>
                    </h2>
                    <a data-href="/data/janji-temu/add" class="btn btn-primary showMe text-light mr-3">Tambah</a>
                </div>

                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="table-responsive-lg">
                            <table class="table m-0 table-bordered" id="tblData">
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
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="/lib/sweetalert/sweetalert2.all.min.js"></script>
    <script src="/lib/select2/js/select2.full.min.js"></script>
    <script src="/js/datagrid/datatables/datatables.bundle.js"></script>
    <script src="/js/resultModal.js"></script>
    <script src="/pages/data/appointment.js"></script>
@endpush
