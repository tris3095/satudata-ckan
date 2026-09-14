@extends('layouts.app')

@section('title', 'Dasar Regulasi DTSEN')

@section('content')
    <section class="bg-gradient-to-b from-red-50/70 to-white py-12 md:py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <span
                    class="inline-flex rounded-full bg-red-100 px-4 py-1.5 text-sm font-semibold tracking-wide text-red-700">
                    Regulasi Nasional
                </span>
                <h1 class="mt-5 text-3xl font-bold tracking-tight text-gray-900 md:text-5xl">
                    Dasar Regulasi <span class="text-red-600">DTSEN</span>
                </h1>
                <p class="mt-5 text-base leading-7 text-gray-600 md:text-lg">
                    DTSEN diatur dan dilindungi oleh peraturan resmi pemerintah yang menjamin keakuratan,
                    keamanan, dan keterbukaan data.
                </p>
            </div>

            <div class="mt-10 grid grid-cols-1 gap-6 md:mt-14 md:grid-cols-2 lg:grid-cols-3">
                <article
                    class="group flex h-full flex-col rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-red-100 hover:shadow-xl md:p-7">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-red-50 text-xl text-red-600">
                            <i class="bi bi-file-earmark-text" aria-hidden="true"></i>
                        </div>
                        <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600">01</span>
                    </div>
                    <p class="mt-6 text-sm font-semibold uppercase tracking-wider text-red-600">Instruksi Presiden</p>
                    <h2 class="mt-2 text-xl font-bold text-gray-900">Inpres No. 4 Tahun 2025</h2>
                    <p class="mt-4 flex-grow text-sm leading-6 text-gray-600">
                        Tentang <strong class="font-semibold text-gray-800">Data Tunggal Sosial dan Ekonomi
                            Nasional</strong> — mengamanatkan pengelolaan data terintegrasi guna mendukung pembangunan
                        nasional yang terukur dan berkelanjutan.
                    </p>
                    <a href="https://drive.google.com/file/d/1IzSSuQ-USuS2Vyr3P6GngBxT5PimSIrY/view?usp=drivesdk"
                        target="_blank" rel="noopener noreferrer"
                        class="mt-7 inline-flex items-center border-t border-gray-100 pt-5 text-sm font-semibold text-red-600 hover:text-red-700">
                        Lihat dokumen <i class="bi bi-arrow-up-right ml-2" aria-hidden="true"></i>
                    </a>
                </article>

                <article
                    class="group flex h-full flex-col rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-red-100 hover:shadow-xl md:p-7">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-red-50 text-xl text-red-600">
                            <i class="bi bi-journal-text" aria-hidden="true"></i>
                        </div>
                        <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600">02</span>
                    </div>
                    <p class="mt-6 text-sm font-semibold uppercase tracking-wider text-red-600">Peraturan Menteri PPN</p>
                    <h2 class="mt-2 text-xl font-bold text-gray-900">Permen PPN No. 7 Tahun 2025</h2>
                    <p class="mt-4 flex-grow text-sm leading-6 text-gray-600">
                        Pedoman <strong class="font-semibold text-gray-800">Berbagipakai Data Tunggal Sosial dan
                            Ekonomi Nasional</strong> — mengatur persyaratan, prosedur, kewajiban, dan wewenang seluruh
                        pihak dalam pemanfaatan DTSEN.
                    </p>
                    <a href="https://drive.google.com/file/d/1Y3Au3XJTxH0vizDt6SjkGrKNlz8isaI1/view?usp=drivesdk"
                        target="_blank" rel="noopener noreferrer"
                        class="mt-7 inline-flex items-center border-t border-gray-100 pt-5 text-sm font-semibold text-red-600 hover:text-red-700">
                        Lihat dokumen <i class="bi bi-arrow-up-right ml-2" aria-hidden="true"></i>
                    </a>
                </article>

                <article
                    class="group flex h-full flex-col rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-red-100 hover:shadow-xl md:col-span-2 md:p-7 lg:col-span-1">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-red-50 text-xl text-red-600">
                            <i class="bi bi-building-gear" aria-hidden="true"></i>
                        </div>
                        <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600">03</span>
                    </div>
                    <p class="mt-6 text-sm font-semibold uppercase tracking-wider text-red-600">Keputusan Gubernur</p>
                    <h2 class="mt-2 text-xl font-bold text-gray-900">SK Gubernur Sumatera Selatan Tahun 2026</h2>
                    <p class="mt-4 flex-grow text-sm leading-6 text-gray-600">
                        Tentang <strong class="font-semibold text-gray-800">Pelaksanaan, Pengelolaan, dan Pemanfaatan
                            DTSEN Provinsi Sumatera Selatan</strong> — mengatur tata kelola DTSEN di lingkungan
                        Pemerintah Provinsi Sumatera Selatan.
                    </p>
                    <a href="https://drive.google.com/file/d/1N5Fc5wOG_9ncYimuyKNxbB2vzrThvTBt/view?usp=drivesdk"
                        target="_blank" rel="noopener noreferrer"
                        class="mt-7 inline-flex items-center border-t border-gray-100 pt-5 text-sm font-semibold text-red-600 hover:text-red-700">
                        Lihat dokumen <i class="bi bi-arrow-up-right ml-2" aria-hidden="true"></i>
                    </a>
                </article>
            </div>
        </div>
    </section>
@endsection
