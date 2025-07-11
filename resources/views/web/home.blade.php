@extends('layouts.web.layout')
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
</style>

@endpush

@section('content')
<!-- Chatbot Sidebar Messenger -->
<div id="chatbot-widget" class="position-fixed end-0 bottom-0 m-4 z-3" style="width: 350px; max-width: 95vw;">
    <div class="card shadow-lg" id="chatbox" style="display: none; height: 500px; border-radius: 1rem 1rem 0 0;">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center" style="border-radius: 1rem 1rem 0 0;">
            <div class="d-flex gap-2 align-items-center">
                <img src="/image/icon/chat.png" width="32" height="32" class="rounded-circle bg-white p-1">
                <span id="chat-title">Chatbot StuntAIDS</span>
            </div>
            <button class="btn btn-sm btn-light" onclick="toggleChat()">×</button>
        </div>
        <div class="d-flex border-bottom">
            <button class="flex-fill btn btn-light border-0 rounded-0" id="tab-chatbot" onclick="switchChat('chatbot')">
                <i class="bi bi-robot"></i> Chatbot
            </button>
            <button class="flex-fill btn btn-light border-0 rounded-0" id="tab-admin" onclick="switchChat('admin')">
                <i class="bi bi-person-circle"></i> Admin
            </button>
        </div>
        <div class="card-body p-0" style="height: 340px; overflow-y: auto; background: #f8f9fa;">
            <div id="chat-messages-chatbot" class="p-3" style="height: 100%; overflow-y: auto;">
                <div class="text-muted text-center">Tanyakan apa saja tentang stunting!</div>
            </div>
            <div id="chat-messages-admin" class="p-3" style="height: 100%; overflow-y: auto; display: none;">
                <div class="text-muted text-center">Chat dengan admin akan tampil di sini.</div>
            </div>
        </div>
        <div class="card-footer bg-white">
            <form onsubmit="sendMessage(event)" id="chatbot-form">
                <div class="input-group">
                    <input type="text" id="user-input" class="form-control" placeholder="Ketik pesan..." required>
                    <button class="btn btn-primary" type="submit">Kirim</button>
                    <button class="btn btn-light" type="button" id="voice-btn" title="Voice Input">
                        <span id="mic-icon">🎤</span>
                    </button>
                </div>
            </form>
            <form onsubmit="sendAdminMessage(event)" id="admin-form" style="display: none;">
                <div class="input-group">
                    <input type="text" id="admin-input" class="form-control" placeholder="Ketik pesan ke admin..." required>
                    <button class="btn btn-primary" type="submit">Kirim</button>
                </div>
            </form>
        </div>
    </div>
    <button class="btn btn-primary rounded-circle p-3 shadow-lg position-fixed bottom-0 end-0 m-4" id="open-chat" onclick="toggleChat()">
        💬
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
                <p class="mt-4">Terhubung langsung dengan spesialis 24 jam atau pilih untuk konsultasi video dengan dokter tertentu.</p>
                <a class="mt-4 border-0 btn btn-primary fw-bold" onclick="toggleChat()">Konsultasi Sekarang</a>
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
                <div class="row justify-content-center mb-3">
                    <div class="col-3">
                        <button href="#dokter" class="btn btn-light w-100 py-4 shadow-sm border-0 rounded-4 d-flex flex-column align-items-center">
                            <img class="img-fluid stunticon mb-3" src="/image/icon/Doctor.png" width="70" height="70">
                            <span class="card-title fs-5 text-muted">Dokter</span>
                        </button>
                    </div>
                    <div class="col-3">
                        <a onclick="toggleChat()" class="btn btn-light w-100 py-4 shadow-sm border-0 rounded-4 d-flex flex-column align-items-center">
                            <img class="img-fluid stunticon mb-3" src="/image/icon/chat.png" width="70" height="70">
                            <span class="card-title fs-5 text-muted">Chatbot</span>
                        </a>
                    </div>
                    <div class="col-3">
                        <a href="/predict-stunting" class="btn btn-light w-100 py-4 shadow-sm border-0 rounded-4 d-flex flex-column align-items-center">
                            <img class="img-fluid stunticon mb-3" src="/image/icon/Hospital.png" width="70" height="70">
                            <span class="card-title fs-5 text-muted icontitle" style="word-break: normal">Deteksi Stunting</span>
                        </a>
                    </div>
                    <div class="col-3">
                        <a href="/mpasi" class="btn btn-light w-100 py-4 shadow-sm border-0 rounded-4 d-flex flex-column align-items-center">
                            <img class="img-fluid stunticon mb-3" src="/image/icon/Capsule.png" width="70" height="70">
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
                    <p class="card-text">{{ \Illuminate\Support\Str::limit($p->description, 80) }}</p>
                    <p class="card-text"><small class="text-muted">{{ $p->date }}</small></p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<div class="container-xl" style="background-color: #E8F1FF;">
    <div class="container py-5">
        <!-- StuntAIDS Section -->
        <div class="row justify-content-center align-items-center" style="min-height: 400px;">
            <!-- Left: Images -->
            <div class="col-md-5 d-flex justify-content-center">
                <div class="position-relative">
                    <!-- Main Image (Top Layer) -->
                    <img src="https://i.pinimg.com/736x/79/59/a4/7959a41bd0ab57637b3f4f6a03f9825d.jpg"
                         class="border border-white rounded shadow-lg border-5 position-relative d-block img-fluid"
                         style="width: 60%; bottom: 90px; left: 200px; z-index: 1;"
                         alt="Dokter 1">

                    <!-- Secondary Image (Bottom Layer, Shifted Left) -->
                    <img src="https://i.pinimg.com/736x/b6/3e/66/b63e663bc277a3b62c4d7d576af65ec8.jpg"
                         class="border border-white rounded shadow-lg border-5 position-absolute d-block img-fluid"
                         style="width: 60%; top: 80px; left: 80px; z-index: 2;"
                         alt="Dokter 2">

                    <!-- Consultation Badge (Bottom Left) -->
                    <a href="#link_nomor_WhatsApp">
                        <div class="bottom-0 gap-3 p-3 bg-white rounded shadow-sm position-absolute start-0 d-flex align-items-center"
                             style="z-index: 3; transform: translate(-30px, 70px);">
                            <i class="bi bi-chat-left-text text-primary fs-5"></i>
                            <div>
                                <strong class="text-dark">Konsultasi Gratis</strong><br>
                                <small class="text-muted">Konsultasi dengan yang terbaik</small>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Right: Text Content -->
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


