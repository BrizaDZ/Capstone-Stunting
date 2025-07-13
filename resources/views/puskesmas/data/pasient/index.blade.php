@extends('layouts.layout')

@section('title', 'Tabel Users')

@push('style')
    <link rel="stylesheet" href="/lib/sweetalert/sweetalert2.min.css" />
    <link rel="stylesheet" href="/lib/select2/css/select2.min.css" />
    <link rel="stylesheet" href="/css/datagrid/datatables/datatables.bundle.css" />
@endpush

@section('content')
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
                        Tabel Pasien <span class="fw-300"><i></i></span>
                    </h2>
                    <a data-href="/data/pasien/add" class="btn btn-primary showMe mr-3 text-light">Tambah Pasien Baru</a>
                </div>

                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="table-responsive-lg">
                            <table class="table table-light m-0  w-100" id="tblData">
                                <thead class="text-white bg-primary-200">
                                    <tr>
                                        <th>ID Pasien</th>
                                        <th>Nama Pasien</th>
                                        <th>Umur</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Kabupaten</th>
                                        <th>Kecamatan</th>
                                        <th>Kelurahan</th>
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
    <script src="/pages/data/pasient.js"></script>
@endpush
