<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}@hasSection('title')
            | @yield('title')
        @endif
    </title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="preload" href="{{ asset('images/logo-satudata.png') }}" as="image">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <style>
        /*2. FLOATING CONTAINER (KANAN BAWAH)*/
        .chatbot-container {
            --primary-red: #e53b48;
            --dark-red: #c62836;
            --primary-gradient: linear-gradient(135deg, #ef5350 0%, #df3346 100%);
            --bg-chat: #fffafa;
            --bg-card: #ffffff;
            --text-dark: #303038;
            --text-muted: #707078;
            --border-color: #f0d6d8;
            position: fixed;
            bottom: 20px;
            right: 32px;
            z-index: 99999;
            font-family: "Instrument Sans", sans-serif;
        }

        .chatbot-container,
        .chatbot-container * {
            box-sizing: border-box;
        }

        /* Tetap bekerja walaupun bundle Tailwind/Vite belum tersedia. */
        .chatbot-container .hidden {
            display: none !important;
        }

        /*3. KONDISI 1: LAUNCHER BUTTON (POP UP)*/
        .launcher-btn {
            position: relative;
            background: var(--primary-gradient);
            color: white;
            border: none;
            border-radius: 30px 30px 0px 30px;
            padding: 14px 75px 14px 22px;
            font-size: 18px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0px 8px 20px rgba(230, 57, 70, 0.35);
            display: flex;
            align-items: center;
            gap: 12px;
            transition: transform 0.2s ease;
            overflow: visible !important;
        }

        .launcher-btn:hover {
            transform: translateY(-3px);
        }

        .arrow-icon {
            font-size: 14px;
        }

        .launcher-mascot {
            position: absolute;
            right: -5px;
            bottom: -2px;
            height: 95px;
            pointer-events: none;
            filter: drop-shadow(0px 4px 6px rgba(0, 0, 0, 0.15));
            z-index: 10;
        }

        /*4. KONDISI 2: MAIN CHAT WINDOW*/
        .chat-window {
            position: relative;
            width: min(420px, calc(100vw - 40px));
            height: min(650px, calc(100vh - 40px));
            min-height: 480px;
            background-color: var(--bg-chat);
            border-radius: 20px;
            border: 1px solid rgba(229, 59, 72, 0.08);
            box-shadow: 0 18px 45px rgba(78, 25, 31, 0.2);
            display: flex;
            flex-direction: column;
            overflow: visible !important;
        }

        .chat-header {
            position: relative;
            background: var(--primary-gradient);
            color: white;
            padding: 22px 20px;
            border-radius: 20px 20px 0 0;
            display: flex;
            align-items: center;
            overflow: visible !important;
        }

        .chat-header h3 {
            margin: 0;
            font-size: 22px;
            font-weight: 700;
        }

        .header-mascot {
            position: absolute;
            right: -5px;
            top: -35px;
            height: 100px;
            width: auto;
            object-fit: contain;
            pointer-events: none;
            z-index: 20;
            filter: drop-shadow(0px 4px 6px rgba(0, 0, 0, 0.15));
        }

        .chat-messages {
            flex: 1;
            min-height: 0;
            padding: 20px 18px 14px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 12px;
            border-radius: 0;
            scroll-behavior: smooth;
        }

        .chat-messages::-webkit-scrollbar {
            width: 5px;
        }

        .chat-messages::-webkit-scrollbar-thumb {
            background: #FFC1C1;
            border-radius: 10px;
        }

        .message-row {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            max-width: 88%;
            animation: messageIn 0.45s ease-out;
        }

        @keyframes messageIn {
            from {
                opacity: 0;
                transform: translateY(16px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .message-row.bot {
            align-self: flex-start;
        }

        .message-row.user {
            align-self: flex-end;
            flex-direction: row-reverse;
        }

        .avatar-small {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
            flex-shrink: 0;
            display: block;
        }

        .bubble {
            padding: 12px 16px;
            border-radius: 15px;
            font-size: 14px;
            line-height: 1.55;
            overflow-wrap: anywhere;
        }

        .bubble p {
            margin: 0;
        }

        .message-row.bot .bubble {
            background: var(--bg-card);
            color: var(--text-dark);
            border: 1px solid var(--border-color);
            border-top-left-radius: 2px;
        }

        .message-row.user .bubble {
            background: var(--primary-gradient);
            color: white;
            border-top-right-radius: 2px;
        }

        .bubble ul,
        .bubble ol {
            padding-left: 20px;
            margin: 6px 0;
        }

        .bubble li {
            margin-bottom: 4px;
        }

        .bubble li:last-child {
            margin-bottom: 0;
        }

        .bubble p+ul,
        .bubble p+ol {
            margin-top: 4px;
        }

        .quick-replies {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-top: 10px;
            width: 100%;
        }

        .quick-btn {
            background: #FFFFFF;
            color: #444444;
            border: 1px solid #E5C3C3;
            padding: 9px 12px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            text-align: center;
            transition: all 0.2s ease;
        }

        .quick-btn:hover {
            background: #FFEBEB;
            border-color: var(--primary-red);
            color: var(--primary-red);
        }

        .chat-footer {
            padding: 12px 15px 15px;
            background: var(--bg-chat);
            display: flex;
            flex-direction: column;
            gap: 12px;
            border-radius: 0 0 20px 20px;
        }

        .input-group {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-group input {
            width: 100%;
            padding: 12px 45px 12px 15px;
            border: 1px solid #E5C3C3;
            border-radius: 12px;
            font-size: 13px;
            outline: none;
            background: #FFFFFF;
            color: var(--text-dark);
        }

        .input-group input::placeholder {
            color: #8a8a91;
            opacity: 1;
        }

        .input-group input:focus {
            border-color: var(--primary-red);
        }

        .send-btn {
            position: absolute;
            right: 8px;
            background: transparent;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 5px;
            transition: color 0.2s;
        }

        .send-btn:hover {
            color: var(--primary-red);
        }

        .footer-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .action-btn {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background-color: var(--primary-red);
            color: white;
            border: none;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0px 3px 8px rgba(230, 57, 70, 0.3);
            transition: transform 0.2s ease, background-color 0.2s;
        }

        .action-btn:hover {
            background-color: var(--dark-red);
            transform: scale(1.08);
        }

        .minimize-btn {
            transform: rotate(90deg);
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .minimize-btn:hover {
            background-color: var(--dark-red);
            transform: rotate(90deg) scale(1.08);
        }

        /* 5. KONDISI 3: MODAL KONFIRMASI (CLOSE CHAT)*/
        .chat-modal {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.45);
            backdrop-filter: blur(2px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 99;
            padding: 20px;
            border-radius: 20px;
        }

        .modal-card {
            background: white;
            width: 100%;
            max-width: 280px;
            padding: 22px 20px;
            border-radius: 16px;
            text-align: center;
            box-shadow: 0px 8px 25px rgba(0, 0, 0, 0.2);
            animation: popup 0.2s ease-out;
        }

        @keyframes popup {
            from {
                transform: scale(0.8);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .modal-card h4 {
            font-size: 18px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 6px;
        }

        .modal-card p {
            font-size: 12.5px;
            color: var(--text-muted);
            margin-bottom: 18px;
            line-height: 1.4;
        }

        .modal-actions {
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        .modal-actions button {
            flex: 1;
            padding: 8px 0;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            border: none;
        }

        .btn-secondary {
            background: #FFFFFF;
            color: #555555;
            border: 1px solid #CCCCCC !important;
        }

        .btn-danger {
            background: var(--primary-gradient);
            color: white;
        }

        .typing-dots {
            display: flex;
            align-items: center;
            gap: 4px;
            padding: 4px 2px;
        }

        .typing-dots span {
            width: 6px;
            height: 6px;
            background-color: #888888;
            border-radius: 50%;
            animation: typing 1.4s infinite ease-in-out;
        }

        .typing-dots span:nth-child(1) {
            animation-delay: 0s;
        }

        .typing-dots span:nth-child(2) {
            animation-delay: 0.2s;
        }

        .typing-dots span:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes typing {

            0%,
            100% {
                transform: translateY(0);
                opacity: 0.4;
            }

            50% {
                transform: translateY(-4px);
                opacity: 1;
            }
        }

        /*RESPONSIVE DESIGN (TAMPILAN MOBILE)*/

        @media (max-width: 768px) {

            .chatbot-container {
                position: fixed;
                bottom: 15px;
                right: 15px;
                left: 15px;
                top: auto;
                width: auto;
                z-index: 999999;
                pointer-events: none;
            }

            .chat-launcher,
            .launcher-btn,
            .chat-window,
            .chat-modal {
                pointer-events: auto;
            }

            .chat-launcher {
                display: flex;
                justify-content: flex-end;
            }

            .launcher-btn {
                display: inline-flex;
                align-items: center;
                gap: 10px;
                padding: 8px 16px 8px 16px;
                font-size: 13px;
                font-weight: 600;
                border-radius: 25px;
                box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
                cursor: pointer;
            }

            .launcher-mascot {
                display: none !important;
            }

            .launcher-btn {
                padding: 10px 18px;
                font-size: 13px;
                font-weight: 600;
                border-radius: 20px;
                box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.2);
            }

            .chat-window {
                position: fixed;
                bottom: 15px;
                right: 12px;
                left: 12px;
                margin: 0 auto;
                width: auto;
                max-width: 420px;
                height: min(650px, calc(100dvh - 30px));
                min-height: 0;
                max-height: none;
                border-radius: 18px;
                box-shadow: 0px 8px 24px rgba(0, 0, 0, 0.25);
                display: flex;
                flex-direction: column;
                overflow: hidden;
            }

            .header-mascot {
                height: 75px;
                top: -24px;
                right: 8px;
            }

            .chat-header {
                padding: 16px 18px;
            }

            .chat-header h3 {
                font-size: 18px;
                font-weight: 700;
            }

            .chat-messages {
                padding: 12px 14px;
                flex: 1;
            }

            .bubble {
                font-size: 13.5px;
                line-height: 1.5;
                padding: 10px 14px;
                max-width: 88%;
            }

            .modal-card {
                width: 85%;
                padding: 20px;
            }
        }
    </style>

    @stack('plugin-style')
    @stack('custom-style')
</head>

<body class="bg-gray-50 text-gray-900">

    @include('layouts.navbar')
    @yield('content')
    @include('layouts.footer')

    <button id="scrollTopBtn"
        class="hidden fixed bottom-6 right-6 bg-red-600 text-white p-3 rounded-sm shadow-lg hover:bg-red-700 transition cursor-pointer">
        <i class="bi bi-arrow-up" aria-hidden="true"></i>
    </button>

    @stack('plugin-scripts')
    @stack('custom-scripts')

    <script>
        const scrollTopBtn = document.getElementById("scrollTopBtn");

        window.addEventListener("scroll", () => {
            if (window.scrollY > 200) {
                scrollTopBtn.classList.remove("hidden");
            } else {
                scrollTopBtn.classList.add("hidden");
            }
        });

        scrollTopBtn.addEventListener("click", () => {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        });
    </script>
    <script>
        // 1. ELEMEN DOM & KONFIGURASI
        const N8N_CHAT_URL = 'https://satudata.sumselprov.go.id/n8n-webhook/56853250-f876-4568-9a63-782ef737cb64/chat';

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
            const textParagraf2 =
                "Saya siap membantu Anda menemukan informasi mengenai data statistik sektoral perangkat daerah Sumatera Selatan.";
            const textPetunjuk = "Silakan pilih salah satu topik berikut atau tuliskan pertanyaan Anda.";

            const opsi1 = "Apa itu Metadata?";
            const opsi2 = "Cari Dataset Kesehatan";
            const opsi3 = "Daftar Organisasi Perangkat Daerah";

            const welcomeHTML = `
        <div class="message-row bot" style="opacity: 0; transform: translateY(10px); transition: opacity 0.4s ease, transform 0.4s ease;">
            <img src="{{ asset('images/icon-chat-profile.png') }}" class="avatar-small" alt="AI">
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
            <img src="{{ asset('images/icon-chat-profile.png') }}" class="avatar-small" alt="AI">
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
        <img src="{{ asset('images/icon-chat-profile.png') }}" class="avatar-small" alt="AI">
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

                appendMessage('bot', botReply ||
                    'Mohon maaf, saya belum menemukan jawaban yang sesuai untuk pertanyaan tersebut.');

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
                tag => ({
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    "'": '&#39;',
                    '"': '&quot;'
                } [tag] || tag)
            );
        }
    </script>
    <script>
        const loginMenuButton = document.getElementById('loginMenuButton');
        const loginMenu = document.getElementById('loginMenu');
        const loginModal = document.getElementById('loginModal');
        const closeLoginModal = document.getElementById('closeLoginModal');
        const loginIframe = document.getElementById('loginIframe');

        // Toggle dropdown
        loginMenuButton.addEventListener('click', () => {
            loginMenu.classList.toggle('hidden');
        });

        // Setiap link login
        document.querySelectorAll('.login-link').forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const url =
                    "https://surveidigital.spbe.go.id/embed/survey/eyJzdXJ2ZXlfaWQiOjIsInNlcnZpY2VfaWQiOjcxLCJob3N0Ijoic3Vtc2VscHJvdi5nby5pZCxzdW1zZWxwcm92MjAyMi5kZXYsc2F0dWRhdGEtY2thbi5kZXYsc2F0dWRhdGEuc3Vtc2VscHJvdi5nby5pZCIsImtleSI6IjE2VHlMaXN4In0=/embed/view/"
                loginIframe.src = url; // set iframe src
                loginModal.classList.remove('hidden');
                loginMenu.classList.add('hidden'); // tutup dropdown
            });
        });

        // Tutup modal
        if (closeLoginModal && loginModal && loginIframe) {
            closeLoginModal.addEventListener('click', () => {
                loginModal.classList.add('hidden');
                loginIframe.src = '';
            });
        }

        const btn = document.getElementById('loginMenuButton');
        const menu = document.getElementById('loginMenu');

        // toggle dropdown saat tombol diklik
        btn.addEventListener('click', function(e) {
            e.stopPropagation(); // cegah event bubbling
            menu.classList.toggle('hidden');
        });

        // klik di luar menu → hide
        document.addEventListener('click', function(e) {
            if (!menu.classList.contains('hidden')) {
                menu.classList.add('hidden');
            }
        });
    </script>
    @stack('custom-footer')
</body>

</html>
