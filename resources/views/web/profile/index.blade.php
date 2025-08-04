@extends('layouts.web.layout')
@section('title', 'Profile')

@push('style')
<link rel="stylesheet" href="/lib/sweetalert/sweetalert2.min.css" />
<link rel="stylesheet" href="/lib/select2/css/select2.min.css" />
<link rel="stylesheet" href="/css/datagrid/datatables/datatables.bundle.css" />
<link rel="stylesheet" href="/lib/leaflet/leaflet.css" />
<script src="/lib/leaflet/leaflet.js"></script>
<style>
    #checkupTabs .nav-link {
        cursor: pointer;
    }

    .list-group-item{
        cursor: pointer;
    }

    .list-group-item:hover{
        background-color: #7bc9ff;
    }
</style>
@endpush

@section('content')
<section class="pt-5 p-3 vh-100 d-flex align-items-start my-5 justify-content-center bg-primary-200">
    <div class="modal fade" id="myModal" data-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div id='myModalContent'></div>
            </div>
        </div>
    </div>

    <div class="container-xl container-fluid mt-5">
        <div class="row g-4">
            <!-- Sidebar Menu -->
            <div class="col-12 col-md-4">
                <div class="bg-white p-4 rounded shadow w-100">
                    <h4 class="mb-3">Pengaturan</h4>
                    <ul class="list-group">
                        <li class="list-group-item active d-flex align-items-center" onclick="showForm('form-akun', this)">
                            <img src="/image/icons8-user-icon-48.png" class="me-2" width="24"> Akun Saya
                        </li>
                        <li class="list-group-item d-flex align-items-center" onclick="showForm('form-pasien', this)">
                            <img src="/image/icons8-user-groups-64.png" class="me-2" width="24"> Data Pasien
                        </li>
                        {{-- <li class="list-group-item d-flex align-items-center" onclick="showForm('change-password', this)">
                            <img src="/image/icons8-password-key-48.png" class="me-2" width="24"> Ganti Password
                        </li> --}}
                        <li class="list-group-item d-flex align-items-center" onclick="showForm('checkup', this)">
                            <img src="/image/icons8-order-history-48.png" class="me-2" width="24"> History Checkup
                        </li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-decoration-none">
                                <li class="list-group-item text-danger d-flex align-items-center border-top-0">

                                        <img src="/image/icons8-logout-48.png" class="me-2" width="24"> Logout

                                </li>
                            </a>
                        </form>

                    </ul>
                </div>
            </div>

            <!-- Content Form Area -->
            <div class="col-12 col-md-8">
                <div class="bg-white p-4 rounded shadow w-100">
                    <!-- Akun -->
                    <div id="form-akun" class="form-container">
                        <h2 class="mb-4">About You</h2>
                        <form action="/profile/patient/storedetail" method="post">
                            @csrf

                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Full Name</label>
                                        <input type="text" name="name" class="form-control" value="{{ $data->name }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="address-input">Alamat Lengkap</label>
                                        <input type="text" name="alamat" class="form-control" id="address-input" value="{{ $data->alamat }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="latitude">Latitude</label>
                                        <input type="text" name="latitude" class="form-control" id="latitude" value="{{ $data->latitude }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="longitude">Longitude</label>
                                        <input type="text" name="longitude" class="form-control" id="longitude" value="{{ $data->longitude }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <div id="map" style="height: 300px; width: 100%; border-radius: 8px;"></div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Save Changes</button>
                        </form>
                    </div>

                    <!-- Pasien -->
                    <div id="form-pasien" class="form-container" style="display: none;">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                            <h2 class="mb-2">Data Pasien</h2>
                            <button type="button" class="btn btn-primary showMe" data-href="/profile/patient/add">Tambah Pasien</button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-light w-100" id="tblData">
                                <thead class="bg-primary-200 text-white">
                                    <tr>
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

                    <!-- Ganti Password -->
                    {{-- <div id="change-password" class="form-container" style="display: none;">
                        <h2 class="mb-4">Change Password</h2>
                        <form id="changePasswordForm">
                            <div class="mb-3">
                                <label class="form-label">Current Password</label>
                                <input type="password" class="form-control" id="current-password" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">New Password</label>
                                <input type="password" class="form-control" id="new-password" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Confirm New Password</label>
                                <input type="password" class="form-control" id="confirm-password" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Update Password</button>
                            <p id="password-error" class="text-danger mt-2" style="display: none;">Passwords do not match!</p>
                        </form>
                    </div> --}}

                    <!-- Checkup History -->
                    <div id="checkup" class="form-container" style="display: none;">
                        <h2 class="text-center">History Medical Checkup</h2>
                        <ul class="nav nav-tabs mt-3" id="checkupTabs">
                            <li class="nav-item"><a class="nav-link active" onclick="showTab(event, 'scheduled')">Scheduled</a></li>
                            <li class="nav-item"><a class="nav-link" onclick="showTab(event, 'onprocess')">Checkup Results</a></li>
                            <li class="nav-item"><a class="nav-link" onclick="showTab(event, 'chart')">Grafik BB/U</a></li>
                            <li class="nav-item"><a class="nav-link" onclick="showTab(event, 'chart2')">Grafik TB/U</a></li>
                            <li class="nav-item"><a class="nav-link" onclick="showTab(event, 'chart3')">Grafik BB/TB</a></li>
                        </ul>
                        <div class="tab-content mt-3">
                            <div id="scheduled" class="tab-pane fade show active">
                                <div class="table-responsive">
                                    <table class="table table-light w-100" id="tblSchedule">
                                        <thead class="bg-primary-200 text-white">
                                            <tr>
                                                <th>Nama Pasien</th>
                                                <th>Puskesmas</th>
                                                <th>Dokter</th>
                                                <th>Jadwal</th>
                                                <th>Status</th>
                                                <th>Kartu Antrean</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <div id="onprocess" class="tab-pane fade">
                                <div class="table-responsive">
                                    <table class="table table-light w-100" id="tblResult">
                                        <thead class="bg-primary-200 text-white">
                                            <tr>
                                                <th>Nama</th>
                                                <th>Umur</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Tinggi/Panjang</th>
                                                <th>Berat</th>
                                                <th>TB/U</th>
                                                <th>BB/U</th>
                                                <th>BB/TB</th>
                                                <th>Status Stunting</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <div id="chart" class="tab-pane fade"><canvas id="chartWeightAge"></canvas></div>
                            <div id="chart2" class="tab-pane fade"><canvas id="chartHeightAge"></canvas></div>
                            <div id="chart3" class="tab-pane fade"><canvas id="chartWeightHeight"></canvas></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection

