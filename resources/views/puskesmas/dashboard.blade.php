@extends('layouts.layout')

@section('title', 'Tabel Lokasi Puskesmas')

@push('style')
    <link rel="stylesheet" href="/lib/sweetalert/sweetalert2.min.css" />
    <link rel="stylesheet" href="/lib/select2/css/select2.min.css" />
    <link rel="stylesheet" href="/css/datagrid/datatables/datatables.bundle.css" />
    <link rel="stylesheet" href="/lib/leaflet/leaflet.css" />

    <script src="/lib/leaflet/leaflet.js"></script>
    <style>
        #map { height: 450px !important; }

        .legend {
            background: white;
            padding: 10px;
            border-radius: 5px;
            line-height: 1.5;
            font-size: 14px;
            box-shadow: 0 0 10px rgba(0,0,0,0.15);
        }

        .badge-circle {
            display: inline-block;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin-right: 6px;
        }

    </style>
@endpush

@section('content')
<div class="row mb-4">
    <div class="col-md-12 d-flex justify-content-end">
        <form method="GET" action="/puskesmas/dashboard" id="filterForm">
            <div class="input-group align-items-center">
                <select name="puskesmas_id" class="form-select form-control select2 mr-3" onchange="document.getElementById('filterForm').submit()">
                    <option value="">Semua Puskesmas</option>
                    @foreach ($puskesmasList as $puskesmas)
                        <option value="{{ $puskesmas->PuskesmasID }}" {{ request('puskesmas_id', auth()->user()->id) == $puskesmas->PuskesmasID ? 'selected' : '' }}>
                            {{ $puskesmas->nama }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow bg-white text-secondary">
            <div class="card-body d-flex justify-content-between align-items-start">
                <div>
                    <h6 class="text-primary">Total Janji Temu</h6>
                    <h1 class="fw-bold text-primary">{{ $pendingAppointmentsCount }}</h1>
                </div>
                <div class="bg-light rounded p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clipboard-clock-icon lucide-clipboard-clock text-primary"><path d="M16 14v2.2l1.6 1"/><path d="M16 4h2a2 2 0 0 1 2 2v.832"/><path d="M8 4H6a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h2"/><circle cx="16" cy="16" r="6"/><rect x="8" y="2" width="8" height="4" rx="1"/></svg>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow bg-primary text-white">
            <div class="card-body d-flex justify-content-between align-items-start">
                <div>
                    <h6 class="text-white">Total Pasien Keseluruhan</h6>
                    <h1 class="fw-bold text-white">{{ $patients->count() }}</h1>
                </div>
                <div class="bg-white rounded p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-book-user-icon lucide-book-user text-primary"><path d="M15 13a3 3 0 1 0-6 0"/><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H19a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H6.5a1 1 0 0 1 0-5H20"/><circle cx="12" cy="8" r="2"/></svg>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow bg-white text-secondary">
            <div class="card-body d-flex justify-content-between align-items-start">
                <div>
                    <h class="text-primary">Pasien Stunting</h6>
                    <h1 class="fw-bold text-primary">{{ $patients->where('status', 'Stunting')->count() }}</h1>
                </div>
                <div class="bg-light rounded p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-round-check-icon lucide-user-round-check text-primary"><path d="M2 21a8 8 0 0 1 13.292-6"/><circle cx="10" cy="8" r="5"/><path d="m16 19 2 2 4-4"/></svg>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow bg-primary text-white">
            <div class="card-body d-flex justify-content-between align-items-start">
                <div>
                    <h6 class="text-white">Pasien Non-Stunting</h6>
                    <h1 class="fw-bold text-white">{{ $patients->where('status', '!=', 'Stunting')->count() }}</h1>
                </div>
                <div class="bg-white rounded p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-round-x-icon lucide-user-round-x text-primary"><path d="M2 21a8 8 0 0 1 11.873-7"/><circle cx="10" cy="8" r="5"/><path d="m17 17 5 5"/><path d="m22 17-5 5"/></svg>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6 d-flex">
                <div class="card border-0 flex-fill">
                    <div class="card-header bg-primary m-0 p-0">
                        <h5 class="text-center text-white mt-3">Grafik Stunting Per Bulan</h2>
                    </div>
                    <div class="card-body align-content-center">
                        <canvas id="stuntingChart" class="h-75"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-flex">
                <div class="card border-0 flex-fill">
                    <div class="card-header bg-primary m-0 p-0">
                        <h5 class="text-center text-white mt-3">Peta Pasien Stunting</h2>
                    </div>
                    <div class="card-body p-0">
                        <div id="map" style="height: 600px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<script>
    var map = L.map('map').setView([-6.2, 106.8], 11);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    var patients = @json($patients);
    let bounds = [];

    patients.forEach(function(p) {
        if (!p.latitude || !p.longitude) return;

        bounds.push([p.latitude, p.longitude]);

        var color = p.status === 'Stunting' ? 'red' : 'green';
        var marker = L.circleMarker([p.latitude, p.longitude], {
            radius: 8,
            fillColor: color,
            color: "#000",
            weight: 1,
            opacity: 1,
            fillOpacity: 0.8
        }).addTo(map);

        marker.bindPopup(
            `<b>Nama:</b> ${p.name}<br>
            <b>Umur:</b> ${p.age} Bulan<br>
            <b>Jenis Kelamin:</b> ${p.gender}<br>
            <b>Alamat:</b> ${p.alamat}<br>
            <b>Status:</b> ${p.status}<br>
            <b>Koordinat:</b> ${p.latitude}, ${p.longitude}<br>
            <a href="https://www.google.com/maps?q=${p.latitude},${p.longitude}" target="_blank">
                Lihat di Google Maps
            </a>`
        );
    });

    if (bounds.length) {
        map.fitBounds(bounds);
    }

    var legend = L.control({ position: 'bottomleft' });

    legend.onAdd = function (map) {
        var div = L.DomUtil.create('div', 'legend');
        div.innerHTML = `
            <strong>Keterangan:</strong><br>
            <span class="badge-circle bg-danger"></span> Stunting<br>
            <span class="badge-circle bg-success"></span> Non-Stunting
        `;
        return div;
    };

    legend.addTo(map);
</script>
@endsection

@push('script')
    <script src="/lib/sweetalert/sweetalert2.all.min.js"></script>
    <script src="/lib/select2/js/select2.full.min.js"></script>
    <script src="/js/datagrid/datatables/datatables.bundle.js"></script>
    <script src="/js/modalForm.js"></script>
    <script src="/pages/master/lokasi.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var ctx = document.getElementById('stuntingChart').getContext('2d');
            var stuntingData = @json($stuntingPerMonth);

            var labels = [];
            var data = [];
            for (var month = 1; month <= 12; month++) {
                labels.push(new Date(0, month - 1).toLocaleString('default', { month: 'long' }));
                data.push(stuntingData[month] || 0);
            }

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah Stunting',
                        data: data,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderWidth: 2,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        }
                    },
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Bulan'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Jumlah'
                            },
                            beginAtZero: true,
                            ticks: {
                                beginAtZero: true,
                                stepSize: 1
                            }

                        }
                    }
                }
            });
        });
    </script>
@endpush
