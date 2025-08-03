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
            <div class="btn-group mb-3 w-100 text-center" role="group" aria-label="Pilih Mode">
                <input type="radio" class="btn-check" name="mode" id="mode-fitur" value="fitur" autocomplete="off" checked>
                <label class="btn btn-outline-primary" for="mode-fitur">Dari Fitur Makanan</label>

                <input type="radio" class="btn-check" name="mode" id="mode-umur" value="umur" autocomplete="off">
                <label class="btn btn-outline-primary" for="mode-umur">Dari Kategori Umur</label>
            </div>

            <form method="POST" action="/predict-mpasi" id="form-fitur">
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
                            <option value="kasar">kasar

                            </option>

                        </select>
                    </div>
                    <div class="col">
                        <label>Jumlah Bahan</label>
                        <input type="number" class="form-control" name="jumlah_bahan" placeholder="(opsional)">
                    </div>
                </div>
                <div class="text-center">
                    <button class="btn btn-primary w-25 mb-3 mt-3">Kirim</button>
                </div>
            </form>

            <form method="POST" action="/recommend-mpasi-by-age" id="form-umur" style="display:none;">
                @csrf
                <div class="mb-3">
                    <label>Kategori Umur</label>
                    <select name="kategori_umur" class="form-select" required>
                        <option value="6-8">6-8 Bulan</option>
                        <option value="9-11">9-11 Bulan</option>
                        <option value="12-23">12-23 Bulan</option>
                        <option value="24-60">24-60 Bulan</option>
                    </select>
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
                @if (isset($hasil['prediksi_kategori_umur']))
                    <p><strong>Kategori Umur:</strong> {{ $hasil['prediksi_kategori_umur'] }}</p>
                @elseif (isset($hasil['kategori_umur']))
                    <p><strong>Kategori Umur:</strong> {{ $hasil['kategori_umur'] }}</p>
                @endif

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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Set default form saat pertama kali load
            toggleMode(document.querySelector('input[name="mode"]:checked').value);

            // Event listener untuk tombol switch mode
            document.querySelectorAll('input[name="mode"]').forEach(el => {
                el.addEventListener('change', function () {
                    toggleMode(this.value);
                });
            });

            function toggleMode(mode) {
                const formFitur = document.getElementById('form-fitur');
                const formUmur = document.getElementById('form-umur');

                if (mode === 'fitur') {
                    formFitur.style.display = 'block';
                    formUmur.style.display = 'none';
                } else {
                    formFitur.style.display = 'none';
                    formUmur.style.display = 'block';
                }
            }
        });
    </script>
@endpush
