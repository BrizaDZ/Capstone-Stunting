@extends('layouts.layout')

@section('title', 'Admin Dashboard')

@push('style')
    <link rel="stylesheet" href="/lib/sweetalert/sweetalert2.min.css" />
    <link rel="stylesheet" href="/lib/select2/css/select2.min.css" />
    <link rel="stylesheet" href="/panel/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
    <link rel="stylesheet" href="/panel/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
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
        <div class="card border-0 shadow bg-white text-secondary">
            <div class="card-body d-flex justify-content-between align-items-start">
                <div>
                    <h6 class="text-primary">Total Puskesmas</h6>
                    <h1 class="fw-bold text-primary">{{$totalPuskesmas}}</h1>
                </div>
                <div class="bg-light rounded p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-hospital-icon lucide-hospital text-primary"><path d="M12 7v4"/><path d="M14 21v-3a2 2 0 0 0-4 0v3"/><path d="M14 9h-4"/><path d="M18 11h2a2 2 0 0 1 2 2v6a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-9a2 2 0 0 1 2-2h2"/><path d="M18 21V5a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16"/></svg>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow bg-primary text-white">
            <div class="card-body d-flex justify-content-between align-items-start">
                <div>
                    <h6 class="text-white">Total Akun</h6>
                    <h1 class="fw-bold text-white">{{$totalUser}}</h1>
                </div>
                <div class="bg-white rounded p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users-round-icon lucide-users-round text-primary"><path d="M18 21a8 8 0 0 0-16 0"/><circle cx="10" cy="8" r="5"/><path d="M22 20c0-3.37-2-6.5-4-8a5 5 0 0 0-.45-8.3"/></svg>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow bg-white text-secondary">
            <div class="card-body d-flex justify-content-between align-items-start">
                <div>
                    <h6 class="text-primary">Total Pasien</h6>
                    <h1 class="fw-bold text-primary">{{$totalPasient}}</h1>
                </div>
                <div class="bg-light rounded p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-activity-icon lucide-square-activity text-primary"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M17 12h-2l-2 5-2-10-2 5H7"/></svg>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow bg-primary text-white">
            <div class="card-body d-flex justify-content-between align-items-start">
                <div>
                    <h6 class="text-white">Total Artikel</h6>
                    <h1 class="fw-bold text-white">{{$totalArtikel}}</h1>
                </div>
                <div class="bg-white rounded p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-newspaper-icon lucide-newspaper text-primary"><path d="M15 18h-5"/><path d="M18 14h-8"/><path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-4 0v-9a2 2 0 0 1 2-2h2"/><rect width="8" height="4" x="10" y="6" rx="1"/></svg>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mb-5 mt-4">
    <div class="col-md-6">
        <div class="card bg-white h-100">
            <div class="card-header bg-primary text-center">
                <h5 class="m-0 card-title font-weight-bold text-white text-center">Peta Lokasi Puskesmas</h4>
            </div>
            <div class="card-body p-0">
            <div id="map"></div>

            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card bg-white h-100">
            <div class="card-header bg-primary text-white text-center">
                <h5 class="card-title font-weight-bold text-white m-0">Top 10 Puskesmas dengan Kasus Stunting Terbanyak</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Peringkat</th>
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
<div class="row mt-4">
    <!-- User List -->
    <div class="col-md-4">
        <div class="card h-100 shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0 text-white">Daftar Pengguna</h5>
            </div>
            <div class="list-group list-group-flush" style="max-height: 500px; overflow-y: auto;" id="user-list">
                <!-- Akan digenerate dari JS -->
            </div>

        </div>
    </div>

    <!-- Chat Window -->
    <div class="col-md-8">
        <div class="card h-100 shadow">
            <div class="card-header bg-primary text-white d-flex justify-content-between">
                <h5 class="mb-0 text-white" id="chat-username">Pesan</h5>
            </div>
            <div class="card-body py-3" id="chat-box" style="height: 400px; overflow-y: auto;">
                <p class="text-muted text-center mt-3">Pilih pengguna untuk mulai chat.</p>
            </div>
            <div class="card-footer">
                <form onsubmit="sendMessage(event)">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Ketik pesan..." id="chat-input" disabled>
                        <button class="btn btn-primary" type="submit" disabled id="chat-send">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection

@push('script')
    <script src="/lib/sweetalert/sweetalert2.all.min.js"></script>
    <script src="/lib/select2/js/select2.full.min.js"></script>
        <script src="/panel/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>

    <script src="/js/modalForm.js"></script>
    <script src="/lib/leaflet/leaflet.js"></script>

    <script>
        let selectedUserId = null;
        const puskesmasLocations = @json($puskesmasLocations);

        const map = L.map('map').setView([-6.200000, 106.816666], 10);
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

function openChat(userId, userName) {
    selectedUserId = userId;
    document.getElementById('chat-username').textContent = 'Chat dengan ' + userName;
    document.getElementById('chat-input').disabled = false;
    document.getElementById('chat-send').disabled = false;

    const chatBox = document.getElementById('chat-box');
    chatBox.innerHTML = '<p class="text-muted text-center">Memuat chat...</p>';

    fetch(`/chat/${userId}`)
        .then(res => res.json())
        .then(chats => {
            chatBox.innerHTML = '';

            chats.forEach(chat => {
                const bubble = document.createElement('div');
                bubble.className = 'mb-2 ' + (chat.chatby === 'admin' ? 'text-end' : 'text-start');

                const color = chat.chatby === 'admin' ? 'bg-primary text-white' : 'bg-light text-dark';
                bubble.innerHTML = `<span class="badge p-3 ${color}">${chat.chat}</span>`;
                chatBox.appendChild(bubble);
            });

            chatBox.scrollTop = chatBox.scrollHeight;
        });
    }
    fetch('/chat-users')
        .then(res => res.json())
        .then(users => {
            const userList = document.getElementById('user-list');
            userList.innerHTML = '';

            users.forEach(user => {
                const item = document.createElement('a');
                item.href = '#';
                item.className = 'list-group-item list-group-item-action';
                item.textContent = user.name;
                item.onclick = () => openChat(user.id, user.name);
                userList.appendChild(item);
            });
        });

        function sendMessage(event) {
            event.preventDefault();

            const input = document.getElementById('chat-input');
            const message = input.value.trim();

            if (message === '' || selectedUserId === null) return;

            fetch('/chat-store', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    chat: message,
                    user_id: selectedUserId,
                    chatby: 'admin'
                })
            })
            .then(res => res.json())
            .then(data => {
                const chatBox = document.getElementById('chat-box');
                const messageBubble = document.createElement('div');
                messageBubble.className = 'mb-2 text-end';
                messageBubble.innerHTML = `<span class="badge p-3 bg-primary text-end">${data.chat}</span>`;
                chatBox.appendChild(messageBubble);

                input.value = '';
                chatBox.scrollTop = chatBox.scrollHeight;
            })
            .catch(error => {
                console.error('Gagal mengirim pesan:', error);
                alert('Gagal mengirim pesan.');
            });
        }

</script>
@endpush
