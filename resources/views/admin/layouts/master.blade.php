<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Dashboard') | Satu Data Sumsel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    @stack('plugin-style')
    @livewireStyles
</head>

<body class="bg-gray-100 text-gray-800 antialiased">

    <div class="">


        @include('admin.layouts.sidebar')

        <div id="overlay" class="fixed inset-0 bg-black/50 z-30 hidden md:hidden" onclick="toggleSidebar()">
        </div>


        <!-- MAIN CONTENT -->
        <div class="flex-1 flex flex-col ml-0 md:ml-64 mt-16">

            <!-- TOPBAR -->
            @include('admin.layouts.header')

            <!-- PAGE CONTENT -->
            <main class="flex-1 p-6">
                @yield('content')
            </main>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.toggleSidebar = function() {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('overlay');

                if (!sidebar || !overlay) {
                    console.log('Sidebar atau overlay tidak ditemukan');
                    return;
                }

                sidebar.classList.toggle('-translate-x-full');
                overlay.classList.toggle('hidden');
            }
        });
    </script>

    @livewireScripts
    @stack('plugin-scripts')
    @stack('custom-scripts')
</body>

</html>
