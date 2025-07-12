@extends('layouts.layout')

@section('title', 'Tabel Jam Operasional Puskesmas')

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
                        Tabel Jam Operasional Puskesmas <span class="fw-300"></span>
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-primary showMe" data-href="/master/operationaltime/add">Tambah Jam Operasional Puskesmas</button>
                    </div>
                </div>

                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="table-responsive-lg">
                            <table class="table m-0 table-bordered" id="tblData">
                                <thead class="text-white bg-primary-200">
                                    <tr>
                                        <th>Nama (Sesi)</th>
                                        <th>Jam Mulai</th>
                                        <th>Jam Selesai</th>
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
    <script src="/pages/master/operationaltime.js"></script>
@endpush
