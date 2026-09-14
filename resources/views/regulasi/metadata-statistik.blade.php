@extends('layouts.app')

@section('title', 'Dasar Regulasi Metadata Statistik')

@section('content')
    <section class="bg-gradient-to-b from-red-50/70 to-white py-12 md:py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <span class="inline-flex rounded-full bg-red-100 px-4 py-1.5 text-sm font-semibold tracking-wide text-red-700">
                    Regulasi Statistik
                </span>
                <h1 class="mt-5 text-3xl font-bold tracking-tight text-gray-900 md:text-5xl">
                    Dasar Regulasi <span class="text-red-600">Metadata Statistik</span>
                </h1>
                <p class="mt-5 text-base leading-7 text-gray-600 md:text-lg">
                    Metadata membantu data statistik lebih mudah ditemukan, dipahami, digunakan, dan dikelola melalui
                    struktur serta format yang baku.
                </p>
            </div>

            <div class="mt-10 grid grid-cols-1 gap-6 md:mt-14 md:grid-cols-2 lg:grid-cols-3">
                <article class="flex h-full flex-col rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-red-100 hover:shadow-xl md:p-7">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-red-50 text-xl text-red-600"><i class="bi bi-database-check" aria-hidden="true"></i></div>
                        <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600">01</span>
                    </div>
                    <p class="mt-6 text-sm font-semibold uppercase tracking-wider text-red-600">Peraturan Presiden</p>
                    <h2 class="mt-2 text-xl font-bold text-gray-900">Perpres Nomor 39 Tahun 2019</h2>
                    <p class="mt-2 text-sm font-medium text-gray-500">Tentang Satu Data Indonesia</p>
                    <p class="mt-5 flex-grow text-sm leading-6 text-gray-600">Mewajibkan data yang dihasilkan Produsen Data dilengkapi Metadata dengan struktur dan format baku yang ditetapkan oleh Pembina Data.</p>
                    <a href="https://peraturan.go.id/id/perpres-no-39-tahun-2019" target="_blank" rel="noopener noreferrer" class="mt-7 inline-flex items-center border-t border-gray-100 pt-5 text-sm font-semibold text-red-600 hover:text-red-700">Lihat peraturan <i class="bi bi-arrow-up-right ml-2" aria-hidden="true"></i></a>
                </article>

                <article class="flex h-full flex-col rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-red-100 hover:shadow-xl md:p-7">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-red-50 text-xl text-red-600"><i class="bi bi-file-earmark-text" aria-hidden="true"></i></div>
                        <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600">02</span>
                    </div>
                    <p class="mt-6 text-sm font-semibold uppercase tracking-wider text-red-600">Peraturan BPS</p>
                    <h2 class="mt-2 text-xl font-bold text-gray-900">Peraturan BPS Nomor 5 Tahun 2020</h2>
                    <p class="mt-2 text-sm font-medium text-gray-500">Tentang Petunjuk Teknis Metadata Statistik</p>
                    <p class="mt-5 flex-grow text-sm leading-6 text-gray-600">Menetapkan tata cara pengumpulan, pemeriksaan, dan pengelolaan Metadata Statistik untuk mendukung Sistem Statistik Nasional dan Satu Data Indonesia.</p>
                    <a href="https://drive.google.com/file/d/1sIInFUcTrYTFvsrZx9gIiWjAXMPzwz96/view?usp=drivesdk" target="_blank" rel="noopener noreferrer" class="mt-7 inline-flex items-center border-t border-gray-100 pt-5 text-sm font-semibold text-red-600 hover:text-red-700">Lihat peraturan <i class="bi bi-arrow-up-right ml-2" aria-hidden="true"></i></a>
                </article>

                <article class="flex h-full flex-col rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-red-100 hover:shadow-xl md:col-span-2 md:p-7 lg:col-span-1">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-red-50 text-xl text-red-600"><i class="bi bi-card-checklist" aria-hidden="true"></i></div>
                        <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600">03</span>
                    </div>
                    <p class="mt-6 text-sm font-semibold uppercase tracking-wider text-red-600">Instrumen Metadata</p>
                    <h2 class="mt-2 text-xl font-bold text-gray-900">Kegiatan, Variabel, dan Indikator</h2>
                    <div class="mt-5 flex-grow space-y-3 text-sm leading-6 text-gray-600">
                        <p><strong class="text-gray-900">MS-Keg</strong> menggambarkan proses penyelenggaraan kegiatan statistik.</p>
                        <p><strong class="text-gray-900">MS-Var</strong> menjelaskan variabel yang dikumpulkan.</p>
                        <p><strong class="text-gray-900">MS-Ind</strong> memberikan informasi mengenai indikator yang dihasilkan.</p>
                    </div>
                    <a href="https://sirusa.bps.go.id/metadata/" target="_blank" rel="noopener noreferrer" class="mt-7 inline-flex items-center border-t border-gray-100 pt-5 text-sm font-semibold text-red-600 hover:text-red-700">Portal Metadata BPS <i class="bi bi-arrow-up-right ml-2" aria-hidden="true"></i></a>
                </article>
            </div>
        </div>
    </section>
@endsection
