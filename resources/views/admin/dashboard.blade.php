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
<div class="row mb-5">
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
<div class="row mt-4">
    <!-- User List -->
    <div class="col-md-4">
        <div class="card h-100 shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Daftar Pengguna</h5>
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
                <h5 class="mb-0" id="chat-username">Pesan</h5>
            </div>
            <div class="card-body" id="chat-box" style="height: 400px; overflow-y: auto;">
                <p class="text-muted text-center">Pilih pengguna untuk mulai chat.</p>
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
    <script src="/js/datagrid/datatables/datatables.bundle.js"></script>
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
                bubble.className = 'mb-2 ' + (chat.chatby === 'admin' ? 'text-right' : 'text-left');

                const color = chat.chatby === 'admin' ? 'bg-primary text-white' : 'bg-secondary';
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
                    user_id: selectedUserId
                })
            })
            .then(res => res.json())
            .then(data => {
                const chatBox = document.getElementById('chat-box');
                const messageBubble = document.createElement('div');
                messageBubble.className = 'mb-2 text-left';
                messageBubble.innerHTML = `<span class="badge p-3 bg-primary text-right">${data.chat}</span>`;
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