<!-- Our Medical Specialist Section -->
<div class="container-xl py-5 text-center">
    <h3 class="fw-bold">Spesialis Medis Kami</h3>

    <div id="specialistCarousel" class="mt-4 carousel slide" data-bs-ride="carousel" data-bs-wrap="true">
        <div class="mb-0 carousel-indicators">
            <button type="button" data-bs-target="#specialistCarousel" data-bs-slide-to="0" class="active" aria-label="Slide 1" style="background-color: #333;"></button>
            <button type="button" data-bs-target="#specialistCarousel" data-bs-slide-to="1" aria-label="Slide 2" style="background-color: #333;"></button>
        </div>
        <!-- Carousel Wrapper -->
        <div class="carousel-inner">
            @foreach($doctors->chunk(3) as $chunkIndex => $doctorChunk)
            <div class="carousel-item @if($chunkIndex == 0) active @endif">
                <div class="row justify-content-center">
                    @foreach($doctorChunk as $doctor)
                    <div class="col-md-3">
                        <div class="text-center">
                            @if ($doctor->photo == null)
                            <img src="/image/doctor.png"
                                class="p-2 border rounded-circle bg-light img-fluid"
                                style="width: 250px; height: 325px; object-fit: cover;"
                                alt="{{ $doctor->name }}">
                            @else
                            <img src="/images/doctor/{{$doctor->photo}}"
                                class="p-2 border rounded-circle bg-light img-fluid"
                                style="width: 250px; height: 325px; object-fit: cover;"
                                alt="{{ $doctor->name }}">
                            @endif

                            <h5 class="mt-2">{{ $doctor->name }}</h5>
                            <p class="text-primary">{{ $doctor->namapuskesmas }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>

        <!-- Carousel Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#specialistCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon bg-dark rounded-circle"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#specialistCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon bg-dark rounded-circle"></span>
        </button>
    </div>
</div>

<!-- JavaScript for Auto-scroll -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let carousel = document.querySelector("#specialistCarousel");
        new bootstrap.Carousel(carousel, {
            interval: 2000, // Auto-slide every 2 seconds
            wrap: true // Infinite loop
        });
    });
</script>


