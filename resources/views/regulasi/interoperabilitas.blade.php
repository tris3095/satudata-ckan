@extends('layouts.app')

@section('title', 'Dasar Regulasi Interoperabilitas')

@section('content')
    <section class="bg-gradient-to-b from-red-50/70 to-white py-12 md:py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <span
                    class="inline-flex rounded-full bg-red-100 px-4 py-1.5 text-sm font-semibold tracking-wide text-red-700">
                    Regulasi Nasional
                </span>
                <h1 class="mt-5 text-3xl font-bold tracking-tight text-gray-900 md:text-5xl">
                    Dasar Regulasi <span class="text-red-600">Interoperabilitas</span>
                </h1>
                <p class="mt-5 text-base leading-7 text-gray-600 md:text-lg">
                    Landasan pertukaran dan pemanfaatan data antar sistem pemerintahan secara andal, akuntabel, aman,
                    dan sesuai dengan prinsip Satu Data Indonesia.
                </p>
            </div>

            <div class="mt-10 grid grid-cols-1 gap-6 md:mt-14 md:grid-cols-2 lg:grid-cols-3">
                <article
                    class="group flex h-full flex-col rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-red-100 hover:shadow-xl md:p-7">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-red-50 text-xl text-red-600">
                            <i class="bi bi-building-gear" aria-hidden="true"></i>
                        </div>
                        <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600">01</span>
                    </div>
                    <p class="mt-6 text-sm font-semibold uppercase tracking-wider text-red-600">Peraturan Presiden</p>
                    <h2 class="mt-2 text-xl font-bold text-gray-900">Perpres Nomor 95 Tahun 2018</h2>
                    <p class="mt-2 text-sm font-medium text-gray-500">Tentang Sistem Pemerintahan Berbasis Elektronik</p>
                    <p class="mt-5 flex-grow text-sm leading-6 text-gray-600">
                        Menjadi dasar penyelenggaraan SPBE yang terpadu. Integrasi layanan dan pertukaran data antar
                        aplikasi pemerintahan dilaksanakan untuk mewujudkan layanan publik yang efektif dan efisien.
                    </p>
                    <a href="https://peraturan.go.id/id/perpres-no-95-tahun-2018" target="_blank"
                        rel="noopener noreferrer"
                        class="mt-7 inline-flex items-center border-t border-gray-100 pt-5 text-sm font-semibold text-red-600 hover:text-red-700">
                        Lihat peraturan <i class="bi bi-arrow-up-right ml-2" aria-hidden="true"></i>
                    </a>
                </article>

                <article
                    class="group flex h-full flex-col rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-red-100 hover:shadow-xl md:p-7">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-red-50 text-xl text-red-600">
                            <i class="bi bi-database-check" aria-hidden="true"></i>
                        </div>
                        <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600">02</span>
                    </div>
                    <p class="mt-6 text-sm font-semibold uppercase tracking-wider text-red-600">Peraturan Presiden</p>
                    <h2 class="mt-2 text-xl font-bold text-gray-900">Perpres Nomor 39 Tahun 2019</h2>
                    <p class="mt-2 text-sm font-medium text-gray-500">Tentang Satu Data Indonesia</p>
                    <p class="mt-5 flex-grow text-sm leading-6 text-gray-600">
                        Menetapkan Interoperabilitas Data sebagai salah satu prinsip Satu Data Indonesia agar data dapat
                        dibagipakaikan antar-Instansi Pusat dan Instansi Daerah secara konsisten.
                    </p>
                    <a href="https://peraturan.go.id/id/perpres-no-39-tahun-2019" target="_blank"
                        rel="noopener noreferrer"
                        class="mt-7 inline-flex items-center border-t border-gray-100 pt-5 text-sm font-semibold text-red-600 hover:text-red-700">
                        Lihat peraturan <i class="bi bi-arrow-up-right ml-2" aria-hidden="true"></i>
                    </a>
                </article>

                <article
                    class="group flex h-full flex-col rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-red-100 hover:shadow-xl md:p-7">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-red-50 text-xl text-red-600">
                            <i class="bi bi-bezier2" aria-hidden="true"></i>
                        </div>
                        <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600">03</span>
                    </div>
                    <p class="mt-6 text-sm font-semibold uppercase tracking-wider text-red-600">Peraturan Menteri Kominfo</p>
                    <h2 class="mt-2 text-xl font-bold text-gray-900">Permenkominfo Nomor 1 Tahun 2023</h2>
                    <p class="mt-2 text-sm font-medium text-gray-500">Tentang Interoperabilitas Data dalam SPBE dan SDI</p>
                    <p class="mt-5 flex-grow text-sm leading-6 text-gray-600">
                        Mengatur Layanan Interoperabilitas Data nasional serta layanan pada Instansi Pusat dan Instansi
                        Daerah agar pertukaran data berlangsung secara andal, akuntabel, dan aman.
                    </p>
                    <a href="https://jdih.komdigi.go.id/produk_hukum/view/id/857/t/peraturan%2Bmenteri%2Bkomunikasi%2Bdan%2Binformatika%2Bnomor%2B1%2Btahun%2B2023"
                        target="_blank" rel="noopener noreferrer"
                        class="mt-7 inline-flex items-center border-t border-gray-100 pt-5 text-sm font-semibold text-red-600 hover:text-red-700">
                        Lihat peraturan <i class="bi bi-arrow-up-right ml-2" aria-hidden="true"></i>
                    </a>
                </article>

                <article
                    class="group flex h-full flex-col rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-red-100 hover:shadow-xl md:p-7">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-red-50 text-xl text-red-600">
                            <i class="bi bi-hdd-network" aria-hidden="true"></i>
                        </div>
                        <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600">04</span>
                    </div>
                    <p class="mt-6 text-sm font-semibold uppercase tracking-wider text-red-600">Surat Edaran Menteri Kominfo</p>
                    <h2 class="mt-2 text-xl font-bold text-gray-900">SE Menkominfo Nomor 4 Tahun 2024</h2>
                    <p class="mt-2 text-sm font-medium text-gray-500">Tentang Pemanfaatan Sistem Penghubung Layanan
                        Pemerintah untuk Mendukung Interoperabilitas Data dalam Penyelenggaraan SPBE</p>
                    <p class="mt-5 flex-grow text-sm leading-6 text-gray-600">
                        Mewajibkan Instansi Pusat dan Instansi Daerah memanfaatkan Sistem Penghubung Layanan Pemerintah
                        (SPLP) sebagai sarana pertukaran data dan layanan antar sistem elektronik dalam penyelenggaraan
                        SPBE.
                    </p>
                    <a href="https://drive.google.com/file/d/1SRsZPemP-v8J4VLCsRjRaDvOT9NCpZof/view?usp=drivesdk"
                        target="_blank" rel="noopener noreferrer"
                        class="mt-7 inline-flex items-center border-t border-gray-100 pt-5 text-sm font-semibold text-red-600 hover:text-red-700">
                        Lihat dokumen <i class="bi bi-arrow-up-right ml-2" aria-hidden="true"></i>
                    </a>
                </article>

                <article
                    class="group flex h-full flex-col rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-red-100 hover:shadow-xl md:p-7">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-red-50 text-xl text-red-600">
                            <i class="bi bi-app-indicator" aria-hidden="true"></i>
                        </div>
                        <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600">05</span>
                    </div>
                    <p class="mt-6 text-sm font-semibold uppercase tracking-wider text-red-600">Keputusan Gubernur</p>
                    <h2 class="mt-2 text-xl font-bold text-gray-900">SK Gubernur Sumatera Selatan Nomor 316 Tahun 2025</h2>
                    <p class="mt-2 text-sm font-medium text-gray-500">Tentang Standar Teknis dan Prosedur Pembangunan,
                        Pengembangan, dan Integrasi Aplikasi Khusus di Lingkungan Pemerintah Provinsi Sumatera Selatan
                    </p>
                    <p class="mt-5 flex-grow text-sm leading-6 text-gray-600">
                        Mengatur standar teknis dan prosedur pembangunan, pengembangan, serta integrasi aplikasi khusus
                        di lingkungan Pemerintah Provinsi Sumatera Selatan agar interoperabel dan selaras dengan
                        penyelenggaraan SPBE daerah.
                    </p>
                    <a href="https://drive.google.com/file/d/14uISg_7fTgh7Mm4zmMsbC5bdewcP0eRj/view?usp=drivesdk"
                        target="_blank" rel="noopener noreferrer"
                        class="mt-7 inline-flex items-center border-t border-gray-100 pt-5 text-sm font-semibold text-red-600 hover:text-red-700">
                        Lihat dokumen <i class="bi bi-arrow-up-right ml-2" aria-hidden="true"></i>
                    </a>
                </article>
            </div>
        </div>
    </section>
@endsection
