@extends('layouts.layout')

@section('title', 'Tabel Data Stunting')

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

    <div class="row">
        <div class="col-md-12">
            <div id="panel-8" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Tabel Data Stunting <span class="fw-300"><i></i></span>
                    </h2>
                    <a href="/export-stunting" class="btn btn-primary mr-3"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-download mr-1 fw-bold" viewBox="0 0 16 16">
                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z"/>
                      </svg> Export Data</a>
                </div>

                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="table-responsive-lg">
                            <table class="table m-0 table-bordered" id="tblData">
                                <thead class="text-white bg-primary-200">
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Nama Pasien</th>
                                        <th>Umur</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Berat</th>
                                        <th>Tinggi Badan</th>
                                        <th>Cara Mengukur</th>
                                        <th>BB/U</th>
                                        <th>TB/U</th>
                                        <th>BB/TB</th>
                                        <th>Z-Score BB/U</th>
                                        <th>Z-Score TB/U</th>
                                        <th>Z-Score BB/TB</th>
                                        <th>Status</th>
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
    <script src="/js/modalForm.js"></script>
    <script src="/pages/data/stunting.js"></script>
@endpush