@push('script')
<script src="/lib/sweetalert/sweetalert2.all.min.js"></script>

<script src="/lib/select2/js/select2.full.min.js"></script>
<script src="/js/datagrid/datatables/datatables.bundle.js"></script>
<script src="/js/modalForm2.js"></script>
<script src="/pages/profil.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Ambil data latitude dan longitude dari input (jika ada)
        var existingLat = parseFloat(document.getElementById('latitude').value);
        var existingLng = parseFloat(document.getElementById('longitude').value);

        // Koordinat default (misalnya Jakarta)
        var defaultLat = -6.200000;
        var defaultLng = 106.816666;

        // Gunakan koordinat yang ada jika tersedia, jika tidak gunakan default
        var initialLat = !isNaN(existingLat) && existingLat !== 0 ? existingLat : defaultLat;
        var initialLng = !isNaN(existingLng) && existingLng !== 0 ? existingLng : defaultLng;

        // Inisialisasi map
        var map = L.map('map').setView([initialLat, initialLng], 13);

        // Tambahkan layer dari OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Tambahkan marker
        var marker = L.marker([initialLat, initialLng], { draggable: true }).addTo(map);

        function updateLatLngInputs(lat, lng) {
            document.getElementById('latitude').value = lat.toFixed(6);
            document.getElementById('longitude').value = lng.toFixed(6);
        }

        // Event marker
        marker.on('dragend', function (e) {
            var position = marker.getLatLng();
            updateLatLngInputs(position.lat, position.lng);
        });

        // Event click di map
        map.on('click', function (e) {
            marker.setLatLng(e.latlng);
            updateLatLngInputs(e.latlng.lat, e.latlng.lng);
        });

        updateLatLngInputs(initialLat, initialLng);

        // Jika koordinat tidak ada, gunakan geolokasi
        if (isNaN(existingLat) || existingLat === 0 || isNaN(existingLng) || existingLng === 0) {
            map.locate({ setView: true, maxZoom: 16 });

            // Event ketika lokasi ditemukan
            map.on('locationfound', function (e) {
                var lat = e.latitude;
                var lng = e.longitude;

                // Pindahkan marker ke lokasi GPS
                marker.setLatLng([lat, lng]);
                updateLatLngInputs(lat, lng);

                // Tambahkan circle untuk menunjukkan akurasi lokasi
                L.circle([lat, lng], { radius: e.accuracy }).addTo(map);
            });

            // Event ketika lokasi tidak ditemukan
            map.on('locationerror', function (e) {
                alert("Lokasi tidak dapat ditemukan: " + e.message);
            });
        }

        // Pastikan ukuran map benar
        setTimeout(function () {
            map.invalidateSize();
        }, 200);
    });
