@extends('layouts.app')

@section('title', $dberita->judul)

@push('plugin-style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
@endpush

@section('content')
    <section class="max-w-4xl mx-auto px-6 py-10">
        <div class="bg-white rounded-xl shadow-lg p-3 md:p-5 md:mt-7">
            <header class="mb-8">
                <h1 class="text-3xl font-bold leading-tight text-gray-900">
                    {{ $dberita->title }}
                </h1>

                <!-- Metadata (tanggal rilis) -->
                <div class="mt-2 text-sm text-gray-600 flex space-x-4">
                    <span><strong>Tanggal Rilis&nbsp;:</strong>&nbsp;
                        {{ \Carbon\Carbon::parse($dberita->rilis_date)->translatedFormat('d F Y') ?? $dberita->rilis_date }}</span>&nbsp;&nbsp;&nbsp
                    <span><strong>Ukuran File&nbsp;:</strong>&nbsp;
                        {{ number_format($dberita->size / 1024 / 1024, 2) }}&nbsp;MB</span>
                </div>
            </header>

            <!-- Tombol Share / Download -->
            <div class="flex items-center gap-4 mb-6">

                <a href="{{ asset('storage/brs/' . $dberita->materi) }}"
                    class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition">
                    📥 Unduh BRS
                </a>


            </div>

            <!-- Gambar Pendukung -->
            <div class="w-full mb-8">
                <img src="{{ asset('storage/brs/' . $dberita->image_path) ?? asset('images/default.png') }}"
                    alt="Ilustrasi press release" class="w-full h-auto rounded-lg shadow-md" />
            </div>

            <!-- Abstraksi -->
            <section class="prose prose-lg text-gray-700 mx-auto mb-10">
                <h2 class="text-xl font-semibold text-gray-900">Abstraksi</h2>
                <p>
                    {!! $dberita->description !!}
                </p>
            </section>

        </div>

    @endsection

    @push('plugin-scripts')
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    @endpush
    @push('custom-scripts')
        <script>
            new Swiper(".desktopSwiper", {
                loop: true,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
            });

            new Swiper(".mobileSwiper", {
                loop: true,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
            });
        </script>
    @endpush
