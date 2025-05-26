@extends('layouts.web.layout')

@push('style')

@endpush
@section('content')
<div class="container mt-5" style="padding:5em 0">
    <div class="card shadow rounded bg-light">
        <div class="card-header bg-primary text-white">
            <h4 class="text-center">Rekomendasi MPASI</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="/predict-mpasi">
                @csrf
                <div class="row mb-3">
                    <div class="col">
                        <label>Kalori (kkal)</label>
                        <input type="number" step="any" class="form-control" name="kalori_kkal" required>
                    </div>
                    <div class="col">
                        <label>Protein (gr)</label>
                        <input type="number" step="any" class="form-control" name="protein_gr" required>
                    </div>
                    <div class="col">
                        <label>Lemak (gr)</label>
                        <input type="number" step="any" class="form-control" name="lemak_gr" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label>Tekstur</label>
                        <select name="tekstur" class="form-select" required>
                            <option value="halus">Halus</option>
                            <option value="kasar">Kasar</option>
                        </select>
                    </div>
                    <div class="col">
                        <label>Jumlah Bahan</label>
                        <input type="number" class="form-control" name="jumlah_bahan" required>
                    </div>
                </div>
                <div class="text-center">
                    <button class="btn btn-primary w-25 mb-3 mt-3">Kirim</button>
                </div>
            </form>
        </div>
    </div>
    @if (isset($hasil))
    <div class="card bg-light mt-4 shadow rounded">
        <div class="card-header bg-primary text-white">
            <h4 class="text-center">Hasil Rekomendasi</h4>
        </div>
        <div class="card-body">

                <p><strong>Kategori Umur:</strong> {{ $hasil['prediksi_kategori_umur'] }}</p>
                <h6>Rekomendasi Makanan:</h6>
                <div class="accordion" id="accordionResep">
                    @foreach ($hasil['rekomendasi'] as $index => $makanan)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading{{ $index }}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse{{ $index }}" aria-expanded="false" aria-controls="collapse{{ $index }}">
                                    {{ $makanan['nama'] }}
                                </button>
                            </h2>
                            <div id="collapse{{ $index }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $index }}"
                                data-bs-parent="#accordionResep">
                                <div class="accordion-body">
                                    {!! nl2br(e(str_replace('\n', "\n", $makanan['resep']))) !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

        </div>
    </div>
    @endif

</div>
@endsection

@push('script')
    <script src="/css/bootstrap/js/bootstrap.bundle.min.js"></script>
@endpush
