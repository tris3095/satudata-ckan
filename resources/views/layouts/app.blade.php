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

<body class="bg-gray-100 text-gray-900">

    @include('layouts.navbar')

    <div class="container mx-auto">
        @yield('content')
    </div>
    @include('layouts.footer')

    @stack('plugin-scripts')
    @stack('custom-scripts')
</body>

</html>
