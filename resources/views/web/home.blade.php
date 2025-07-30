@extends('layouts.web.layout')
@section('title', 'Beranda')

@push('style')
<style>
.bg-primary-200 {
    background-color: #eaf2ff !important;
}
@media (max-width: 791px) {
    .card-group{
        display: block;
    }
}
@media (max-width: 768px) {
    .stuntpadding{
        padding-top: 9em;
    }
    .fs-5{
        font-size: 0.9em !important;
    }
    .icontitle{
        display: inline-block;
    }
}
@media (max-width: 595px){
    .fs-5{
        font-size: 0.8em !important;
    }
    .stunticon{
        width: 50px;
    }
}

@media (max-width: 390px){
    .stunticon{
        width: 40px;
    }
}

@media (max-width: 576px) {
  .ratio-16x9 {
    height: 500px !important;
  }
}


.typing-indicator {
    display: flex;
    align-items: center;
    gap: 5px;
    background: #f1f1f1;
    border-radius: 1rem;
    padding: 8px 12px;
    max-width: 90%;
    font-size: 0.85em;
    animation: pulse 1s infinite;
}

.typing-indicator span {
    display: inline-block;
    width: 6px;
    height: 6px;
    margin: 0 1px;
    background-color: #999;
    border-radius: 50%;
    animation: bounce 1.3s infinite;
}

.typing-indicator span:nth-child(2) {
    animation-delay: 0.2s;
}
.typing-indicator span:nth-child(3) {
    animation-delay: 0.4s;
}

#chatbox{
    display: none; height: 480px; background: linear-gradient(180deg,rgba(199, 233, 255, 1) 50%, rgba(255, 255, 255, 1) 100%);
}

#card-header{
     border-bottom-right-radius: 1.5em !important; border-bottom-left-radius: 1.5em !important;
}