<!-- Nearest Puskesmas Section -->
<div class="container-fluid" style="background-color: #E8F1FF;">
    <div class="container py-5 text-center">
        <h3 class="fw-bold">Puskesmas Terdekat</h3>
        <p class="text-end">
            <a href="https://www.google.com/maps/search/puskesmas+terdekat" target="_blank"
                class="text-decoration-none fw-semibold text-muted link-hover">
                Tampilkan di Peta &gt;&gt;
            </a>
        </p>
        <div class="d-flex justify-content-center">
            <div class="shadow-lg ratio ratio-16x9 w-100 rounded-4" style="max-width: 800px; overflow: hidden;">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d192608.48322124098!2d106.76278553078265!3d-6.220944818130442!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1spuskesmas%20jabodetabek!5e0!3m2!1sen!2sid!4v1738695799224!5m2!1sen!2sid"
                    class="rounded-3"
                    allowfullscreen
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    let selectedAdminUserId = null;
    const toggleChat = () => {
        const chatbox = document.getElementById('chatbox');
        const button = document.getElementById('open-chat');
        if (chatbox.style.display === 'none') {
            chatbox.style.display = 'block';
            button.style.display = 'none';
        } else {
            chatbox.style.display = 'none';
            button.style.display = 'block';
        }
    }

    // Tab switcher
    function switchChat(mode) {
        document.getElementById('chat-messages-chatbot').style.display = mode === 'chatbot' ? 'block' : 'none';
        document.getElementById('chat-messages-admin').style.display = mode === 'admin' ? 'block' : 'none';

        document.getElementById('chatbot-form').style.display = mode === 'chatbot' ? 'block' : 'none';
        document.getElementById('admin-form').style.display = mode === 'admin' ? 'block' : 'none';
        document.getElementById('tab-chatbot').classList.toggle('bg-primary', mode === 'chatbot');
        document.getElementById('tab-chatbot').classList.toggle('text-white', mode === 'chatbot');
        document.getElementById('tab-admin').classList.toggle('bg-primary', mode === 'admin');
        document.getElementById('tab-admin').classList.toggle('text-white', mode === 'admin');
        document.getElementById('chat-title').textContent = mode === 'chatbot' ? 'Chatbot StuntAIDS' : 'Admin StuntAIDS';
        if (mode === 'admin') {
        loadAdminMessages();
    }
    }
    const userId = @json(auth()->id());
    function loadAdminMessages() {
    fetch(`/chat/${userId}`)
        .then(res => res.json())
        .then(chats => {
            const container = document.getElementById('chat-messages-admin');
            container.innerHTML = '';

            if (chats.length === 0) {
                container.innerHTML = '<div class="text-muted text-center">Belum ada percakapan.</div>';
                return;
            }

            chats.forEach(chat => {
                const bubble = document.createElement('div');
                bubble.className = 'mb-2 ' + (chat.chatby === 'user' ? 'text-end' : 'text-start');

                const color = chat.chatby === 'user' ? 'bg-primary' : 'bg-primary-200 text-dark';
                bubble.innerHTML = `<span class="badge p-3 ${color}">${chat.chat}</span>`;
                container.appendChild(bubble);
            });

            container.scrollTop = container.scrollHeight;
        })
        .catch(err => {
            console.error('Gagal memuat chat admin:', err);
        });
}

