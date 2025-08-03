@extends('layouts.layout')

@section('title', 'Tabel Artikel')

@push('style')
    <link href="/panel/assets/vendor/libs/sweetalert2/sweetalert2.css" rel="stylesheet" />

    <link rel="stylesheet" href="/lib/select2/css/select2.min.css" />
    <link rel="stylesheet" href="/panel/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
    <link rel="stylesheet" href="/panel/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
    {{-- <link rel="stylesheet" href="/css/addon.css" /> --}}
@endpush

@section('content')
    <div id='myModal' class='modal fade in' role="dialog" data-bs-keyboard="false" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div id='myModalContent'></div>
            </div>
        </div>
    </div>
    <div class="card rounded-big">
        <div class="card-header d-flex flex-column flex-md-row gap-3 flex-column flex-md-row align-content-center justify-content-between">
            <h5 class="card-title mb-0">@yield('title')</h5>
            <button class="btn btn-primary showMe" data-href="/data/artikel/add">Tambah Artikel</button>
        </div>
        <div class="card-datatable table-responsive pt-0">
            <table id="tblData" class="datatables-basic table">
                <thead class="text-white bg-primary-200">
                    <tr>
                        <th>Judul</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>


    {{-- <div class="row">
        <div class="col-md-12">
            <div id="panel-8" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Tabel Artikel
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-primary showMe" data-href="/data/artikel/add">Tambah Artikel</button>
                    </div>
                </div>

                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="table-responsive-lg">
                            <table class="table m-0 table-bordered" id="tblData">
                                <thead class="text-white bg-primary-200">
                                    <tr>
                                        <th>Judul</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection

@push('script')
    <script src="/panel/assets/vendor/libs/sweetalert2/sweetalert2.js"></script>

    <script src="/lib/select2/js/select2.full.min.js"></script>
    <script src="/panel/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
    <script src="/js/modalForm.js"></script>
    <script src="/pages/master/artikel.js"></script>
@endpush