.message{
white-space: pre-wrap; word-wrap: break-word; max-width: 90%; font-weight: inherit; text-align: justify; font-size: 0.85em; line-height: 1.5em;
}
@keyframes bounce {
    0%, 80%, 100% {
        transform: scale(0.8);
        opacity: 0.4;
    }
    40% {
        transform: scale(1.2);
        opacity: 1;
    }
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

</style>

@endpush

@section('content')
<div class="modal fade" id="myModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                    <img src="/image/modal.png" class="img-fluid" />
            </div>
        </div>
    </div>
</div>
<div id="chatbot-widget" class="position-fixed end-0 m-4 z-3" style="width: 390px; max-width: 95vw; bottom: 20px">
    <div class="card shadow-lg border-0" id="chatbox" data-user-id="{{ auth()->user()->id ?? '' }}">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center border-0" id="card-header">
            <div class="d-flex gap-2 align-items-center ">
                <img src="/image/stunty2.png" width="32" height="32" class="rounded-circle bg-white p-1">
                <span id="chat-title" class="fw-bold">Stunty Chatbot</span>
            </div>
            <p class="text-white m-0 p-0 fw-bold fs-3 me-3" style="cursor: pointer" onclick="toggleChat()">&times;</button>
        </div>
        <div class="card-body p-0 pt-3" style="height: 340px; overflow-y: auto;">
            <div class="d-flex border-0 mx-2">
                <button class="flex-fill btn btn-light border-0 rounded-pill fw-bold me-2" id="tab-chatbot" onclick="switchChat('chatbot')">
                    Stunty
                </button>
                <button class="flex-fill btn btn-light border-0 rounded-pill fw-bold" id="tab-admin" onclick="switchChat('admin')">
                    Admin
                </button>
            </div>
            <div id="chat-messages-chatbot" class="p-3" style="height: 100%; overflow-y: auto;">
                <div class="text-start">
                <div class="badge bg-white my-1 text-wrap text-dark p-2 text-justify message">
                    Hai! Saya Stunty, chatbot yang siap membantu Anda dengan pertanyaan seputar website StuntAIDS dan stunting. Silakan ajukan pertanyaan Anda!
                </div>
            </div>
            </div>
            <div id="chat-messages-admin" class="p-3" style="height: 100%; overflow-y: auto; display: none;">
                <div class="text-muted text-center">Chat dengan admin akan tampil di sini.</div>
            </div>
        </div>
        <div class="card-footer border-0 bg-white">
            <form onsubmit="sendMessage(event)" id="chatbot-form">
                <div class="input-group mt-3">
                    <input type="text" id="user-input" class="form-control rounded-3" placeholder="Ketik pesan..." required>
                    <button class="btn btn-primary rounded-3 ms-2" type="submit">Kirim</button>
                    <button class="btn btn-light" type="button" id="voice-btn" title="Voice Input">
                        <span id="mic-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mic-icon lucide-mic"><path d="M12 19v3"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><rect x="9" y="2" width="6" height="13" rx="3"/></svg></span>
                    </button>
                </div>
            </form>
            <form onsubmit="sendAdminMessage(event)" id="admin-form" style="display: none;">
                <div class="input-group mt-3">
                    <input type="text" id="admin-input" class="form-control" placeholder="Ketik pesan ke admin..." required>
                    <button class="btn btn-primary rounded-3" type="submit">Kirim</button>
                </div>
            </form>
        </div>
    </div>
    <span class="p-3 position-fixed bottom-0 end-0 m-4" id="open-chat" onclick="toggleChat()">
        <img src="/image/stunty.png" width="180" height="180" >
    </button>
</div>

<section class="full-screen px-5" style="background-image: url(image/bg-home.png); background-position: center; background-size: cover;">
    <div class="container-xl align-content-center">
        <div class="row">
            <div class="col-md-5">
                <h4 class="text-secondary">
                    Dukung Setiap Langkah Pertumbuhan dengan
                </h4>
                <h1 class="fw-bold">Stunt<span class="text-primary">AIDS</span></h1>
                <p class="mt-4">Layanan chatbot tersedia 24 jam sehari untuk menjawab pertanyaan dan membantu kebutuhan kesehatan Anda kapan saja.</p>
                <a class="mt-4 border-0 btn btn-primary fw-bold" onclick="toggleChat()">Chat Sekarang</a>
            </div>
            <div class="col-md-7"></div>
        </div>
    </div>
</section>
<section class="" style="margin-top: -9em; min-height: 30vh;">
    <div class="container-xl align-content-center">
        <div class="border-0 shadow card rounded-3">
            <div class="card-body">
                <h4 class="mt-4 mb-3 text-center text-secondary fw-bold">Anda mungkin mencari</h4>
                <div class="row justify-content-center mb-3 g-4">
                    <div class="col-6 col-sm-3">
                        <a href="/#doctor" class="btn btn-light w-100 py-4 shadow-sm border-0 rounded-4 d-flex flex-column align-items-center h-100">
                            <img class="img-fluid stunticon mb-3" src="/image/icon/Doctor.png">
                            <span class="card-title fs-5 text-muted">Dokter</span>
                        </a>
                    </div>
                    <div class="col-6 col-sm-3">
                        <a onclick="toggleChat()" class="btn btn-light w-100 py-4 shadow-sm border-0 rounded-4 d-flex flex-column align-items-center h-100">
                            <img class="img-fluid stunticon mb-3" src="/image/icon/chat.png">
                            <span class="card-title fs-5 text-muted">Chatbot</span>
                        </a>
                    </div>
                    <div class="col-6 col-sm-3">
                        <a href="/predict-stunting" class="btn btn-light w-100 py-4 shadow-sm border-0 rounded-4 d-flex flex-column align-items-center h-100">
                            <img class="img-fluid stunticon mb-3" src="/image/icon/Hospital.png">
                            <span class="card-title fs-5 text-muted icontitle" style="word-break: normal">Deteksi Stunting</span>
                        </a>
                    </div>
                    <div class="col-6 col-sm-3">
                        <a href="/mpasi" class="btn btn-light w-100 py-4 shadow-sm border-0 rounded-4 d-flex flex-column align-items-center h-100">
                            <img class="img-fluid stunticon mb-3" src="/image/icon/Capsule.png">
                            <span class="card-title fs-5 text-muted icontitle" style="word-break: normal">MPASI Rekomendasi</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="full-screen my-5 px-3">
    <div class="container-xl">
        <p class="text-center text-primary fs-5 fw-bold">Blog & Berita</p>
        <h1 class="text-center text-secondary fw-bold">Berita Stunting</h1>
        <div class="mt-5 card-group" style="gap: 3em">
            @foreach($articles as $p)
            <div class="card rounded-3 border-0 shadow mb-4">
                <img src="images/article/{{$p->photo}}" class="card-img-top" alt="..." style="height:200px;object-fit:cover;">
                <div class="card-body">
                    <h5 class="card-title">{{ $p->title }}</h5>
                    <p class="card-text">{{ \Illuminate\Support\Str::limit(strip_tags($p->description), 80) }}</p>
                    <p class="card-text"><small class="text-muted">{{ \Carbon\Carbon::parse($p->date)->locale('id')->translatedFormat('l, d F Y') }}</small></p>
                    <a href="/detail/article/{{ $p->slug }}" class="btn btn-primary">Baca Selengkapnya</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="bg-white">
<div class="container-xl">
    <div class="container py-5">
        <div class="row justify-content-center align-items-center" style="min-height: 400px;">
            <div class="col-md-5 d-flex justify-content-center">
                <div class="position-relative">
                    <img src="/image/stunt1.jpg"
                         class="border border-white rounded shadow-lg border-5 position-relative d-block img-fluid"
                         style="width: 60%; bottom: 90px; left: 200px; z-index: 1;"
                         alt="Dokter 1">

                    <img src="/image/stunt2.jpg"
                         class="border border-white rounded shadow-lg border-5 position-absolute d-block img-fluid"
                         style="width: 60%; top: 80px; left: 80px; z-index: 2;"
                         alt="Dokter 2">

                    <a href="#link_nomor_WhatsApp">
                        <div class="bottom-0 gap-3 p-3 bg-white rounded shadow-sm position-absolute start-0 d-flex align-items-center"
                             style="z-index: 3; transform: translate(-30px, 70px);">
                            <i class="bi bi-chat-left-text text-primary fs-5"></i>
                            <div>
                                <strong class="text-dark">Janji Temu</strong><br>
                                <small class="text-muted">Buat Janji Temu Secara Online</small>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="px-5 text-center col-md-6 ms-md-5 text-md-start stuntpadding">
                <p class="mb-3 text-uppercase text-primary fw-bold small">Membantu Pasien Stunting dari Seluruh Dunia!</p>
                <h2 class="mb-4 fw-bold">Stunt<span class="text-primary">AIDS</span></h2>
                <p class="mb-3 text-muted lh-lg">
                    Kami berupaya mengatasi pertumbuhan terhambat dengan menyediakan keluarga dan tenaga kesehatan sumber daya penting, panduan ahli, dan alat inovatif untuk mendukung masa depan anak yang lebih sehat.
                </p>
                <ul class="gap-3 list-unstyled">
                    <li class="mb-3 d-flex align-items-center btn btn-light" style="cursor: default;">
                        <i class="bi bi-check-circle-fill text-primary fs-5 me-2"></i>
                        <span>Selalu Update Tentang Kesehatan Anda</span>
                    </li>
                    <li class="mb-3 d-flex align-items-center btn btn-light" style="cursor: default;">
                        <i class="bi bi-check-circle-fill text-primary fs-5 me-2"></i>
                        <span>Cek Hasil Anda Secara Online</span>
                    </li>
                    <li class="d-flex align-items-center btn btn-light" style="cursor: default;">
                        <i class="bi bi-check-circle-fill text-primary fs-5 me-2"></i>
                        <span>Atur Janji Temu Anda</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
</section>


<section style="min-height: 70vh">
<div id="doctor" class="container-xl py-5 text-center ">
    <h3 class="fw-bold">Spesialis Medis Kami</h3>

    @php
        $chunks = $doctors->chunk(3);
        $totalSlides = $chunks->count();
    @endphp

    <div id="specialistCarousel" class="mt-4 carousel slide" data-bs-ride="carousel" data-bs-wrap="true">
        @if ($totalSlides > 1)
        <div class="mb-0 carousel-indicators">
            @foreach($chunks as $index => $chunk)
                <button type="button" data-bs-target="#specialistCarousel" data-bs-slide-to="{{ $index }}"
                    class="{{ $index == 0 ? 'active' : '' }}"
                    aria-label="Slide {{ $index + 1 }}"
                    style="background-color: #333;"></button>
            @endforeach
        </div>
        @endif

        <div class="carousel-inner">
            @foreach($chunks as $chunkIndex => $doctorChunk)
            <div class="carousel-item @if($chunkIndex == 0) active @endif">
                <div class="row justify-content-center g-3">
                    @foreach($doctorChunk as $doctor)
                    <div class="col-md-3 px-4">
                        <div class="text-center">
                            @if ($doctor->photo == null)
                            <img src="/image/doctor.png"
                                class="border rounded-3 bg-light img-fluid"
                                style="object-fit: cover; height: 375px"
                                alt="{{ $doctor->name }}">
                            @else
                            <img src="/images/doctor/{{$doctor->photo}}"
                                class="border rounded-3 bg-light img-fluid"
                                style="object-fit: cover; height: 375px"
                                alt="{{ $doctor->name }}">
                            @endif

                            <div class="bg-white rounded-3 mt-3" style="padding: 0.1em">
                            <h5 class="mt-2">{{ $doctor->name }}</h5>
                            <p class="text-primary mb-3">{{ $doctor->namapuskesmas }}</p>
                            </div>

                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>

        @if ($totalSlides > 1)
        <button class="carousel-control-prev" type="button" data-bs-target="#specialistCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon bg-dark rounded-3"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#specialistCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon bg-dark rounded-3"></span>
        </button>
        @endif
    </div>
</div>
</section>


<section class="bg-white">
    <div id="puskesmas">
        <div class="container py-5 text-center">
            <h3 class="fw-bold mb-5">Puskesmas Terdekat</h3>
            <p class="text-end me-5">
                <a href="https://www.google.com/maps/search/puskesmas+terdekat" target="_blank"
                    class="text-decoration-none fw-semibold text-muted link-hover">
                    Tampilkan di Peta &gt;&gt;
                </a>
            </p>
            <div class="d-flex justify-content-center px-5">
                <div class="shadow-lg ratio ratio-16x9 w-100 rounded-4 map-container">
                    <iframe
                    id="map-iframe"
                    class="rounded-3"
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    allowfullscreen>
                    </iframe>
                </div>
            </div>

                <p id="status" class="mt-3 text-muted">Mendeteksi lokasi Anda...</p>

        </div>
    </div>
</section>

        @include('layouts.web.footer')


@endsection

@push('script')
<script src="/pages/chatbot.js"></script>
<script src="/pages/map.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const carousel = document.querySelector("#specialistCarousel");
        if (carousel) {
            new bootstrap.Carousel(carousel, {
                interval: 4000,
                wrap: true
            });
        }
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var myModal = new bootstrap.Modal(document.getElementById('myModal'));
        myModal.show();
    });
</script>

@endpush
