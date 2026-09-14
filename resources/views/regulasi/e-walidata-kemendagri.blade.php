@extends('layouts.app')

@section('title', 'Dasar Hukum e-Walidata Kemendagri')

@section('content')
    <section class="bg-gradient-to-b from-red-50/70 to-white py-12 md:py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <span
                    class="inline-flex rounded-full bg-red-100 px-4 py-1.5 text-sm font-semibold tracking-wide text-red-700">
                    Regulasi Nasional
                </span>
                <h1 class="mt-5 text-3xl font-bold tracking-tight text-gray-900 md:text-5xl">
                    Dasar Hukum <span class="text-red-600">e-Walidata Kemendagri</span>
                </h1>
                <p class="mt-5 text-base leading-7 text-gray-600 md:text-lg">
                    Landasan penyelenggaraan data pembangunan daerah yang terintegrasi melalui Sistem Informasi
                    Pemerintahan Daerah dan kebijakan Satu Data Indonesia.
                </p>
            </div>

            <div class="mt-10 grid grid-cols-1 gap-6 md:mt-14 lg:grid-cols-2">
                <article
                    class="group flex h-full flex-col rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-red-100 hover:shadow-xl md:p-7">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-red-50 text-xl text-red-600">
                            <i class="bi bi-clipboard-check" aria-hidden="true"></i>
                        </div>
                        <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600">01</span>
                    </div>
                    <p class="mt-6 text-sm font-semibold uppercase tracking-wider text-red-600">Peraturan Menteri Dalam
                        Negeri</p>
                    <h2 class="mt-2 text-xl font-bold text-gray-900">Permendagri Nomor 18 Tahun 2020</h2>
                    <p class="mt-2 text-sm font-medium text-gray-500">Tentang Laporan dan Evaluasi Penyelenggaraan
                        Pemerintahan Daerah</p>
                    <p class="mt-5 flex-grow text-sm leading-6 text-gray-600">
                        Mengatur tata cara penyusunan, penyampaian, dan evaluasi Laporan Penyelenggaraan Pemerintahan
                        Daerah (LPPD) yang datanya dikelola melalui Sistem Informasi Pemerintahan Daerah dan e-Walidata.
                    </p>
                    <a href="https://drive.google.com/file/d/1PbWWqgKDBDorh525uecKaGZD21FGSoCeR/view?usp=drivesdk"
                        target="_blank" rel="noopener noreferrer"
                        class="mt-7 inline-flex items-center border-t border-gray-100 pt-5 text-sm font-semibold text-red-600 hover:text-red-700">
                        Lihat dokumen <i class="bi bi-arrow-up-right ml-2" aria-hidden="true"></i>
                    </a>
                </article>

                <article
                    class="group flex h-full flex-col rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-red-100 hover:shadow-xl md:p-7">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-red-50 text-xl text-red-600">
                            <i class="bi bi-cash-coin" aria-hidden="true"></i>
                        </div>
                        <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600">02</span>
                    </div>
                    <p class="mt-6 text-sm font-semibold uppercase tracking-wider text-red-600">Keputusan Menteri Dalam
                        Negeri</p>
                    <h2 class="mt-2 text-xl font-bold text-gray-900">Kepmendagri Nomor 900.1-2850 Tahun 2025</h2>
                    <p class="mt-2 text-sm font-medium text-gray-500">Tentang Nomenklatur Anggaran e-Walidata dan
                        Pengumpulan Data Statistik Sektoral</p>
                    <p class="mt-5 flex-grow text-sm leading-6 text-gray-600">
                        Mengatur nomenklatur anggaran daerah untuk mendukung penyelenggaraan e-Walidata serta kegiatan
                        pengumpulan data statistik sektoral pada perangkat daerah.
                    </p>
                    <a href="https://drive.google.com/file/d/1PbWWqgKDBDorh525uecKaGZD21FGSoCeR/view?usp=drivesdk"
                        target="_blank" rel="noopener noreferrer"
                        class="mt-7 inline-flex items-center border-t border-gray-100 pt-5 text-sm font-semibold text-red-600 hover:text-red-700">
                        Lihat dokumen <i class="bi bi-arrow-up-right ml-2" aria-hidden="true"></i>
                    </a>
                </article>
            </div>
        </div>
    </section>
@endsection
