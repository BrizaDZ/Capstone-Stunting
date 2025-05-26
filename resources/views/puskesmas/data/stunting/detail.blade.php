@extends('layouts.layout')

@section('title', 'Detail Data Stunting')

@push('style')
    <link rel="stylesheet" href="/lib/sweetalert/sweetalert2.min.css" />
    <link rel="stylesheet" href="/lib/select2/css/select2.min.css" />
    <link rel="stylesheet" href="/css/datagrid/datatables/datatables.bundle.css" />
@endpush

@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="text-center font-weight-bold mb-5">Detail Data Stunting</h4>
                <p class="badge badge-secondary">Nama: {{ $data->first()->patient_name }}</p>
                <h4 class="badge badge-secondary">Jenis Kelamin: {{ $data->first()->gender }}</h4>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Umur</th>
                        <th>Berat Badan</th>
                        <th>Tinggi Badan</th>
                        <th>Z-Score BB/U</th>
                        <th>Z-Score TB/U</th>
                        <th>Z-Score BB/TB</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $item->appointment_date }}</td>
                            <td>{{ $item->age }}</td>
                            <td>{{ $item->weight }}</td>
                            <td>{{ $item->height }}</td>
                            <td>{{ $item->zscoreweightage }}</td>
                            <td>{{ $item->zscoreheightage }}</td>
                            <td>{{ $item->zscoreweightheight }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            {{-- Chart Containers --}}
            <div class="mt-4">
                <h5 class="text-center font-weight-bold">Diagram Z-Score BB/U</h5>
                <canvas id="chartWeightAge"></canvas>
            </div>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-body">
            <div class="mt-4">
                <h5 class="text-center font-weight-bold">Diagram Z-Score TB/U</h5>
                <canvas id="chartHeightAge"></canvas>
            </div>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-body">
            <div class="mt-4">
                <h5 class="text-center font-weight-bold">Diagram Z-Score TB/U</h5>
                <canvas id="chartWeightHeight"></canvas>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const chartData = @json($data);

        const labels = chartData.map(item => item.appointment_date);
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
