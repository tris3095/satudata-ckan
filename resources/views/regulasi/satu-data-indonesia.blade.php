@extends('layouts.app')

@section('title', 'Dasar Regulasi Satu Data Indonesia')

@section('content')
    <section class="bg-gradient-to-b from-red-50/70 to-white py-12 md:py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <span
                    class="inline-flex rounded-full bg-red-100 px-4 py-1.5 text-sm font-semibold tracking-wide text-red-700">
                    Regulasi Satu Data Indonesia
                </span>
                <h1 class="mt-5 text-3xl font-bold tracking-tight text-gray-900 md:text-5xl">
                    Dasar Regulasi <span class="text-red-600">Satu Data Indonesia</span>
                </h1>
                <p class="mt-5 text-base leading-7 text-gray-600 md:text-lg">
                    Landasan tata kelola data pemerintah untuk menghasilkan data yang akurat, mutakhir, terpadu,
                    dapat dipertanggungjawabkan, mudah diakses, dan dibagipakaikan &mdash; dari tingkat nasional
                    hingga penyelenggaraannya di Provinsi Sumatera Selatan.
                </p>

                <div class="mt-7 flex flex-wrap items-center justify-center gap-3">
                    <a href="#regulasi-nasional"
                        class="inline-flex items-center rounded-full border border-gray-200 bg-white px-4 py-2 text-sm font-semibold text-gray-700 transition hover:border-red-200 hover:text-red-600">
                        <i class="bi bi-bank mr-2 text-red-500" aria-hidden="true"></i>Regulasi Nasional
                    </a>
                    <a href="#regulasi-daerah"
                        class="inline-flex items-center rounded-full border border-gray-200 bg-white px-4 py-2 text-sm font-semibold text-gray-700 transition hover:border-red-200 hover:text-red-600">
                        <i class="bi bi-geo-alt mr-2 text-red-500" aria-hidden="true"></i>Regulasi Daerah
                    </a>
                    <a href="#nota-kesepahaman"
                        class="inline-flex items-center rounded-full border border-gray-200 bg-white px-4 py-2 text-sm font-semibold text-gray-700 transition hover:border-red-200 hover:text-red-600">
                        <i class="bi bi-journal-check mr-2 text-red-500" aria-hidden="true"></i>Nota Kesepahaman
                    </a>
                </div>
            </div>

            {{-- Regulasi tingkat pusat --}}
            <div id="regulasi-nasional" class="mt-14 scroll-mt-24 md:mt-20">
                <div class="flex flex-wrap items-center gap-4">
                    <h2 class="text-2xl font-bold tracking-tight text-gray-900">Regulasi Nasional</h2>
                    <span class="hidden h-px flex-1 bg-gray-200 sm:block"></span>
                    <span class="rounded-full bg-red-50 px-3 py-1 text-xs font-semibold text-red-600">4 Regulasi</span>
                </div>
                <p class="mt-2 max-w-3xl text-sm leading-6 text-gray-600">
                    Kebijakan tingkat pusat yang menjadi payung penyelenggaraan Satu Data Indonesia.
                </p>

                <div class="mt-8 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                    <article
                        class="group flex h-full flex-col rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-red-100 hover:shadow-xl md:p-7">
                        <div class="flex items-start justify-between gap-4">
                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-xl bg-red-50 text-xl text-red-600">
                                <i class="bi bi-bank" aria-hidden="true"></i>
                            </div>
                            <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600">01</span>
                        </div>
                        <p class="mt-6 text-sm font-semibold uppercase tracking-wider text-red-600">Peraturan Presiden</p>
                        <h3 class="mt-2 text-xl font-bold text-gray-900">Perpres Nomor 39 Tahun 2019</h3>
                        <p class="mt-2 text-sm font-medium text-gray-500">Tentang Satu Data Indonesia</p>
                        <p class="mt-5 flex-grow text-sm leading-6 text-gray-600">
                            Menetapkan prinsip, kelembagaan, serta tata cara penyelenggaraan Satu Data Indonesia melalui
                            pemenuhan Standar Data, Metadata, Interoperabilitas Data, dan penggunaan Kode Referensi atau
                            Data Induk.
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
                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-xl bg-red-50 text-xl text-red-600">
                                <i class="bi bi-window-stack" aria-hidden="true"></i>
                            </div>
                            <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600">02</span>
                        </div>
                        <p class="mt-6 text-sm font-semibold uppercase tracking-wider text-red-600">Peraturan Menteri PPN</p>
                        <h3 class="mt-2 text-xl font-bold text-gray-900">Permen PPN Nomor 17 Tahun 2020</h3>
                        <p class="mt-2 text-sm font-medium text-gray-500">Tentang Pengelolaan Portal Satu Data Indonesia</p>
                        <p class="mt-5 flex-grow text-sm leading-6 text-gray-600">
                            Mengatur penyebarluasan data, penyelenggaraan Portal Satu Data Indonesia, pembatasan akses
                            data, penyelesaian hambatan teknis, serta pendanaan pengelolaan portal.
                        </p>
                        <a href="https://peraturan.bpk.go.id/Details/254838/permen-ppnkepala-bappenas-no-17-tahun-2020"
                            target="_blank" rel="noopener noreferrer"
                            class="mt-7 inline-flex items-center border-t border-gray-100 pt-5 text-sm font-semibold text-red-600 hover:text-red-700">
                            Lihat peraturan <i class="bi bi-arrow-up-right ml-2" aria-hidden="true"></i>
                        </a>
                    </article>

                    <article
                        class="group flex h-full flex-col rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-red-100 hover:shadow-xl md:p-7">
                        <div class="flex items-start justify-between gap-4">
                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-xl bg-red-50 text-xl text-red-600">
                                <i class="bi bi-people" aria-hidden="true"></i>
                            </div>
                            <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600">03</span>
                        </div>
                        <p class="mt-6 text-sm font-semibold uppercase tracking-wider text-red-600">Peraturan Menteri PPN</p>
                        <h3 class="mt-2 text-xl font-bold text-gray-900">Permen PPN Nomor 18 Tahun 2020</h3>
                        <p class="mt-2 text-sm font-medium text-gray-500">Tentang Tata Kerja Penyelenggara SDI Tingkat
                            Pusat</p>
                        <p class="mt-5 flex-grow text-sm leading-6 text-gray-600">
                            Mengatur peran Dewan Pengarah, Pembina Data, Walidata, Produsen Data, Forum Satu Data
                            Indonesia, sekretariat, serta hubungan penyelenggaraan tingkat pusat dan daerah.
                        </p>
                        <a href="https://peraturan.bpk.go.id/Details/254843" target="_blank" rel="noopener noreferrer"
                            class="mt-7 inline-flex items-center border-t border-gray-100 pt-5 text-sm font-semibold text-red-600 hover:text-red-700">
                            Lihat peraturan <i class="bi bi-arrow-up-right ml-2" aria-hidden="true"></i>
                        </a>
                    </article>

                    <article
                        class="group flex h-full flex-col rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-red-100 hover:shadow-xl md:col-span-2 md:p-7 lg:col-span-3">
                        <div class="flex items-start justify-between gap-4">
                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-xl bg-red-50 text-xl text-red-600">
                                <i class="bi bi-journal-text" aria-hidden="true"></i>
                            </div>
                            <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600">04</span>
                        </div>
                        <p class="mt-6 text-sm font-semibold uppercase tracking-wider text-red-600">Keputusan Menteri
                            PPN/Kepala Bappenas</p>
                        <h3 class="mt-2 text-xl font-bold text-gray-900">Kepmen Bappenas Nomor 91 Tahun 2025</h3>
                        <p class="mt-2 text-sm font-medium text-gray-500">Tentang Pedoman Penyelenggaraan Satu Data
                            Indonesia</p>
                        <p class="mt-5 flex-grow text-sm leading-6 text-gray-600">
                            Pedoman teknis terbaru bagi penyelenggara Satu Data Indonesia di tingkat pusat maupun daerah,
                            mencakup tata cara perencanaan, pengumpulan, pemeriksaan, dan penyebarluasan data sesuai
                            prinsip Satu Data Indonesia.
                        </p>
                        <a href="https://drive.google.com/file/d/1GdEgz3GwXQKokIORvZcyiT7bv9GR9Pnl/view?usp=drivesdk"
                            target="_blank" rel="noopener noreferrer"
                            class="mt-7 inline-flex items-center border-t border-gray-100 pt-5 text-sm font-semibold text-red-600 hover:text-red-700">
                            Lihat dokumen <i class="bi bi-arrow-up-right ml-2" aria-hidden="true"></i>
                        </a>
                    </article>
                </div>
            </div>

            {{-- Regulasi tingkat Provinsi Sumatera Selatan --}}
            <div id="regulasi-daerah" class="mt-16 scroll-mt-24 md:mt-20">
                <div class="flex flex-wrap items-center gap-4">
                    <h2 class="text-2xl font-bold tracking-tight text-gray-900">
                        Regulasi Daerah Provinsi Sumatera Selatan
                    </h2>
                    <span class="hidden h-px flex-1 bg-gray-200 sm:block"></span>
                    <span class="rounded-full bg-red-50 px-3 py-1 text-xs font-semibold text-red-600">5 Regulasi</span>
                </div>
                <p class="mt-2 max-w-3xl text-sm leading-6 text-gray-600">
                    Peraturan dan Keputusan Gubernur yang mengatur penyelenggaraan Satu Data di Provinsi Sumatera
                    Selatan.
                </p>

                <div class="mt-8 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                    <article
                        class="group flex h-full flex-col rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-red-100 hover:shadow-xl md:p-7">
                        <div class="flex items-start justify-between gap-4">
                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-xl bg-red-50 text-xl text-red-600">
                                <i class="bi bi-building-gear" aria-hidden="true"></i>
                            </div>
                            <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600">05</span>
                        </div>
                        <p class="mt-6 text-sm font-semibold uppercase tracking-wider text-red-600">Peraturan Gubernur</p>
                        <h3 class="mt-2 text-xl font-bold text-gray-900">Pergub Nomor 04 Tahun 2021</h3>
                        <p class="mt-2 text-sm font-medium text-gray-500">Tentang Satu Data Indonesia Provinsi Sumatera
                            Selatan</p>
                        <p class="mt-5 flex-grow text-sm leading-6 text-gray-600">
                            Dasar hukum utama penyelenggaraan Satu Data di Provinsi Sumatera Selatan, mengatur prinsip
                            Satu Data serta kelembagaan Pembina Data, Walidata, dan Produsen Data di lingkup daerah.
                        </p>
                        <div class="mt-7 border-t border-gray-100 pt-5 text-sm font-semibold text-gray-500">
                            <i class="bi bi-database-check mr-2 text-red-500" aria-hidden="true"></i>Dasar Hukum Daerah
                        </div>
                    </article>

                    <article
                        class="group flex h-full flex-col rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-red-100 hover:shadow-xl md:p-7">
                        <div class="flex items-start justify-between gap-4">
                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-xl bg-red-50 text-xl text-red-600">
                                <i class="bi bi-people-fill" aria-hidden="true"></i>
                            </div>
                            <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600">06</span>
                        </div>
                        <p class="mt-6 text-sm font-semibold uppercase tracking-wider text-red-600">Keputusan Gubernur</p>
                        <h3 class="mt-2 text-xl font-bold text-gray-900">Pembentukan Forum Satu Data</h3>
                        <p class="mt-2 text-sm font-medium text-gray-500">Provinsi Sumatera Selatan Tahun 2022</p>
                        <p class="mt-5 flex-grow text-sm leading-6 text-gray-600">
                            Membentuk Forum Satu Data Provinsi Sumatera Selatan sebagai wadah koordinasi Pembina Data,
                            Walidata, dan Produsen Data dalam merencanakan serta mengevaluasi penyelenggaraan Satu Data.
                        </p>
                        <div class="mt-7 border-t border-gray-100 pt-5 text-sm font-semibold text-gray-500">
                            <i class="bi bi-diagram-3 mr-2 text-red-500" aria-hidden="true"></i>Kelembagaan Satu Data
                        </div>
                    </article>

                    <article
                        class="group flex h-full flex-col rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-red-100 hover:shadow-xl md:p-7">
                        <div class="flex items-start justify-between gap-4">
                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-xl bg-red-50 text-xl text-red-600">
                                <i class="bi bi-calendar-check" aria-hidden="true"></i>
                            </div>
                            <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600">07</span>
                        </div>
                        <p class="mt-6 text-sm font-semibold uppercase tracking-wider text-red-600">Keputusan Gubernur</p>
                        <h3 class="mt-2 text-xl font-bold text-gray-900">Penetapan Penyelenggara Satu Data</h3>
                        <p class="mt-2 text-sm font-medium text-gray-500">Provinsi Sumatera Selatan Tahun 2026</p>
                        <p class="mt-5 flex-grow text-sm leading-6 text-gray-600">
                            Menetapkan susunan penyelenggaraan Satu Data Provinsi Sumatera Selatan beserta pembagian
                            tugas Pembina Data, Walidata, dan Produsen Data untuk tahun 2026.
                        </p>
                        <div class="mt-7 border-t border-gray-100 pt-5 text-sm font-semibold text-gray-500">
                            <i class="bi bi-person-badge mr-2 text-red-500" aria-hidden="true"></i>Penetapan Penyelenggara
                        </div>
                    </article>

                    <article
                        class="group flex h-full flex-col rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-red-100 hover:shadow-xl md:p-7">
                        <div class="flex items-start justify-between gap-4">
                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-xl bg-red-50 text-xl text-red-600">
                                <i class="bi bi-list-check" aria-hidden="true"></i>
                            </div>
                            <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600">08</span>
                        </div>
                        <p class="mt-6 text-sm font-semibold uppercase tracking-wider text-red-600">Keputusan Gubernur</p>
                        <h3 class="mt-2 text-xl font-bold text-gray-900">Penetapan Daftar Data Tahun 2024</h3>
                        <p class="mt-2 text-sm font-medium text-gray-500">Provinsi Sumatera Selatan</p>
                        <p class="mt-5 flex-grow text-sm leading-6 text-gray-600">
                            Menetapkan Daftar Data Provinsi Sumatera Selatan tahun 2024 sebagai acuan data prioritas yang
                            wajib dikumpulkan dan dibagipakaikan oleh Produsen Data.
                        </p>
                        <a href="https://drive.google.com/file/d/1nLM8YCufIKAcPpV0kMtMHxDB1I35_Opb/view?usp=drivesdk"
                            target="_blank" rel="noopener noreferrer"
                            class="mt-7 inline-flex items-center border-t border-gray-100 pt-5 text-sm font-semibold text-red-600 hover:text-red-700">
                            Lihat dokumen <i class="bi bi-arrow-up-right ml-2" aria-hidden="true"></i>
                        </a>
                    </article>

                    <article
                        class="group flex h-full flex-col rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-red-100 hover:shadow-xl md:p-7">
                        <div class="flex items-start justify-between gap-4">
                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-xl bg-red-50 text-xl text-red-600">
                                <i class="bi bi-card-checklist" aria-hidden="true"></i>
                            </div>
                            <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600">09</span>
                        </div>
                        <p class="mt-6 text-sm font-semibold uppercase tracking-wider text-red-600">Keputusan Gubernur</p>
                        <h3 class="mt-2 text-xl font-bold text-gray-900">Penetapan Daftar Data Tahun 2025</h3>
                        <p class="mt-2 text-sm font-medium text-gray-500">Provinsi Sumatera Selatan</p>
                        <p class="mt-5 flex-grow text-sm leading-6 text-gray-600">
                            Pemutakhiran Daftar Data Provinsi Sumatera Selatan tahun 2025 yang menjadi dasar perencanaan
                            pengumpulan data sektoral pada seluruh perangkat daerah.
                        </p>
                        <a href="https://drive.google.com/file/d/1U6K6hLyLfSs87UlgUh-upr7Ri29GpCG4/view?usp=drivesdk"
                            target="_blank" rel="noopener noreferrer"
                            class="mt-7 inline-flex items-center border-t border-gray-100 pt-5 text-sm font-semibold text-red-600 hover:text-red-700">
                            Lihat dokumen <i class="bi bi-arrow-up-right ml-2" aria-hidden="true"></i>
                        </a>
                    </article>
                </div>
            </div>

            {{-- Nota kesepahaman dengan BPS --}}
            <div id="nota-kesepahaman" class="mt-16 scroll-mt-24 md:mt-20">
                <div class="flex flex-wrap items-center gap-4">
                    <h2 class="text-2xl font-bold tracking-tight text-gray-900">Nota Kesepahaman dengan BPS</h2>
                    <span class="hidden h-px flex-1 bg-gray-200 sm:block"></span>
                    <span class="rounded-full bg-red-50 px-3 py-1 text-xs font-semibold text-red-600">2 Dokumen</span>
                </div>
                <p class="mt-2 max-w-3xl text-sm leading-6 text-gray-600">
                    Kerja sama Gubernur Sumatera Selatan dengan Kepala Badan Pusat Statistik Provinsi Sumatera Selatan
                    tentang penyediaan, pemanfaatan, dan pengembangan data/informasi pembangunan daerah menuju Provinsi
                    Sumatera Selatan Satu Data.
                </p>

                <div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-2">
                    <article
                        class="group flex h-full flex-col rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-red-100 hover:shadow-xl md:p-7">
                        <div class="flex items-start justify-between gap-4">
                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-xl bg-red-50 text-xl text-red-600">
                                <i class="bi bi-journal-check" aria-hidden="true"></i>
                            </div>
                            <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600">10</span>
                        </div>
                        <p class="mt-6 text-sm font-semibold uppercase tracking-wider text-red-600">Nota Kesepahaman 2019
                        </p>
                        <h3 class="mt-2 text-xl font-bold text-gray-900">
                            Gubernur Sumatera Selatan &amp; Kepala BPS Provinsi Sumatera Selatan
                        </h3>
                        <p class="mt-2 text-sm font-medium text-gray-500">
                            Tentang Penyediaan, Pemanfaatan, dan Pengembangan Data/Informasi Pembangunan Daerah
                        </p>
                        <p class="mt-5 flex-grow text-sm leading-6 text-gray-600">
                            Kesepakatan awal menuju Provinsi Sumatera Selatan Satu Data, mencakup penyediaan data
                            statistik, pemanfaatan data untuk perencanaan pembangunan, serta pengembangan kapasitas
                            statistik sektoral perangkat daerah.
                        </p>
                        <a href="https://drive.google.com/file/d/1G0PCXkZcv6hLonxTBvyCViLpJlFK8hm-/view?usp=drivesdk"
                            target="_blank" rel="noopener noreferrer"
                            class="mt-7 inline-flex items-center border-t border-gray-100 pt-5 text-sm font-semibold text-red-600 hover:text-red-700">
                            Lihat dokumen <i class="bi bi-arrow-up-right ml-2" aria-hidden="true"></i>
                        </a>
                    </article>

                    <article
                        class="group flex h-full flex-col rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-red-100 hover:shadow-xl md:p-7">
                        <div class="flex items-start justify-between gap-4">
                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-xl bg-red-50 text-xl text-red-600">
                                <i class="bi bi-file-earmark-text" aria-hidden="true"></i>
                            </div>
                            <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600">11</span>
                        </div>
                        <p class="mt-6 text-sm font-semibold uppercase tracking-wider text-red-600">Nota Kesepahaman 2025
                        </p>
                        <h3 class="mt-2 text-xl font-bold text-gray-900">
                            Gubernur Sumatera Selatan &amp; Kepala BPS Provinsi Sumatera Selatan
                        </h3>
                        <p class="mt-2 text-sm font-medium text-gray-500">
                            Tentang Penyediaan, Pemanfaatan, dan Pengembangan Data/Informasi Pembangunan Daerah
                        </p>
                        <p class="mt-5 flex-grow text-sm leading-6 text-gray-600">
                            Pembaruan kerja sama tahun 2025 untuk memperkuat kualitas data statistik sektoral,
                            interoperabilitas data antarperangkat daerah, dan pendampingan teknis BPS dalam mewujudkan
                            Provinsi Sumatera Selatan Satu Data.
                        </p>
                        <a href="https://drive.google.com/file/d/16MRTSeJEVFs4ytcdbfTHoobT_nHU2Y5g/view?usp=drivesdk"
                            target="_blank" rel="noopener noreferrer"
                            class="mt-7 inline-flex items-center border-t border-gray-100 pt-5 text-sm font-semibold text-red-600 hover:text-red-700">
                            Lihat dokumen <i class="bi bi-arrow-up-right ml-2" aria-hidden="true"></i>
                        </a>
                    </article>
                </div>
            </div>
        </div>
    </section>
@endsection
