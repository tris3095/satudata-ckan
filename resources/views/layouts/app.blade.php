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

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

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
        closeLoginModal.addEventListener('click', () => {
            loginModal.classList.add('hidden');
            loginIframe.src = ''; // reset iframe
        });

        // Tutup modal jika klik luar
        loginModal.addEventListener('click', (e) => {
            if (e.target === loginModal) {
                loginModal.classList.add('hidden');
                loginIframe.src = '';
            }
        });

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
