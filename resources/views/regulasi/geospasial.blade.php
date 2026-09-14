@extends('layouts.app')

@section('title', 'Dasar Regulasi Geospasial')

@section('content')
    <section class="bg-gradient-to-b from-red-50/70 to-white py-12 md:py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <span
                    class="inline-flex rounded-full bg-red-100 px-4 py-1.5 text-sm font-semibold tracking-wide text-red-700">
                    Regulasi Geospasial
                </span>
                <h1 class="mt-5 text-3xl font-bold tracking-tight text-gray-900 md:text-5xl">
                    Dasar Regulasi <span class="text-red-600">Geospasial</span>
                </h1>
                <p class="mt-5 text-base leading-7 text-gray-600 md:text-lg">
                    Landasan hukum penyediaan, pengelolaan, pemanfaatan, dan penyebarluasan data serta informasi
                    geospasial nasional hingga tingkat Provinsi Sumatera Selatan.
                </p>
            </div>

            <div class="mt-10 grid grid-cols-1 gap-6 md:mt-14 md:grid-cols-2">
                <article
                    class="group flex h-full flex-col rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-red-100 hover:shadow-xl md:p-7">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-red-50 text-xl text-red-600">
                            <i class="bi bi-person-badge" aria-hidden="true"></i>
                        </div>
                        <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600">01</span>
                    </div>
                    <p class="mt-6 text-sm font-semibold uppercase tracking-wider text-red-600">Keputusan Kepala BIG</p>
                    <h2 class="mt-2 text-xl font-bold text-gray-900">Kep. Kepala BIG No. 130 Tahun 2025</h2>
                    <p class="mt-2 text-sm font-medium text-gray-500">Tentang Walidata Informasi Geospasial Tematik</p>
                    <p class="mt-5 flex-grow text-sm leading-6 text-gray-600">
                        Menetapkan Walidata Informasi Geospasial Tematik pada Instansi Pusat dan Instansi Daerah sebagai
                        penanggung jawab pemeriksaan dan penyebarluasan Informasi Geospasial Tematik.
                    </p>
                    <a href="https://drive.google.com/file/d/1Tv8o-WTQPOsfbrf62X3ve2gRcz4Mm5oh/view?usp=drivesdk"
                        target="_blank" rel="noopener noreferrer"
                        class="mt-7 inline-flex items-center border-t border-gray-100 pt-5 text-sm font-semibold text-red-600 hover:text-red-700">
                        Lihat dokumen <i class="bi bi-arrow-up-right ml-2" aria-hidden="true"></i>
                    </a>
                </article>

                <article
                    class="group flex h-full flex-col rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-red-100 hover:shadow-xl md:p-7">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-red-50 text-xl text-red-600">
                            <i class="bi bi-share" aria-hidden="true"></i>
                        </div>
                        <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600">02</span>
                    </div>
                    <p class="mt-6 text-sm font-semibold uppercase tracking-wider text-red-600">Peraturan BIG</p>
                    <h2 class="mt-2 text-xl font-bold text-gray-900">Peraturan BIG No. 3 Tahun 2024</h2>
                    <p class="mt-2 text-sm font-medium text-gray-500">Tentang Mekanisme dan Tata Kerja Berbagi Pakai Data
                        dan Informasi Geospasial Kebijakan Satu Peta</p>
                    <p class="mt-5 flex-grow text-sm leading-6 text-gray-600">
                        Mengatur mekanisme dan tata kerja berbagi pakai data serta informasi geospasial antar Instansi
                        Pusat dan Instansi Daerah dalam mendukung penyelenggaraan Kebijakan Satu Peta.
                    </p>
                    <a href="https://drive.google.com/file/d/1bn4hLs8HHlo8EyvPExDSzI_cNOb_I4cW/view?usp=drivesdk"
                        target="_blank" rel="noopener noreferrer"
                        class="mt-7 inline-flex items-center border-t border-gray-100 pt-5 text-sm font-semibold text-red-600 hover:text-red-700">
                        Lihat dokumen <i class="bi bi-arrow-up-right ml-2" aria-hidden="true"></i>
                    </a>
                </article>

                <article
                    class="group flex h-full flex-col rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-red-100 hover:shadow-xl md:p-7">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-red-50 text-xl text-red-600">
                            <i class="bi bi-megaphone" aria-hidden="true"></i>
                        </div>
                        <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600">03</span>
                    </div>
                    <p class="mt-6 text-sm font-semibold uppercase tracking-wider text-red-600">Surat Edaran Bersama BIG</p>
                    <h2 class="mt-2 text-xl font-bold text-gray-900">SE Bersama BIG RI Tahun 2026</h2>
                    <p class="mt-2 text-sm font-medium text-gray-500">Tentang Dukungan dalam Penyelenggaraan Informasi
                        Geospasial pada Pemerintahan Daerah</p>
                    <p class="mt-5 flex-grow text-sm leading-6 text-gray-600">
                        Mengimbau dukungan Pemerintahan Daerah dalam penyelenggaraan Informasi Geospasial, mencakup
                        penyediaan, pemeriksaan, dan penyebarluasan data geospasial di lingkup daerah.
                    </p>
                    <a href="https://drive.google.com/file/d/1vZ_hGp5XRl3D2bJxY9BgNXbfW7XccrHt/view?usp=drivesdk"
                        target="_blank" rel="noopener noreferrer"
                        class="mt-7 inline-flex items-center border-t border-gray-100 pt-5 text-sm font-semibold text-red-600 hover:text-red-700">
                        Lihat dokumen <i class="bi bi-arrow-up-right ml-2" aria-hidden="true"></i>
                    </a>
                </article>

                <article
                    class="group flex h-full flex-col rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-red-100 hover:shadow-xl md:p-7">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-red-50 text-xl text-red-600">
                            <i class="bi bi-people-fill" aria-hidden="true"></i>
                        </div>
                        <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600">04</span>
                    </div>
                    <p class="mt-6 text-sm font-semibold uppercase tracking-wider text-red-600">Keputusan Gubernur</p>
                    <h2 class="mt-2 text-xl font-bold text-gray-900">SK Gubernur Sumatera Selatan No. 565 Tahun 2024</h2>
                    <p class="mt-2 text-sm font-medium text-gray-500">Tentang Tim Jaringan Informasi Geospasial Daerah
                        (JIGD) Provinsi Sumatera Selatan</p>
                    <p class="mt-5 flex-grow text-sm leading-6 text-gray-600">
                        Membentuk Tim Jaringan Informasi Geospasial Daerah Provinsi Sumatera Selatan sebagai wadah
                        koordinasi penyelenggaraan informasi geospasial di lingkungan Pemerintah Provinsi Sumatera
                        Selatan.
                    </p>
                    <a href="https://drive.google.com/file/d/1bzWPjzdI5kvwhy1vVhsot77KDoL86U0P/view?usp=drivesdk"
                        target="_blank" rel="noopener noreferrer"
                        class="mt-7 inline-flex items-center border-t border-gray-100 pt-5 text-sm font-semibold text-red-600 hover:text-red-700">
                        Lihat dokumen <i class="bi bi-arrow-up-right ml-2" aria-hidden="true"></i>
                    </a>
                </article>
            </div>
        </div>
    </section>
@endsection
