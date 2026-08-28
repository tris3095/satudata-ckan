// 1. ELEMEN DOM & KONFIGURASI
//const N8N_CHAT_URL = 'https://discover-sentences-mods-champagne.trycloudflare.com/webhook/56853250-f876-4568-9a63-782ef737cb64/chat'; 
const N8N_CHAT_URL = 'https://discover-sentences-mods-champagne.trycloudflare.com/webhook/56853250-f876-4568-9a63-782ef737cb64/chat';
// Elemen Tampilan UI
const launcher = document.getElementById('chat-launcher');
const chatWindow = document.getElementById('chat-window');
const chatModal = document.getElementById('chat-modal');
const chatMessages = document.getElementById('chat-messages');
const userInput = document.getElementById('user-input');

// Elemen Tombol
const btnOpen = document.getElementById('btn-open-chat');
const btnMinimize = document.getElementById('btn-minimize');
const btnClose = document.getElementById('btn-close');
const btnCancelExit = document.getElementById('btn-cancel-exit');
const btnConfirmExit = document.getElementById('btn-confirm-exit');
const sendBtn = document.getElementById('send-btn');

// Generate Session ID unik per pengguna
let sessionId = 'session-' + Math.random().toString(36).substring(2, 9);
let isFirstOpen = true;

let lastUserRow = null;
let scrollAnimationId = null;

function animateScrollTo(targetTop, duration = 450) {
    const container = chatMessages;
    const startTop = container.scrollTop;
    const distance = targetTop - startTop;

    if (Math.abs(distance) < 2) return;

    if (scrollAnimationId) {
        cancelAnimationFrame(scrollAnimationId);
    }

    const startTime = performance.now();

    function easeOutCubic(t) {
        return 1 - Math.pow(1 - t, 3);
    }

    function step(now) {
        const elapsed = now - startTime;
        const progress = Math.min(elapsed / duration, 1);
        container.scrollTop = startTop + distance * easeOutCubic(progress);
        if (progress < 1) {
            scrollAnimationId = requestAnimationFrame(step);
        } else {
            scrollAnimationId = null;
        }
    }

    scrollAnimationId = requestAnimationFrame(step);
}

function scrollUserMessageToTop(row) {
    if (!row) return;

    const container = chatMessages;
    const paddingTop = 15;

    let targetTop = row.offsetTop;
    if (row.offsetParent !== container) {
        targetTop = row.offsetTop - container.offsetTop;
    }

    targetTop = Math.max(0, targetTop - paddingTop, 0);

    animateScrollTo(targetTop, 450);
}

// 2. NAVIGASI UI (OPEN, MINIMIZE, CLOSE MODAL)

btnOpen.addEventListener('click', () => {
    launcher.classList.add('hidden');
    chatWindow.classList.remove('hidden');
    
    if (isFirstOpen) {
        showWelcomeMessage();
        isFirstOpen = false;
    }
    userInput.focus();
});

btnMinimize.addEventListener('click', () => {
    chatWindow.classList.add('hidden');
    launcher.classList.remove('hidden');
});

btnClose.addEventListener('click', () => {
    chatModal.classList.remove('hidden');
});

btnCancelExit.addEventListener('click', () => {
    chatModal.classList.add('hidden');
});

btnConfirmExit.addEventListener('click', () => {
    chatModal.classList.add('hidden');
    chatWindow.classList.add('hidden');
    launcher.classList.remove('hidden');
    
    chatMessages.innerHTML = '';
    sessionId = 'session-' + Math.random().toString(36).substring(2, 9);
    isFirstOpen = true;
    lastUserRow = null;
});


// 3. LOGIKA PESAN & INTEGRASI N8N

// Tampilkan Pesan Pembuka Otomatis + Opsi Tombol
function showWelcomeMessage() {
    const textParagraf1 = "Halo, saya AI Asisten Portal Satu Data Sumsel"; 
    const textParagraf2 = "Saya siap membantu Anda menemukan informasi mengenai data statistik sektoral perangkat daerah Sumatera Selatan."; 
    const textPetunjuk = "Silakan pilih salah satu topik berikut atau tuliskan pertanyaan Anda."; 

    const opsi1 = "Apa itu Metadata?"; 
    const opsi2 = "Cari Dataset Kesehatan"; 
    const opsi3 = "Daftar Organisasi Perangkat Daerah"; 

    const welcomeHTML = `
        <div class="message-row bot" style="opacity: 0; transform: translateY(10px); transition: opacity 0.4s ease, transform 0.4s ease;">
            <img src="images/icon-chat-profile.png" class="avatar-small" alt="AI">
            <div class="bubble">
                <p>${textParagraf1}</p>
                ${textParagraf2 ? `<p style="margin-top: 6px;">${textParagraf2}</p>` : ''}
                
                <div class="quick-replies">
                    ${opsi1 ? `<button class="quick-btn" onclick="sendQuickReply('${opsi1}')">${opsi1}</button>` : ''}
                    ${opsi2 ? `<button class="quick-btn" onclick="sendQuickReply('${opsi2}')">${opsi2}</button>` : ''}
                    ${opsi3 ? `<button class="quick-btn" onclick="sendQuickReply('${opsi3}')">${opsi3}</button>` : ''}
                </div>

                ${textPetunjuk ? `<p style="margin-top: 10px; font-size: 11px; color: #888;">${textPetunjuk}</p>` : ''}
            </div>
        </div>
    `;
    chatMessages.innerHTML = welcomeHTML;

    const firstRow = chatMessages.querySelector('.message-row');
    if (firstRow) {
        requestAnimationFrame(() => {
            firstRow.style.opacity = '1';
            firstRow.style.transform = 'translateY(0)';
        });
    }
}

