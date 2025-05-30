@extends('layouts.web.layout')

@push('style')

@endpush
@section('content')
<section class="align-content-center" style="min-height: 70vh">
<div class="container">
    <div id="question-card" class="card shadow border-0 text-center mx-auto" style="max-width:600px;">
        <div class="card-header bg-primary text-white">
            <h4 class="text-center">Prediksi Stunting</h4>
        </div>
      <div class="question mb-3 mt-4" id="questionText"></div>
      <img id="questionImage" class="question-image d-none mx-auto" style="width: 15em;" alt="Gambar Pertanyaan">
      <div id="inputArea" class="px-3 mt-3"></div>
      <div id="result" class="fw-bold mt-3 mb-3"></div>
    </div>
  </div>
</section>

@endsection

@push('script')
    <script>
    const featureNames = [
      'JK', 'Usia', 'Pendapatan',
      'Apakah_ibu_hanya_memberikan_asi_saja_kepada_anak_tanpa_makanan_pendamping_selama_anak_berusia_6_bulan?',
      'Apakah_ibu_memberikan_makan_pendamping_kepada_anak_ketika_anak_berumur_6_bulan?',
      'Apakah_anak_sudah_diberikan_imunisasi_lengkap?',
      'Apakah_porsi_makan_ibu_ketika_hamil_lebih_sedikit_dibandingkan_ketika_tidak_hamil?]',
      'Si_bayi_diberikan_ASI_saja_selama_6_bulan',
      'Bayi_setiap_bulan_dilakukan_penimbangan_berat_badan_di_posyandu/puskesmas',
      'Menggunakan_air_bersih_untuk_kegiatan_sehari-hari',
      'Mencuci_tangan_dengan_air_bersih_dan_sabun_sebelum_makan_dan_setelah_buang_air_besar',
      'Untuk_BAB_dan_BAK_menggunakan_jamban_yang_bersih_dam_sehat',
      'Pemberantasan_nyamuk_dilakukan_setiap_seminggu_satu_kali_\n(Pemberantasan_nyamuk_adalah_tindakan_mengurangi_dan_membunuh_nyamuk_yang_bias_menyebabkan_penyakit_demam_berdarah)',
      'Buah_dan_sayur_dikonsumsi_setiap_hari',
      'Setiap_hari_meluangkan_waktu_untuk_melakukan_aktivitas_fisik_atau_olahraga',
      'Merokok_di_dalam_rumah',
      'TB'
    ];

    // Tambahkan array gambar sesuai urutan pertanyaan (bisa berupa URL lokal/public)
    const questionImages = [
        null,
        null,
        null,
      'image/QA/menyusui.png',
      'image/QA/makanan.svg',
      'image/QA/imunisasi.svg',
      'image/QA/nafsumakan.svg',
      'image/QA/asieksklusif.svg',
      'image/QA/timbanganbayi.svg',
      'image/QA/air.svg',
      'image/QA/washhand.svg',
      'image/QA/clean.svg',
      'image/QA/nyamuk.svg',
      'image/QA/kitchen.svg',
      'image/QA/olahraga.svg',
      'image/QA/smoking.svg',
      null,
    ];

    const numericFeatures = ['Usia', 'Pendapatan', 'TB'];
    const labelMap = {
      'JK': 'Jenis Kelamin Anak',
      'Usia': 'Umur Anak (bulan)',
      'Pendapatan': 'Pendapatan Orang Tua (Rp)',
      'TB': 'Tinggi Badan Anak (cm)'
    };

    let currentIndex = 0;
    const answers = {};
    const questionText = document.getElementById("questionText");
    const inputArea = document.getElementById("inputArea");
    const result = document.getElementById("result");
    const questionImage = document.getElementById("questionImage");

    function showQuestion() {
      const feature = featureNames[currentIndex];
      let label = labelMap[feature] || feature.replace(/_/g, ' ').replace(/\?/g, '');
      questionText.innerHTML = `<div><p class="fs-5 mb-0">${label}</p></div>`;

      result.innerHTML =`<p class="text-muted fw-normal mb-3">Pertanyaan ${currentIndex + 1} dari ${featureNames.length}</p>`;
      // Tampilkan gambar jika ada
      const imgSrc = questionImages[currentIndex];
      if (imgSrc) {
        questionImage.src = imgSrc;
        questionImage.classList.remove('d-none');
      } else {
        questionImage.classList.add('d-none');
      }

      inputArea.innerHTML = '';

      if (feature === 'JK') {
        inputArea.innerHTML = `
          <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-3">
            <button class="btn btn-primary px-4" onclick="selectJK('Laki-laki')">Laki-laki</button>
            <button class="btn btn-secondary text-white px-4" onclick="selectJK('Perempuan')">Perempuan</button>
          </div>
        `;
      } else if (feature === 'Pendapatan') {
        inputArea.innerHTML = `
          <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-3">
            <button class="btn btn-primary px-4" onclick="selectPendapatan('<')">&lt; UMR</button>
            <button class="btn btn-secondary px-4 text-white" onclick="selectPendapatan('>')">&gt; UMR</button>
          </div>
        `;
      } else if (numericFeatures.includes(feature)) {
        const input = document.createElement("input");
        input.type = "number";
        input.className = "form-control mb-3";
        input.id = "numberInput";
        inputArea.appendChild(input);

        const btn = document.createElement("button");
        btn.textContent = "Lanjut";
        btn.className = "btn btn-primary px-4";
        btn.onclick = () => {
          const val = document.getElementById("numberInput").value;
          if (val === "") {
            alert("Mohon isi angka.");
            return;
          }
          answers[feature] = parseFloat(val);
          nextQuestion();
        };
        inputArea.appendChild(btn);
      } else {
        inputArea.innerHTML = `
          <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-3">
            <button class="btn btn-primary px-4" onclick="selectAnswer(1)">Ya</button>
            <button class="btn btn-danger px-4" onclick="selectAnswer(0)">Tidak</button>
          </div>
        `;
      }
    }

    window.selectPendapatan = function(val) {
      answers['Pendapatan'] = val === '<' ? 0 : 1;
      nextQuestion();
    }

    window.selectJK = function(val) {
      answers['JK'] = val === 'Laki-laki' ? 1 : 0;
      nextQuestion();
    }
    window.selectAnswer = function(val) {
      answers[featureNames[currentIndex]] = val;
      nextQuestion();
    }

    function nextQuestion() {
      currentIndex++;
      if (currentIndex < featureNames.length) {
        showQuestion();
      } else {
        questionText.innerHTML = "<h5 class='mb-4 text-primary fw-bold'>Hasil Prediksi Stunnting</h5>";
        inputArea.innerHTML = '';
        sendData();
      }
    }

    async function sendData() {
      try {
        const response = await fetch("http://localhost:5001/stunting/predict", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({ data: answers })
        });
        const json = await response.json();
        result.innerHTML = `<span class="fs-4">${json.prediction} (${json.z_score})</span>`;
      } catch (error) {
        result.innerHTML = "<span class='text-danger'>❌ Gagal menghubungi server.</span>";
      }
    }

    showQuestion();
  </script>
@endpush
