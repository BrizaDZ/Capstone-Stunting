let selectedAdminUserId = null;
const userId = document.getElementById('chatbox').dataset.userId;

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
            user_id: userId,
            chatby: 'user',
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
    switchChat('chatbot');

    async function sendMessage(e) {
        e.preventDefault();
        const input = document.getElementById('user-input');
        const message = input.value.trim();
        if (!message) return;

        const chatMessages = document.getElementById('chat-messages-chatbot');
        chatMessages.innerHTML += `
            <div class="text-end">
                <div class="badge bg-primary my-1 text-wrap text-white p-2 text-justify" style="white-space: pre-wrap; word-wrap: break-word; max-width: 90%; font-weight: inherit; text-align: justify; font-size: 0.85em; line-height: 1.5em;">
                    ${message}
                </div>
            </div>
        `;
        input.value = '';

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
    .replace(/<[^>]+>/g, '')
    .replace(/\*\*/g, '')
    .replace(/\*/g, '')
    .replace(/\\n/g, ' ')
    .replace(/\n/g, ' ')
    .replace(/\s+/g, ' ')
    .trim();

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

    let recognizing = false;
    let recognition;
    const voiceBtn = document.getElementById('voice-btn');
    const userInput = document.getElementById('user-input');
    const micIcon = document.getElementById('mic-icon');

    if ('webkitSpeechRecognition' in window || 'SpeechRecognition' in window) {
        const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        recognition = new SpeechRecognition();
        recognition.lang = 'id-ID';
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
            utterance.lang = 'id-ID';
            window.speechSynthesis.cancel();
            window.speechSynthesis.speak(utterance);
        } else {
            alert('Fitur text-to-speech tidak didukung di browser ini.');
        }
    }