function appendMessage(sender, text) {
    if (!text) return;

    const row = document.createElement('div');
    row.classList.add('message-row', sender);

    row.style.opacity = '0';
    row.style.transform = 'translateY(10px)';
    row.style.transition = 'opacity 0.4s ease, transform 0.4s ease';

    if (sender === 'bot') {
        const formattedText = typeof marked !== 'undefined' ? marked.parse(text) : text;
        row.innerHTML = `
            <img src="images/icon-chat-profile.png" class="avatar-small" alt="AI">
            <div class="bubble">${formattedText}</div>
        `;
    } else {
        row.innerHTML = `
            <div class="bubble">${escapeHTML(text)}</div>
        `;
        lastUserRow = row;
    }

    chatMessages.appendChild(row);

    requestAnimationFrame(() => {
        row.style.opacity = '1';
        row.style.transform = 'translateY(0)';
    });

    if (lastUserRow) {
        scrollUserMessageToTop(lastUserRow);
    }
}

// Loading Indicator 
function appendLoadingIndicator() {
    const loadingId = 'loading-' + Date.now();
    const row = document.createElement('div');
    row.classList.add('message-row', 'bot');
    row.id = loadingId;

    row.style.opacity = '0';
    row.style.transform = 'translateY(10px)';
    row.style.transition = 'opacity 0.3s ease, transform 0.3s ease';

    row.innerHTML = `
        <img src="images/icon-chat-profile.png" class="avatar-small" alt="AI">
        <div class="bubble" style="background-color: #EFEFEF; border: none;">
            <div class="typing-dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    `;
    chatMessages.appendChild(row);

    requestAnimationFrame(() => {
        row.style.opacity = '1';
        row.style.transform = 'translateY(0)';
    });

    return loadingId;
}

function removeLoadingIndicator(id) {
    if (id) {
        const element = document.getElementById(id);
        if (element) element.remove();
    }
    const leftoverLoadings = chatMessages.querySelectorAll('[id^="loading-"]');
    leftoverLoadings.forEach(el => el.remove());
}

// Kirim Pesan ke Webhook n8n
async function sendMessage(text) {
    const messageText = text || userInput.value.trim();
    if (!messageText) return;

    appendMessage('user', messageText);
    userInput.value = '';

    const loadingId = appendLoadingIndicator();

    try {
        const response = await fetch(N8N_CHAT_URL, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                action: 'sendMessage',
                chatInput: messageText,
                sessionId: sessionId
            })
        });

        if (!response.ok) {
            throw new Error(`Server merespons dengan status ${response.status}`);
        }

        const data = await response.json();
        removeLoadingIndicator(loadingId);

        // Ekstraksi jawaban dari n8n
        let botReply = '';
        if (typeof data === 'string') {
            botReply = data;
        } else if (Array.isArray(data) && data[0]) {
            botReply = data[0].output || data[0].text || data[0].message || '';
        } else if (typeof data === 'object') {
            botReply = data.output || data.text || data.message || '';
        }

        appendMessage('bot', botReply || 'Mohon maaf, saya belum menemukan jawaban yang sesuai untuk pertanyaan tersebut.');

    } catch (error) {
        removeLoadingIndicator(loadingId);
        console.error('Error connecting to server:', error);
        appendMessage('bot', 'Mohon maaf, terjadi kendala koneksi ke server. Silakan coba beberapa saat lagi.');
    }
}

// Trigger dari Quick Reply Buttons
window.sendQuickReply = function(text) {
    sendMessage(text);
};

// Event Listener Tombol Kirim & Enter Key
sendBtn.addEventListener('click', () => sendMessage());
userInput.addEventListener('keypress', (e) => {
    if (e.key === 'Enter') sendMessage();
});

// Helper XSS Security
function escapeHTML(str) {
    return str.replace(/[&<>'"]/g, 
        tag => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', "'": '&#39;', '"': '&quot;' }[tag] || tag)
    );
}