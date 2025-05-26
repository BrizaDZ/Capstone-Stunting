@extends('layouts.layout')

@section('title', 'Tabel Lokasi Puskesmas')

@push('style')
    <link rel="stylesheet" href="/lib/sweetalert/sweetalert2.min.css" />
    <link rel="stylesheet" href="/lib/select2/css/select2.min.css" />
    <link rel="stylesheet" href="/css/datagrid/datatables/datatables.bundle.css" />
    {{-- <link rel="stylesheet" href="/css/addon.css" /> --}}
    <link rel="stylesheet" href="/lib/leaflet/leaflet.css" />
    <style>
        #map {
            height: 500px;
        }
    </style>

@endpush

@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="card border-0 shadow bg-secondary text-secondary">
            <div class="card-body d-flex justify-content-between align-items-start">
                <div>
                    <h6 class="text-secondary">Total Puskesmas</h6>
                    <h1 class="fw-bold">{{$totalPuskesmas}}</h1>
                </div>
                <div class="bg-light rounded p-2">
                    <i class="fal fa-hospital text-secondary fa-2x font-weight-bold"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow bg-primary text-white">
            <div class="card-body d-flex justify-content-between align-items-start">
                <div>
                    <h6 class="text-muted">Total Akun</h6>
                    <h1 class="fw-bold">{{$totalUser}}</h1>
                </div>
                <div class="bg-light rounded p-2">
                    <i class="fal fa-user text-primary fa-2x font-weight-bold"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow bg-secondary text-secondary">
            <div class="card-body d-flex justify-content-between align-items-start">
                <div>
                    <h6 class="text-secondary">Total Pasien</h6>
                    <h1 class="fw-bold">{{$totalPasient}}</h1>
                </div>
                <div class="bg-light rounded p-2">
                    <i class="fal fa-stethoscope text-seconadry fa-2x font-weight-bold"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow bg-primary text-white">
            <div class="card-body d-flex justify-content-between align-items-start">
                <div>
                    <h6 class="text-muted">Total Artikel</h6>
                    <h1 class="fw-bold">{{$totalArtikel}}</h1>
                </div>
                <div class="bg-light rounded p-2">
                    <i class="fal fa-child text-primary fa-2x font-weight-bold"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card bg-secondary mt-4 h-100">
            <div class="card-header bg-primary text-center">
                <h4 class="card-title font-weight-bold text-white text-center">Peta Lokasi Puskesmas</h4>
            </div>
            <div class="card-body">
            <div id="map"></div>

            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card bg-secondary mt-4 h-100">
            <div class="card-header bg-primary text-white text-center">
                <h4 class="card-title font-weight-bold">Top 10 Puskesmas dengan Kasus Stunting Terbanyak</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Puskesmas</th>
                            <th>Total Kasus Stunting</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($topStuntingPuskesmas as $index => $puskesmas)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $puskesmas->name }}</td>
                                <td>{{ $puskesmas->total_stunting }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
    <script src="/lib/leaflet/leaflet.js"></script>

    <script>
        const puskesmasLocations = @json($puskesmasLocations);

        const map = L.map('map').setView([-6.200000, 106.816666], 10); // Set to Jakarta's coordinates
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);

        puskesmasLocations.forEach(location => {
            const marker = L.marker([location.latitude, location.longitude]).addTo(map);
            marker.bindPopup(`
                <strong>${location.name}</strong><br>
                Total Stunting: ${location.total_stunting}<br>
                Total Non-Stunting: ${location.total_non_stunting}
            `);
        });
    </script>
@endpush
