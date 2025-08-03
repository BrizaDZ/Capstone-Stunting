@extends('layouts.layout')

@section('title', 'Tabel Jadwal Operasional')

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
    <div class="card rounded-big">
        <div class="card-header d-flex flex-column flex-md-row gap-3 flex-column flex-md-row align-content-center justify-content-between">
            <h5 class="card-title mb-0">@yield('title')</h5>
            <button class="btn btn-primary showMe" data-href="/master/operationaltime/add">Tambah</button>

        </div>
        <div class="card-datatable table-responsive pt-0">
            <table id="tblData" class="datatables-basic table">
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
@endsection

@push('script')
    <script src="/lib/sweetalert/sweetalert2.all.min.js"></script>
    <script src="/lib/select2/js/select2.full.min.js"></script>
    <script src="/panel/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>

    <script src="/js/modalForm.js"></script>
    <script src="/pages/master/operationaltime.js"></script>
@endpush