function sendAdminMessage(event) {
    event.preventDefault();
    const input = document.getElementById('admin-input');
    const message = input.value.trim();
    if (message === '') return;

    fetch('/chat-store', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            chat: message,
            user_id: 'admin' // atau ID admin statis jika tersedia
        })
    })
    .then(res => res.json())
    .then(data => {
        const container = document.getElementById('chat-messages-admin');
        const bubble = document.createElement('div');
        bubble.className = 'mb-2 text-end';
        bubble.innerHTML = `<span class="badge p-3 bg-primary text-white">${data.chat}</span>`;
        container.appendChild(bubble);

        input.value = '';
        container.scrollTop = container.scrollHeight;
    })
    .catch(err => {
        console.error('Gagal mengirim pesan ke admin:', err);
        alert('Gagal mengirim pesan.');
    });
}
    // Default tab
    switchChat('chatbot');

    async function sendMessage(e) {
        e.preventDefault();
        const input = document.getElementById('user-input');
        const message = input.value.trim();
        if (!message) return;

        const chatMessages = document.getElementById('chat-messages-chatbot');
        const userId = {{ auth()->id() }};
        // Tambahkan pesan pengguna
        chatMessages.innerHTML += `
            <div class="text-end">
                <div class="badge bg-primary my-1 text-wrap text-white p-2 text-justify" style="white-space: pre-wrap; word-wrap: break-word; max-width: 90%; font-weight: inherit; text-align: justify; font-size: 0.85em; line-height: 1.5em;">
                    ${message}
                </div>
            </div>
        `;
        input.value = '';

        // Tambahkan indikator loading
        chatMessages.innerHTML += `
            <div id="loading" class="text-start">
                <div class="badge bg-light text-muted my-1 p-2 text-wrap" style="white-space: pre-wrap; word-wrap: break-word; max-width: 90%; font-size: 0.85em; line-height: 1.5em;">
                    Typing...
                </div>
            </div>
        `;
        chatMessages.scrollTop = chatMessages.scrollHeight;

        try {
            const res = await fetch("http://127.0.0.1:5001/chatbot/ask", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ question: message, user_id: userId })
            });

            const data = await res.json();
            document.getElementById('loading').remove();

            const escapedAnswer = data.jawaban
    .replace(/&/g, "&amp;")
    .replace(/</g, "&lt;")
    .replace(/>/g, "&gt;")
    .replace(/\\n|\n/g, "<br>")
    .replace(/\*\*(.*?)\*\*/g, "<strong>$1</strong>");

            const plainAnswer = data.jawaban
    .replace(/<[^>]+>/g, '')      // Hilangkan HTML tag
    .replace(/\*\*/g, '')         // Hilangkan tanda **
    .replace(/\*/g, '')           // Hilangkan tanda *
    .replace(/\\n/g, ' ')         // Hilangkan \n (escaped)
    .replace(/\n/g, ' ')          // Hilangkan newline asli
    .replace(/\s+/g, ' ')         // Gabungkan spasi berlebih
    .trim();                      // Hilangkan spasi depan belakang

            // Auto bacakan jawaban
            speakText(plainAnswer);

            chatMessages.innerHTML += `
                <div class="text-start d-flex align-items-start gap-2">
                    <div class="badge bg-primary-200 p-2 my-1 text-dark text-justify text-wrap" style="white-space: pre-wrap; word-wrap: break-word; max-width: 90%; font-weight: inherit; text-align: justify; font-size: 0.85em; line-height: 1.5em;">
                        ${escapedAnswer}
                    </div>
                    <button class="btn btn-sm btn-light speak-btn" title="Bacakan jawaban" data-answer="${encodeURIComponent(plainAnswer)}">
                        🔊
                    </button>
                </div>
            `;

            if (data.status === "belum terjawab") {
                switchChat('admin');
                const adminChat = document.getElementById('chat-messages-admin');
                adminChat.innerHTML += `
                    <div class="text-end">
                        <div class="badge bg-primary my-1 text-wrap text-white p-2 text-justify" style="white-space: pre-wrap; word-wrap: break-word; max-width: 90%; font-weight: inherit; text-align: justify; font-size: 0.85em; line-height: 1.5em;">
                         Pertanyaan dari pengguna: ${message}
                         Chatbot belum dapat menjawab. Mohon ditindaklanjuti.
                        </div>
                    </div>
                `;
                adminChat.scrollTop = adminChat.scrollHeight;
            }

            // Tambahkan event listener untuk tombol speaker
            setTimeout(() => {
                document.querySelectorAll('.speak-btn').forEach(btn => {
                    btn.onclick = function() {
                        const text = decodeURIComponent(this.getAttribute('data-answer'));
                        speakText(text);
                    };
                });
            }, 100);
        } catch (err) {
            document.getElementById('loading').remove();
            chatMessages.innerHTML += `
                <div class="text-start">
                    <div class="badge p-2 bg-danger text-white my-1 text-wrap" style="white-space: pre-wrap; word-wrap: break-word; max-width: 90%; font-weight: inherit; text-align: justify; font-size: 0.85em; line-height: 1.5em;">
                        Error: Failed to get response.
                    </div>
                </div>
            `;
        }

        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    // Voice input feature
    let recognizing = false;
    let recognition;
    const voiceBtn = document.getElementById('voice-btn');
    const userInput = document.getElementById('user-input');
    const micIcon = document.getElementById('mic-icon');

    if ('webkitSpeechRecognition' in window || 'SpeechRecognition' in window) {
        const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        recognition = new SpeechRecognition();
        recognition.lang = 'id-ID'; // Ganti ke 'en-US' jika ingin bahasa Inggris
        recognition.continuous = false;
        recognition.interimResults = false;

        recognition.onstart = function() {
            recognizing = true;
            micIcon.textContent = "🔴";
        };
        recognition.onend = function() {
            recognizing = false;
            micIcon.textContent = "🎤";
        };
        recognition.onresult = function(event) {
            const transcript = event.results[0][0].transcript;
            userInput.value = transcript;
            userInput.focus();
        };

        voiceBtn.addEventListener('click', function() {
            if (recognizing) {
                recognition.stop();
            } else {
                recognition.start();
            }
        });
    } else {
        voiceBtn.disabled = true;
        micIcon.textContent = "🚫";
        voiceBtn.title = "Voice input tidak didukung di browser ini";
    }

    function speakText(text) {
        if ('speechSynthesis' in window) {
            const utterance = new SpeechSynthesisUtterance(text);
            utterance.lang = 'id-ID'; // Ganti ke 'en-US' jika ingin bahasa Inggris
            window.speechSynthesis.cancel(); // Stop speech jika sedang berbicara
            window.speechSynthesis.speak(utterance);
        } else {
            alert('Fitur text-to-speech tidak didukung di browser ini.');
        }
    }


</script>
@endpush