</script>

<script>
    const chartData = @json($data2);

    const labels = chartData.map(item => {
            const date = new Date(item.created_at);
            return date.toISOString().slice(0, 10);
        });
    const zWeightAge = chartData.map(item => parseFloat(item.zscoreweightage));
    const zHeightAge = chartData.map(item => parseFloat(item.zscoreheightage));
    const zWeightHeight = chartData.map(item => parseFloat(item.zscoreweightheight));

    const allZScores = [...zWeightAge, ...zHeightAge, ...zWeightHeight];
    const minZ = Math.floor(Math.min(...allZScores)) - 1;
    const maxZ = Math.ceil(Math.max(...allZScores)) + 1;

    const commonOptions = {
        responsive: true,
        scales: {
            y: {
                beginAtZero: false,
                min: minZ,
                max: maxZ,
                grid: {
                    color: (context) => context.tick.value === 0 ? '#000' : '#ccc',
                    lineWidth: (context) => context.tick.value === 0 ? 2 : 1
                },
                title: {
                    display: true,
                    text: 'Z-Score'
                }
            }
        }
    };

    new Chart(document.getElementById('chartWeightAge').getContext('2d'), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Z-Score BB/U',
                data: zWeightAge,
                backgroundColor: 'rgba(54, 162, 235, 0.6)'
            }]
        },
        options: {
            ...commonOptions,
            plugins: {
                title: {
                    display: true,
                    text: 'Z-Score BB/U per Tiap Pemeriksaan'
                }
            }
        }
    });

    new Chart(document.getElementById('chartHeightAge').getContext('2d'), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Z-Score TB/U',
                data: zHeightAge,
                backgroundColor: 'rgba(255, 206, 86, 0.6)'
            }]
        },
        options: {
            ...commonOptions,
            plugins: {
                title: {
                    display: true,
                    text: 'Z-Score TB/U per Tiap Pemeriksaan'
                }
            }
        }
    });

    new Chart(document.getElementById('chartWeightHeight').getContext('2d'), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Z-Score BB/TB',
                data: zWeightHeight,
                backgroundColor: 'rgba(75, 192, 192, 0.6)'
            }]
        },
        options: {
            ...commonOptions,
            plugins: {
                title: {
                    display: true,
                    text: 'Z-Score BB/TB per Tanggal Pemeriksaan'
                }
            }
        }
    });
</script>

@endpush
