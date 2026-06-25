@extends('layouts.app')

@section('content')
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Breadcrumb & Header --}}
            <div class="mb-8">
                <nav class="text-sm font-medium text-gray-500 mb-4" aria-label="Breadcrumb">
                    <ol class="list-none p-0 inline-flex">
                        <li class="flex items-center">
                            <a href="{{ route('home.index') }}" class="hover:text-blue-600 transition-colors">Beranda</a>
                            <i class="bi bi-chevron-right text-xs mx-2"></i>
                        </li>
                        <li class="flex items-center">
                            <a href="{{ route('metadata.show', 1) }}" class="hover:text-blue-600 transition-colors">Metadata
                                {{ Str::title(str_replace('METADATA ', '', $titleData)) }}</a>
                            <i class="bi bi-chevron-right text-xs mx-2"></i>
                        </li>
                        <li class="flex items-center text-gray-700">
                            Detail Metadata
                        </li>
                    </ol>
                </nav>

                <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4 leading-tight">
                    {{ $collectionData['judul_kegiatan'] ?? ($collectionData['nama'] ?? ($collectionData['alias'] ?? '-')) }}
                </h1>

                @if (isset($dataKegiatan))
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ $dataKegiatan }}" target="_blank"
                            class="inline-flex items-center justify-center px-4 py-2 border border-red-500 text-red-600 rounded hover:bg-red-50 transition-colors text-sm font-medium">
                            <i class="bi bi-file-earmark-pdf mr-2"></i> PDF
                        </a>
                        {{-- Assuming Excel export would exist similarly --}}
                        <a href="#" onclick="alert('Export Excel belum tersedia di API'); return false;"
                            class="inline-flex items-center justify-center px-4 py-2 border border-green-500 text-green-600 rounded hover:bg-green-50 transition-colors text-sm font-medium">
                            <i class="bi bi-file-earmark-excel mr-2"></i> Excel
                        </a>
                    </div>
                @endif
            </div>

            <div class="grid lg:grid-cols-12 gap-8 items-start">

                {{-- LEFT SIDEBAR (TABS) - HANYA UNTUK KEGIATAN --}}
                @if ($titleData == 'METADATA KEGIATAN')
                    <div class="lg:col-span-3">
                        <div class="bg-white border border-gray-200 rounded-md overflow-hidden sticky top-6">
                            <ul class="flex flex-col text-sm font-medium text-gray-700" id="metadata-tabs">

                                {{-- Tab 1: Informasi Umum --}}
                                <li>
                                    <button type="button" onclick="switchTab('informasi-umum')" id="tab-informasi-umum"
                                        class="tab-btn w-full text-left px-5 py-3 border-l-4 border-blue-600 bg-blue-50 text-blue-700 hover:bg-blue-50 transition-colors">
                                        Informasi Umum
                                    </button>
                                </li>

                                @if ($titleData == 'METADATA KEGIATAN')
                                    <li>
                                        <button type="button" onclick="switchTab('penyelenggara')" id="tab-penyelenggara"
                                            class="tab-btn w-full text-left px-5 py-3 border-l-4 border-transparent hover:bg-gray-50 hover:text-blue-600 transition-colors border-t border-gray-100">
                                            Penyelenggara
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button" onclick="switchTab('penanggung-jawab')"
                                            id="tab-penanggung-jawab"
                                            class="tab-btn w-full text-left px-5 py-3 border-l-4 border-transparent hover:bg-gray-50 hover:text-blue-600 transition-colors border-t border-gray-100">
                                            Penanggung Jawab
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button" onclick="switchTab('perencanaan')" id="tab-perencanaan"
                                            class="tab-btn w-full text-left px-5 py-3 border-l-4 border-transparent hover:bg-gray-50 hover:text-blue-600 transition-colors border-t border-gray-100">
                                            Perencanaan dan Persiapan
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button" onclick="switchTab('desain')" id="tab-desain"
                                            class="tab-btn w-full text-left px-5 py-3 border-l-4 border-transparent hover:bg-gray-50 hover:text-blue-600 transition-colors border-t border-gray-100">
                                            Desain Kegiatan
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button" onclick="switchTab('pengumpulan-data')"
                                            id="tab-pengumpulan-data"
                                            class="tab-btn w-full text-left px-5 py-3 border-l-4 border-transparent hover:bg-gray-50 hover:text-blue-600 transition-colors border-t border-gray-100">
                                            Pengumpulan Data
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button" onclick="switchTab('pengolahan')" id="tab-pengolahan"
                                            class="tab-btn w-full text-left px-5 py-3 border-l-4 border-transparent hover:bg-gray-50 hover:text-blue-600 transition-colors border-t border-gray-100">
                                            Pengolahan dan Analisis
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button" onclick="switchTab('diseminasi')" id="tab-diseminasi"
                                            class="tab-btn w-full text-left px-5 py-3 border-l-4 border-transparent hover:bg-gray-50 hover:text-blue-600 transition-colors border-t border-gray-100">
                                            Diseminasi Hasil
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button" onclick="switchTab('variabel-kegiatan')"
                                            id="tab-variabel-kegiatab"
                                            class="tab-btn w-full text-left px-5 py-3 border-l-4 border-transparent hover:bg-gray-50 hover:text-blue-600 transition-colors border-t border-gray-100">
                                            Variabel Kegiatan
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button" onclick="switchTab('indikator-kegiatan')"
                                            id="tab-indikator-kegiatab"
                                            class="tab-btn w-full text-left px-5 py-3 border-l-4 border-transparent hover:bg-gray-50 hover:text-blue-600 transition-colors border-t border-gray-100">
                                            Indikator Kegiatan
                                        </button>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                @endif

                {{-- RIGHT CONTENT AREA --}}
                <div
                    class="{{ $titleData == 'METADATA KEGIATAN' ? 'lg:col-span-9' : 'lg:col-span-10 lg:col-start-2' }} bg-white border border-gray-200 rounded-md p-6 lg:p-8 shadow-sm">

                    {{-- TAB 1: INFORMASI UMUM --}}
                    <div id="content-informasi-umum" class="tab-content block">
                        <h3 class="text-xl font-bold text-gray-800 mb-6 border-b pb-2">Informasi Umum</h3>
                        <table class="w-full text-sm text-left">
                            <tbody class="divide-y divide-gray-200">

                                @if ($titleData == 'METADATA KEGIATAN')
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Judul Kegiatan</td>
                                        <td class="py-3 text-gray-900">{{ $collectionData['judul_kegiatan'] ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Tahun</td>
                                        <td class="py-3 text-gray-900">{{ $collectionData['tahun'] ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Cara Pengumpulan Data
                                        </td>
                                        <td class="py-3 text-gray-900">{{ $collectionData['cara_pengumpulan_data'] ?? '-' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Sektor Kegiatan</td>
                                        <td class="py-3 text-gray-900">{{ $collectionData['sektor_kegiatan'] ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Rekomendasi Statistik
                                        </td>
                                        <td class="py-3 text-gray-900">
                                            {{ $collectionData['identitas_rekomendasi'] ?? '-' }}</td>
                                    </tr>
                                @endif

                                @if ($titleData == 'METADATA VARIABEL')
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Nama Variabel</td>
                                        <td class="py-3 text-gray-900">{{ $collectionData['nama'] ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Alias</td>
                                        <td class="py-3 text-gray-900">{{ $collectionData['alias'] ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Definisi</td>
                                        <td class="py-3 text-gray-900">{{ $collectionData['definisi'] ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Konsep</td>
                                        <td class="py-3 text-gray-900">{{ $collectionData['konsep'] ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Referensi Pemilihan</td>
                                        <td class="py-3 text-gray-900">{{ $collectionData['referensi_pemilihan'] ?? '-' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Tipe Data</td>
                                        <td class="py-3 text-gray-900">{{ $collectionData['tipe_data'] ?? '-' }}</td>
                                    </tr>
                                @endif

                                @if ($titleData == 'METADATA INDIKATOR')
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Nama Indikator</td>
                                        <td class="py-3 text-gray-900">{{ $collectionData['nama'] ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Konsep</td>
                                        <td class="py-3 text-gray-900">{{ $collectionData['konsep'] ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Definisi</td>
                                        <td class="py-3 text-gray-900">{{ $collectionData['definisi'] ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Interpretasi</td>
                                        <td class="py-3 text-gray-900">{{ $collectionData['interpretasi'] ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Metode Perhitungan</td>
                                        <td class="py-3 text-gray-900">{{ $collectionData['metode_perhitungan'] ?? '-' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Ukuran</td>
                                        <td class="py-3 text-gray-900">{{ $collectionData['ukuran'] ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Satuan</td>
                                        <td class="py-3 text-gray-900">{{ $collectionData['satuan'] ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Rumus</td>
                                        <td class="py-3 text-gray-900">{{ $collectionData['rumus'] ?? '-' }}</td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>

                    @if ($titleData == 'METADATA KEGIATAN')
                        {{-- TAB 2: PENYELENGGARA --}}
                        <div id="content-penyelenggara" class="tab-content hidden">
                            <h3 class="text-xl font-bold text-gray-800 mb-6 border-b pb-2">Penyelenggara</h3>
                            <table class="w-full text-sm text-left">
                                <tbody class="divide-y divide-gray-200">
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Instansi Penyelenggara
                                        </td>
                                        <td class="py-3 text-gray-900">
                                            {{ $collectionData['i_instansi_penyelanggara'] ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Alamat Lengkap Instansi
                                            Penyelenggara</td>
                                        <td class="py-3 text-gray-900">{{ $collectionData['i_alamat'] ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Telepon</td>
                                        <td class="py-3 text-gray-900">{{ $collectionData['i_telepon'] ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Faksimile</td>
                                        <td class="py-3 text-gray-900">{{ $collectionData['i_faksimile'] ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Email</td>
                                        <td class="py-3 text-gray-900">{{ $collectionData['i_email'] ?? '-' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        {{-- TAB 3: PENANGGUNG JAWAB --}}
                        <div id="content-penanggung-jawab" class="tab-content hidden">
                            <h3 class="text-xl font-bold text-gray-800 mb-6 border-b pb-2">Penanggung Jawab</h3>
                            <table class="w-full text-sm text-left">
                                <tbody class="divide-y divide-gray-200">
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Unit Eselon I</td>
                                        <td class="py-3 text-gray-900">{{ $collectionData['ii_unit_eselon1'] ?? '-' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Unit Eselon II</td>
                                        <td class="py-3 text-gray-900">{{ $collectionData['ii_unit_eselon2'] ?? '-' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Nama Jabatan (Penanggung
                                            Jawab Teknis)</td>
                                        <td class="py-3 text-gray-900">{{ $collectionData['ii_pj_jabatan'] ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Alamat</td>
                                        <td class="py-3 text-gray-900">{{ $collectionData['ii_pj_alamat'] ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Telepon</td>
                                        <td class="py-3 text-gray-900">{{ $collectionData['ii_pj_telepon'] ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Faksimile</td>
                                        <td class="py-3 text-gray-900">{{ $collectionData['ii_pj_faksimile'] ?? '-' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Email</td>
                                        <td class="py-3 text-gray-900">{{ $collectionData['ii_pj_email'] ?? '-' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        {{-- TAB 4: PERENCANAAN --}}
                        <div id="content-perencanaan" class="tab-content hidden">
                            <h3 class="text-xl font-bold text-gray-800 mb-6 border-b pb-2">Perencanaan dan Persiapan</h3>
                            <table class="w-full text-sm text-left">
                                <tbody class="divide-y divide-gray-200">
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Latar Belakang Kegiatan
                                        </td>
                                        <td class="py-3 text-gray-900">
                                            {{ $collectionData['iii_latar_belakang_kegiatan'] ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Tujuan Kegiatan</td>
                                        <td class="py-3 text-gray-900">{{ $collectionData['iii_tujuan_kegiatan'] ?? '-' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Rencana Jadwal
                                            Perencanaan</td>
                                        <td class="py-3 text-gray-900">
                                            {{ $collectionData['iii_jadwal_perencanaan_kegiatan'] ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Rencana Jadwal Desain
                                        </td>
                                        <td class="py-3 text-gray-900">{{ $collectionData['iii_jadwal_desain'] ?? '-' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Rencana Jadwal
                                            Pengumpulan Data</td>
                                        <td class="py-3 text-gray-900">
                                            {{ $collectionData['iii_jadwal_pengumpulan_data'] ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Rencana Jadwal
                                            Pengolahan Data</td>
                                        <td class="py-3 text-gray-900">
                                            {{ $collectionData['iii_jadwal_pengolahan_data'] ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Rencana Jadwal Analisis
                                        </td>
                                        <td class="py-3 text-gray-900">{{ $collectionData['iii_jadwal_analisis'] ?? '-' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Rencana Jadwal
                                            Diseminasi Hasil</td>
                                        <td class="py-3 text-gray-900">
                                            {{ $collectionData['iii_jadwal_diseminasi_hasil'] ?? '-' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        {{-- TAB 5: DESAIN --}}
                        <div id="content-desain" class="tab-content hidden">
                            <h3 class="text-xl font-bold text-gray-800 mb-6 border-b pb-2">Desain Kegiatan</h3>
                            <table class="w-full text-sm text-left">
                                <tbody class="divide-y divide-gray-200">
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Kegiatan Ini Dilakukan
                                        </td>
                                        <td class="py-3 text-gray-900">
                                            {{ $collectionData['iv_kegiatan_ini_dilakukan'] ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Frekuensi
                                            Penyelenggaraan</td>
                                        <td class="py-3 text-gray-900">
                                            {{ $collectionData['iv_frekuensi_penyelanggara'] ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Tipe Pengumpulan Data
                                        </td>
                                        <td class="py-3 text-gray-900">
                                            {{ $collectionData['iv_tipe_pengumpulan_data'] ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Cakupan Wilayah
                                            Pengumpulan Data</td>
                                        <td class="py-3 text-gray-900">
                                            {{ $collectionData['iv_cakupan_wilayah_pengumpulan_data'] ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Metode Pengumpulan Data
                                        </td>
                                        <td class="py-3 text-gray-900">
                                            {{ $collectionData['iv_metode_pengumpulan_data'] ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Sarana Pengumpulan Data
                                        </td>
                                        <td class="py-3 text-gray-900">
                                            {{ $collectionData['iv_sarana_pengumpulan_data'] ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Unit Pengumpulan Data
                                        </td>
                                        <td class="py-3 text-gray-900">
                                            {{ $collectionData['iv_unit_pengumpulan_data'] ?? '-' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        {{-- TAB 6: PENGUMPULAN DATA --}}
                        <div id="content-pengumpulan-data" class="tab-content hidden">
                            <h3 class="text-xl font-bold text-gray-800 mb-6 border-b pb-2">Pengumpulan Data</h3>
                            <table class="w-full text-sm text-left">
                                <tbody class="divide-y divide-gray-200">
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Apakah Melakukan Uji
                                            Coba</td>
                                        <td class="py-3 text-gray-900">
                                            {{ $collectionData['vi_apakah_melakukan_uji_coba'] ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Metode Pemeriksaan
                                            Kualitas Pengumpulan Data</td>
                                        <td class="py-3 text-gray-900">
                                            {{ $collectionData['vi_metode_pemeriksaan_kualitas_pengumpulan_data'] ?? '-' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Petugas Pengumpulan Data
                                        </td>
                                        <td class="py-3 text-gray-900">
                                            {{ $collectionData['vi_petugas_pengumpulan_data'] ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Persyaratan Pendidikan
                                            Terendah Petugas</td>
                                        <td class="py-3 text-gray-900">
                                            {{ $collectionData['vi_persyaratan_pendidikan_terendah_petugas_pengumpulan_data'] ?? '-' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Jumlah Petugas
                                            Supervisor</td>
                                        <td class="py-3 text-gray-900">
                                            {{ $collectionData['vi_jumlah_petugas_supervisor'] ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Jumlah Petugas
                                            Enumerator</td>
                                        <td class="py-3 text-gray-900">
                                            {{ $collectionData['vi_jumlah_petugas_enumerator'] ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Apakah Melakukan
                                            Pelatihan Petugas</td>
                                        <td class="py-3 text-gray-900">
                                            {{ $collectionData['vi_apakah_melakukan_pelatihan_petugas'] ?? '-' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        {{-- TAB 7: PENGOLAHAN --}}
                        <div id="content-pengolahan" class="tab-content hidden">
                            <h3 class="text-xl font-bold text-gray-800 mb-6 border-b pb-2">Pengolahan dan Analisis</h3>
                            <table class="w-full text-sm text-left">
                                <tbody class="divide-y divide-gray-200">
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Tahapan Pengolahan Data
                                        </td>
                                        <td class="py-3 text-gray-900">
                                            {{ $collectionData['vii_tahapan_pengolahan_data'] ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Metode Analisis</td>
                                        <td class="py-3 text-gray-900">{{ $collectionData['vii_metode_analisis'] ?? '-' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Unit Analisis</td>
                                        <td class="py-3 text-gray-900">{{ $collectionData['vii_unit_analisis'] ?? '-' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Tingkat Penyajian Hasil
                                            Analisis</td>
                                        <td class="py-3 text-gray-900">
                                            {{ $collectionData['vii_tingkat_penyajian_hasil_analisis'] ?? '-' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        {{-- TAB 8: DISEMINASI --}}
                        <div id="content-diseminasi" class="tab-content hidden">
                            <h3 class="text-xl font-bold text-gray-800 mb-6 border-b pb-2">Diseminasi Hasil</h3>
                            <table class="w-full text-sm text-left">
                                <tbody class="divide-y divide-gray-200">
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Ketersediaan Produk
                                            Tercetak</td>
                                        <td class="py-3 text-gray-900">
                                            {{ $collectionData['viii_ketersediaan_produk_tercetak'] ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Ketersediaan Produk
                                            Digital</td>
                                        <td class="py-3 text-gray-900">
                                            {{ $collectionData['viii_ketersediaan_produk_digital'] ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 w-1/3 text-gray-500 font-medium align-top">Ketersediaan Produk
                                            Mikrodata</td>
                                        <td class="py-3 text-gray-900">
                                            {{ $collectionData['viii_ketersediaan_produk_mikrodata'] ?? '-' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        {{-- TAB 9 : Variabel Kegiatan --}}
                        <div id="content-variabel-kegiatan" class="tab-content hidden">
                            <h3 class="text-xl font-bold text-gray-800 mb-6 border-b pb-2">Variabel Kegiatan</h3>
                            <table class="w-full text-sm text-left">
                                <tbody class="divide-y divide-gray-200">
                                    @foreach ($collectionData2 as $coll)
                                        <tr>
                                            <td class="py-3 w-1/3 text-gray-500 font-medium align-top">
                                                <a href="{{ route('metadata.detail', ['jenis' => '2', 'id' => $coll['id']]) }}"
                                                    target="_blank" class="text-blue-600 hover:underline">
                                                    {{ $coll['konsep'][0] }}
                                                </a>
                                            </td>
                                            <td class="py-3 text-gray-900">{{ $coll['definisi'] ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{-- TAB 10: Indikator Kegiatan --}}
                        <div id="content-indikator-kegiatan" class="tab-content hidden">
                            <h3 class="text-xl font-bold text-gray-800 mb-6 border-b pb-2">Indikator Kegiatan</h3>
                            <table class="w-full text-sm text-left">
                                <tbody class="divide-y divide-gray-200">
                                    @foreach ($collectionData3 as $coll)
                                        <tr>
                                            <td class="py-3 w-1/3 text-gray-500 font-medium align-top">
                                                <a href="{{ route('metadata.detail', ['jenis' => '3', 'id' => $coll['id']]) }}"
                                                    target="_blank" class="text-blue-600 hover:underline">
                                                    {{ $coll['konsep'][0] }}
                                                </a>
                                            </td>
                                            <td class="py-3 text-gray-900">{{ $coll['definisi'] ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                </div>

            </div>

        </div>
    </section>

    {{-- Script for Tab Switching --}}
    <script>
        function switchTab(tabId) {
            // Hide all contents
            document.querySelectorAll('.tab-content').forEach(el => {
                el.classList.add('hidden');
                el.classList.remove('block');
            });

            // Show the selected content
            const selectedContent = document.getElementById('content-' + tabId);
            if (selectedContent) {
                selectedContent.classList.remove('hidden');
                selectedContent.classList.add('block');
            }

            // Reset all tab buttons
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('border-blue-600', 'bg-blue-50', 'text-blue-700');
                btn.classList.add('border-transparent', 'text-gray-700');
            });

            // Highlight active tab button
            const activeBtn = document.getElementById('tab-' + tabId);
            if (activeBtn) {
                activeBtn.classList.remove('border-transparent', 'text-gray-700');
                activeBtn.classList.add('border-blue-600', 'bg-blue-50', 'text-blue-700');
            }
        }
    </script>

    <script type="text/javascript">
        function openCity(evt, cityName) {
            // Declare all variables
            var i, tabcontent, tablinks;

            // Get all elements with class="tabcontent" and hide them
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            // Get all elements with class="tablinks" and remove the class "active"
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            // Show the current tab, and add an "active" class to the link that opened the tab
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }
        document.getElementById("defaultOpen").click();

        // Fungsi Helper: Menghilangkan tag HTML dan membersihkan karakter aneh
        function cleanText(text) {
            if (!text) return "-";
            // Hilangkan HTML tags dan decode entity seperti &amp;
            let decoded = text.replace(/<[^>]*>?/gm, '');
            return decoded.trim();
        }
        // Fungsi Helper: Mengubah string JSON menjadi teks biasa (untuk konsep/definisi)
        function parseJsonField(field) {
            try {
                let parsed = JSON.parse(field);
                return Array.isArray(parsed) ? parsed.join(", ") : parsed;
            } catch (e) {
                return field || "-";
            }
        }
        const apiUrl = '/metadata/kegiatan/export?id=70a663fef4bdfa26674a01ee1d941516be89bf4fb54b1f5602d38273299f8acf';

        function formatJadwal(jsonString) {
            try {
                // Jika data kosong atau null
                if (!jsonString || jsonString === "[]") return "-";

                let data = JSON.parse(jsonString);

                // Pastikan data adalah array dan memiliki isi
                if (Array.isArray(data) && data.length > 0) {
                    const awal = data[0].awal || "";
                    const akhir = data[0].akhir || "";

                    if (!awal && !akhir) return "-";
                    return `${awal} s.d. ${akhir}`;
                }
            } catch (e) {
                console.error("Error parsing jadwal:", e);
            }
            return "-"; // Fallback jika terjadi error atau data tidak sesuai
        }

        function appendVariables(targetArray, jsonString) {
            targetArray.push(["3.4", "Variabel (Karakteristik) yang Dikumpulkan"]);
            targetArray.push(["", "Nama Variabel", "Konsep", "Definisi", "Referensi Waktu"]);

            try {
                if (!jsonString || jsonString === "[]") {
                    targetArray.push(["", "-", "-", "-", "-"]);
                    return;
                }

                const variables = JSON.parse(jsonString);

                if (Array.isArray(variables)) {
                    variables.forEach(v => {
                        targetArray.push([
                            "",
                            v.nama || "-",
                            parseJsonField(v.konsep), // Menggunakan helper parseJsonField sebelumnya
                            cleanText(v.definisi), // Menggunakan helper cleanText sebelumnya
                            v.referensi_waktu || "-"
                        ]);
                    });
                }
            } catch (e) {
                console.error("Error parsing variabel:", e);
                targetArray.push(["", "Gagal memuat data variabel", "", "", ""]);
            }
        }

        function appendVariables2(targetArray, jsonString) {
            targetArray.push(["3.4", "Variabel (Karakteristik) yang Dikumpulkan"]);

            try {
                if (!jsonString || jsonString === "[]") {
                    targetArray.push(["", "-"]);
                    return;
                }

                const variables = JSON.parse(jsonString);

                if (Array.isArray(variables)) {
                    variables.forEach(v => {
                        targetArray.push([
                            "", // Kolom No kosong
                            {
                                // Kolom Informasi dan Keterangan digabung untuk menampilkan detail variabel
                                content: `Nama: ${v.nama}\nKonsep: ${parseJsonField(v.konsep)}\nDefinisi: ${cleanText(v.definisi)}\nReferensi Waktu: ${v.referensi_waktu}`,
                                colSpan: 2,
                                styles: {
                                    fontSize: 9,
                                    cellPadding: 3
                                }
                            }
                        ]);
                    });
                }
            } catch (e) {
                console.error("Error parsing variabel:", e);
                targetArray.push(["", "Gagal memuat data variabel", "", "", ""]);
            }
        }

        function appendWilayah(targetArray, cakupan, jsonString) {
            // Baris Judul Poin 4.4
            targetArray.push(["4.4", "Cakupan Wilayah Pengumpulan Data", cakupan.replace(/_/g, ' ')]);

            try {
                if (cakupan === "SELURUH_WILAYAH_INDONESIA") {
                    targetArray.push(["", "Seluruh Wilayah Indonesia"]);
                    return;
                }

                if (cakupan === "SEBAGIAN_WILAYAH_INDONESIA") {
                    const wilayah = JSON.parse(jsonString || "[]");

                    if (Array.isArray(wilayah) && wilayah.length > 0) {
                        // Header tabel wilayah (cukup sekali saja di luar loop)
                        targetArray.push(["4.5", "Daftar Wilayah (Provinsi)", "Daftar Wilayah (Kabupaten/Kota)"]);

                        wilayah.forEach(v => {
                            targetArray.push([
                                "",
                                cleanText(v.nama_provinsi) || "-",
                                cleanText(v.nama_kabupaten_kota) || "-"
                            ]);
                        });
                    } else {
                        targetArray.push(["", "Data wilayah sebagian tidak ditemukan"]);
                    }
                }
            } catch (e) {
                console.error("Error parsing wilayah:", e);
                targetArray.push(["", "Gagal memuat detail wilayah"]);
            }
        }

        function formatValueDomain(jsonString) {
            try {
                if (!jsonString || jsonString === "[]") return "-";
                const data = JSON.parse(jsonString);
                if (Array.isArray(data)) {
                    // Map setiap objek menjadi string "kode. nilai"
                    return data.map(item => `${item.kode}. ${item.nilai}`).join("; ");
                }
            } catch (e) {
                console.error("Error parsing value domain:", e);
            }
            return "-";
        }

        function parseLatex(latexString) {
            if (!latexString) return "-";

            try {
                let clean = latexString;

                // 1. Hapus tag begin dan end equation
                clean = clean.replace(/\\begin\{equation\*?\}/g, '');
                clean = clean.replace(/\\end\{equation\*?\}/g, '');

                // 2. Hapus perintah \text{...} tapi ambil isinya
                clean = clean.replace(/\\text\{([^}]*)\}/g, '$1');

                // 3. Hapus backslash yang tersisa (seperti \, atau \quad)
                clean = clean.replace(/\\[a-zA-Z]+/g, ' ');

                // 4. Bersihkan spasi berlebih
                return clean.trim();
            } catch (e) {
                console.error("Error parsing LaTeX:", e);
                return latexString; // Jika gagal, kembalikan string asli
            }
        }

        function parseDynamicArray(jsonString) {
            try {
                if (!jsonString || jsonString === "[]") return "-";

                const data = JSON.parse(jsonString);

                if (Array.isArray(data)) {
                    return data.map(item => {
                        let detail = [];

                        // Cek tipe json1 (sumber_publikasi - Array)
                        if (item.sumber_publikasi && Array.isArray(item.sumber_publikasi)) {
                            detail = item.sumber_publikasi;
                        }
                        // Cek tipe json2 (kegiatan_penghasil - Array)
                        else if (item.kegiatan_penghasil && Array.isArray(item.kegiatan_penghasil)) {
                            detail = item.kegiatan_penghasil;
                        }
                        // Cek tipe json3 (sumber - String tunggal)
                        else if (item.sumber) {
                            detail = [];
                        }

                        // Gabungkan nama dengan detailnya jika ada
                        if (detail.length > 0) {
                            return `${item.nama} (${detail.join(", ")})`;
                        }

                        return item.nama;
                    }).join("; ");
                }
            } catch (e) {
                console.error("Error dynamic parsing:", e);
            }
            return "-";
        }
        async function exportMetadata(id) {
            // 1. Ambil elemen UI
            const btn = document.getElementById('btn-export');
            const btnText = document.getElementById('btn-text');
            const spinner = document.getElementById('loading-spinner');

            // 2. Tampilkan Loading State
            btn.disabled = true; // Cegah klik ganda
            btnText.innerText = "Generating Excel...";
            spinner.style.display = "inline-block";

            try {
                const response = await fetch(apiUrl);
                const data = await response.json();
                const keg = data.kegiatan;
                const wb = XLSX.utils.book_new();

                let ws_keg_data = [
                    ["METADATA STATISTIK KEGIATAN"],
                    [],
                    ["Judul Kegiatan", "", keg.judul_kegiatan],
                    ["Tahun Kegiatan", "", keg.tahun],
                    ["Cara Pengumpulan Data", "", keg.cara_pengumpulan_data],
                    ["Sektor Kegiatan", "", keg.sektor_kegiatan],
                    ["Jenis Kegiatan Statistik", "", keg.jenis_statistik],
                    ["Identitas Rekomendasi", "", keg.identitas_rekomendasi],
                    ["I. PENYELENGGARA"],
                    ["1.1", "Instansi Penyelenggara", keg.i_instansi_penyelanggara],
                    ["1.2", "Alamat", cleanText(keg.i_alamat)],
                    ["", "Telepon", keg.i_telepon],
                    ["", "Faksimile", keg.i_faksimile],
                    ["", "Email", keg.i_email],
                    ["II. PENANGGUNG JAWAB"],
                    ["2.1", "Unit Eselon Penanggung Jawab"],
                    ["", "Eselon 1", keg.ii_unit_eselon1],
                    ["", "Eselon 2", keg.ii_unit_eselon2],
                    ["2.2", "Penanggung Jawab Teknis"],
                    ["", "Nama", keg.ii_pj_nama],
                    ["", "Jabatan", keg.ii_pj_jabatan],
                    ["", "Alamat", keg.ii_pj_alamat],
                    ["", "Telepon", keg.ii_pj_telepon],
                    ["", "Faksimile", keg.ii_pj_faksimile],
                    ["", "Email", keg.ii_pj_email],
                    ["III. PERENCANAAN DAN PERSIAPAN"],
                    ["3.1", "Latar Belakang Kegiatan", keg.iii_latar_belakang_kegiatan],
                    ["3.2", "Tujuan Kegiatan", keg.iii_tujuan_kegiatan],
                    ["3.3", "Jadwal Kegiatan"],
                    ["", "Perencanaan Kegiatan", formatJadwal(keg.iii_jadwal_perencanaan_kegiatan)],
                    ["", "Desain", formatJadwal(keg.iii_jadwal_desain)],
                    ["", "Pengumpulan Data", formatJadwal(keg.iii_jadwal_pengumpulan_data)],
                    ["", "Pengolahan Data", formatJadwal(keg.iii_jadwal_pengolahan_data)],
                    ["", "Analisis", formatJadwal(keg.iii_jadwal_analisis)],
                    ["", "Diseminasi Hasil", formatJadwal(keg.iii_jadwal_diseminasi_hasil)],
                    ["", "Evaluasi", formatJadwal(keg.iii_jadwal_evaluasi)],
                ];
                appendVariables(ws_keg_data, keg.iii_variabel_yang_dikumpulkan);
                ws_keg_data.push(
                    ["IV. DESAIN KEGIATAN"],
                    ["4.1", "Kegiatan ini dilakukan", keg.iv_kegiatan_ini_dilakukan],
                    ["4.2", "Frekuensi Penyelenggaraan", keg.iv_frekuensi_penyelanggara],
                    ["4.3", "Tipe Pengumpulan Data", keg.iv_tipe_pengumpulan_data],
                );
                appendWilayah(ws_keg_data, keg.iv_cakupan_wilayah_pengumpulan_data, keg
                    .iv_sebagian_cakupan_wilayah_pengumpulan_data);
                ws_keg_data.push(
                    ["4.6", "Metode Pengumpulan Data", keg.iv_metode_pengumpulan_data],
                    ["4.7", "Sarana Pengumpulan Data", keg.iv_sarana_pengumpulan_data],
                    ["4.8", "Unit Pengumpulan Data", keg.iv_unit_pengumpulan_data],
                );
                if (keg.cara_pengumpulan_data === "SURVEI") {
                    ws_keg_data.push(
                        ["V. DESAIN SAMPEL (khusus survei)"],
                        ["5.1", "Jenis Rancangan Sampel", keg.v_jenis_rancangan_sampel],
                        ["5.2", "Metode Pemilihan Sampel Tahap Terakhir", keg
                            .v_metode_pemilihan_sampel_tahap_terakhir
                        ],
                        ["5.3", "Metode yang Digunakan", keg.v_metode_yang_digunakan],
                        ["5.4", "Kerangka Sampel Tahap Terakhir", keg.v_kerangka_sampel_tahap_terakhir],
                        ["5.5", "Fraksi Sampel Keseluruhan", keg.v_fraksi_sampel_keseluruhan],
                        ["5.6", "Nilai Perkiraan Sampling Error Variabel Utama", keg
                            .v_nilai_perkiraan_sampling_error_variabel_utama
                        ],
                        ["5.7", "Unit Sampel", keg.v_unit_sampel],
                        ["5.8", "Unit Observasi", keg.v_unit_observasi],
                    );
                }
                ws_keg_data.push(
                    ["VI. PENGUMPULAN DATA"],
                    ["6.1", "Apakah Melakukan Uji Coba (Pilot Survey)?", keg.vi_apakah_melakukan_uji_coba],
                    ["6.2", "Metode Pemeriksaan Kualitas Pengumpulan Data", keg
                        .vi_metode_pemeriksaan_kualitas_pengumpulan_data
                    ],
                    ["6.3", "Apakah Melakukan Penyesuaian Nonrespon?", keg
                        .vi_apakah_melakukan_penyesuaian_nonrespon
                    ],
                    ["6.4", "Petugas Pengumpulan Data", keg.vi_petugas_pengumpulan_data],
                    ["6.5", "Persyaratan Pendidikan Terendah Petugas Pengumpulan Data", keg
                        .vi_persyaratan_pendidikan_terendah_petugas_pengumpulan_data
                    ],
                    ["6.6", "Jumlah Petugas"],
                    ["", "Supervisor/penyelia/pengawas", keg.vi_jumlah_petugas_supervisor],
                    ["", "Pengumpul data/enumerator", keg.vi_jumlah_petugas_enumerator],
                    ["6.7", "Apakah Melakukan Pelatihan Petugas?", keg.vi_apakah_melakukan_pelatihan_petugas],
                    ["VII. PENGOLAHAN DAN ANALISIS"],
                    ["7.1", "Tahapan Pengolahan Data", keg.vii_tahapan_pengolahan_data],
                    ["7.2", "Metode Analisis", keg.vii_metode_analisis],
                    ["7.3", "Unit Analisis", keg.vii_unit_analisis],
                    ["7.4", "Tingkat Penyajian Hasil Analisis", keg.vii_tingkat_penyajian_hasil_analisis],
                    ["VIII. DISEMINASI HASIL"],
                    ["8.1", "Produk Kegiatan yang Tersedia untuk Umum"],
                    ["", "Tercetak (hardcopy)", keg.viii_ketersediaan_produk_tercetak],
                    ["", "Digital (softcopy)", keg.viii_ketersediaan_produk_digital],
                    ["", "Data Mikro", keg.viii_ketersediaan_produk_mikrodata],
                    ["8.2", "Rencana Rilis Produk Kegiatan"],
                    ["", "Tercetak (hardcopy)", parseJsonField(keg.viii_rencana_jadwal_rilis_produk_tercetak)],
                    ["", "Digital (softcopy)", parseJsonField(keg.viii_rencana_jadwal_rilis_produk_digital)],
                    ["", "Data Mikro", parseJsonField(keg.viii_rencana_jadwal_rilis_produk_mikrodata)],
                );
                const ws_keg = XLSX.utils.aoa_to_sheet(ws_keg_data);
                XLSX.utils.book_append_sheet(wb, ws_keg, "MS-Keg");

                // --- SHEET 2: MS-Var ---
                let var_header = [
                    ["Nama Variabel", "Alias", "Konsep", "Definisi", "Referensi Pemilihan", "Referensi Waktu",
                        "Tipe Data", "Klasifikasi Isian", "Aturan Validasi", "Kalimat Pertanyaan",
                        "Apakah variabel dapat diakses umum?"
                    ]
                ];
                let var_rows = data.msvars.map(v => [
                    v.nama,
                    v.alias,
                    parseJsonField(v.konsep),
                    cleanText(v.definisi),
                    parseJsonField(v.referensi_pemilihan),
                    v.referensi_waktu,
                    v.tipe_data,
                    formatValueDomain(v.value_domain),
                    parseJsonField(v.aturan_validasi),
                    cleanText(v.kalimat_pertanyaan),
                    v.apakah_variabel_bisa_diakses_umum,
                ]);
                const ws_var = XLSX.utils.aoa_to_sheet(var_header.concat(var_rows));
                XLSX.utils.book_append_sheet(wb, ws_var, "MS-Var");

                // --- SHEET 3: MS-Ind ---
                let ind_header = [
                    ["Nama Indikator", "Konsep", "Definisi", "Interpretasi", "Metode Perhitungan", "Rumus",
                        "Ukuran", "Satuan", "Klasifikasi Penyajian", "Apakah Indikator Komposit",
                        "Indikator Pembangun", "Variabel Pembangun", "Level Estimasi",
                        "Apakah indikator dapat diakses umum"
                    ]
                ];
                let ind_rows = data.msinds.map(i => [
                    i.nama,
                    parseJsonField(i.konsep),
                    cleanText(i.definisi),
                    cleanText(i.interpretasi),
                    cleanText(i.metode_perhitungan),
                    parseLatex(i.rumus),
                    i.ukuran,
                    i.satuan,
                    parseDynamicArray(i.variabel_disaggregasi),
                    i.apakah_indikator_komposit,
                    parseDynamicArray(i.indikator_pembangun),
                    parseDynamicArray(i.variabel_pembangun),
                    parseJsonField(i.level_estimasi),
                    i.apakah_indikator_bisa_diakses_umum
                ]);
                const ws_ind = XLSX.utils.aoa_to_sheet(ind_header.concat(ind_rows));
                XLSX.utils.book_append_sheet(wb, ws_ind, "MS-Ind");

                // Generate File
                XLSX.writeFile(wb, `Export_Metadata_${id}.xlsx`);
            } catch (error) {
                console.error("Export Error:", error);
            } finally {
                // 3. Kembalikan ke keadaan semula (Akan selalu dijalankan)
                btn.disabled = false;
                btnText.innerText = "Export ke Excel";
                spinner.style.display = "none";
            }
        }
        async function exportToPdf(id) {
            // Inisialisasi Elemen UI
            const btn = document.getElementById('btn-pdf');
            const btnText = document.getElementById('pdf-text');
            const spinner = document.getElementById('pdf-spinner');
            const {
                jsPDF
            } = window.jspdf;
            // Inisialisasi awal (Default Portrait A4)
            const doc = new jsPDF('p', 'mm', 'a4');
            // Aktifkan Status Loading
            btn.disabled = true;
            btnText.innerText = "Generating PDF...";
            spinner.style.display = "inline-block";

            try {

                // Ambil data dari API
                const response = await fetch(apiUrl);
                if (!response.ok) throw new Error("Gagal mengambil data dari server");

                const data = await response.json();
                const keg = data.kegiatan;

                // --- FUNGSI HEADER/FOOTER GLOBAL ---
                const drawHeaderFooter = (d, title) => {
                    const pageSize = d.internal.pageSize;
                    const pageHeight = pageSize.height ? pageSize.height : pageSize.getHeight();
                    const pageWidth = pageSize.width ? pageSize.width : pageSize.getWidth();
                    const pageNumber = d.internal.getNumberOfPages();

                    d.setFontSize(10);
                    d.setFont("helvetica", "bold");
                    d.setTextColor(0);
                    d.text("Badan Pusat Statistik", 14, 15); // Kiri
                    d.text(title, pageWidth - 14, 15, {
                        align: "right"
                    }); // Kanan (MS-Keg / MS-Var / MS-Ind)

                    d.setFontSize(8);
                    d.setFont("helvetica", "italic");
                    d.setTextColor(100);
                    d.text("Dokumen ini diunduh dari aplikasi Metadata Statistik https://sirusa.web.bps.go.id/metadata/",
                        14, pageHeight - 10);
                    d.text("Halaman " + pageNumber, pageWidth - 14, pageHeight - 10, {
                        align: "right"
                    });
                };

                // --- 1. SECTION MS-Keg (PORTRAIT) ---
                const pageSizeP = doc.internal.pageSize;
                const pageWidthP = pageSizeP.width ? pageSizeP.width : pageSizeP.getWidth();

                // Tambahkan Judul Tengah
                doc.setFontSize(12);
                doc.setFont("helvetica", "bold");
                doc.text("METADATA STATISTIK KEGIATAN", pageWidthP / 2, 22, {
                    align: "center"
                });


                let ws_keg_data = [
                    [{
                        content: "HALAMAN AWAL",
                        colSpan: 3,
                        styles: {
                            halign: 'center',
                            fillColor: [41, 128, 186],
                            textColor: [255, 255, 255]
                        }
                    }],
                    ["", "Judul Kegiatan", keg.judul_kegiatan],
                    ["", "Tahun Kegiatan", keg.tahun],
                    ["", "Cara Pengumpulan Data", keg.cara_pengumpulan_data],
                    ["", "Sektor Kegiatan", keg.sektor_kegiatan],
                    ["", "Jenis Kegiatan Statistik", keg.jenis_statistik],
                    ["", "Identitas Rekomendasi", keg.identitas_rekomendasi],
                    [{
                        content: "I. PENYELENGGARA",
                        colSpan: 3,
                        styles: {
                            halign: 'center',
                            fillColor: [41, 128, 186],
                            textColor: [255, 255, 255]
                        }
                    }],
                    ["1.1", "Instansi Penyelenggara", keg.i_instansi_penyelanggara],
                    ["1.2", "Alamat", cleanText(keg.i_alamat)],
                    ["", "Telepon", keg.i_telepon],
                    ["", "Faksimile", keg.i_faksimile],
                    ["", "Email", keg.i_email],
                    [{
                        content: "II. PENANGGUNG JAWAB",
                        colSpan: 3,
                        styles: {
                            halign: 'center',
                            fillColor: [41, 128, 186],
                            textColor: [255, 255, 255]
                        }
                    }],
                    ["2.1", "Unit Eselon Penanggung Jawab"],
                    ["", "Eselon 1", keg.ii_unit_eselon1],
                    ["", "Eselon 2", keg.ii_unit_eselon2],
                    ["2.2", "Penanggung Jawab Teknis"],
                    ["", "Nama", keg.ii_pj_nama],
                    ["", "Jabatan", keg.ii_pj_jabatan],
                    ["", "Alamat", keg.ii_pj_alamat],
                    ["", "Telepon", keg.ii_pj_telepon],
                    ["", "Faksimile", keg.ii_pj_faksimile],
                    ["", "Email", keg.ii_pj_email],
                    [{
                        content: "III. PERENCANAAN DAN PERSIAPAN",
                        colSpan: 3,
                        styles: {
                            halign: 'center',
                            fillColor: [41, 128, 186],
                            textColor: [255, 255, 255]
                        }
                    }],
                    ["3.1", "Latar Belakang Kegiatan", keg.iii_latar_belakang_kegiatan],
                    ["3.2", "Tujuan Kegiatan", keg.iii_tujuan_kegiatan],
                    ["3.3", "Jadwal Kegiatan"],
                    ["", "Perencanaan Kegiatan", formatJadwal(keg.iii_jadwal_perencanaan_kegiatan)],
                    ["", "Desain", formatJadwal(keg.iii_jadwal_desain)],
                    ["", "Pengumpulan Data", formatJadwal(keg.iii_jadwal_pengumpulan_data)],
                    ["", "Pengolahan Data", formatJadwal(keg.iii_jadwal_pengolahan_data)],
                    ["", "Analisis", formatJadwal(keg.iii_jadwal_analisis)],
                    ["", "Diseminasi Hasil", formatJadwal(keg.iii_jadwal_diseminasi_hasil)],
                    ["", "Evaluasi", formatJadwal(keg.iii_jadwal_evaluasi)],
                ];
                appendVariables2(ws_keg_data, keg.iii_variabel_yang_dikumpulkan);
                ws_keg_data.push(
                    [{
                        content: "IV. DESAIN KEGIATAN",
                        colSpan: 3,
                        styles: {
                            halign: 'center',
                            fillColor: [41, 128, 186],
                            textColor: [255, 255, 255]
                        }
                    }],
                    ["4.1", "Kegiatan ini dilakukan", keg.iv_kegiatan_ini_dilakukan],
                    ["4.2", "Frekuensi Penyelenggaraan", keg.iv_frekuensi_penyelanggara],
                    ["4.3", "Tipe Pengumpulan Data", keg.iv_tipe_pengumpulan_data],
                );
                appendWilayah(ws_keg_data, keg.iv_cakupan_wilayah_pengumpulan_data, keg
                    .iv_sebagian_cakupan_wilayah_pengumpulan_data);
                ws_keg_data.push(
                    ["4.6", "Metode Pengumpulan Data", keg.iv_metode_pengumpulan_data],
                    ["4.7", "Sarana Pengumpulan Data", keg.iv_sarana_pengumpulan_data],
                    ["4.8", "Unit Pengumpulan Data", keg.iv_unit_pengumpulan_data],
                );
                if (keg.cara_pengumpulan_data === "SURVEI") {
                    ws_keg_data.push(
                        [{
                            content: "V. DESAIN SAMPEL (khusus survei)",
                            colSpan: 3,
                            styles: {
                                halign: 'center',
                                fillColor: [41, 128, 186],
                                textColor: [255, 255, 255]
                            }
                        }],
                        ["5.1", "Jenis Rancangan Sampel", keg.v_jenis_rancangan_sampel],
                        ["5.2", "Metode Pemilihan Sampel Tahap Terakhir", keg
                            .v_metode_pemilihan_sampel_tahap_terakhir
                        ],
                        ["5.3", "Metode yang Digunakan", keg.v_metode_yang_digunakan],
                        ["5.4", "Kerangka Sampel Tahap Terakhir", keg.v_kerangka_sampel_tahap_terakhir],
                        ["5.5", "Fraksi Sampel Keseluruhan", keg.v_fraksi_sampel_keseluruhan],
                        ["5.6", "Nilai Perkiraan Sampling Error Variabel Utama", keg
                            .v_nilai_perkiraan_sampling_error_variabel_utama
                        ],
                        ["5.7", "Unit Sampel", keg.v_unit_sampel],
                        ["5.8", "Unit Observasi", keg.v_unit_observasi],
                    );
                }
                ws_keg_data.push(
                    [{
                        content: "VI. PENGUMPULAN DATA",
                        colSpan: 3,
                        styles: {
                            halign: 'center',
                            fillColor: [41, 128, 186],
                            textColor: [255, 255, 255]
                        }
                    }],
                    ["6.1", "Apakah Melakukan Uji Coba (Pilot Survey)?", keg.vi_apakah_melakukan_uji_coba],
                    ["6.2", "Metode Pemeriksaan Kualitas Pengumpulan Data", keg
                        .vi_metode_pemeriksaan_kualitas_pengumpulan_data
                    ],
                    ["6.3", "Apakah Melakukan Penyesuaian Nonrespon?", keg
                        .vi_apakah_melakukan_penyesuaian_nonrespon
                    ],
                    ["6.4", "Petugas Pengumpulan Data", keg.vi_petugas_pengumpulan_data],
                    ["6.5", "Persyaratan Pendidikan Terendah Petugas Pengumpulan Data", keg
                        .vi_persyaratan_pendidikan_terendah_petugas_pengumpulan_data
                    ],
                    ["6.6", "Jumlah Petugas"],
                    ["", "Supervisor/penyelia/pengawas", keg.vi_jumlah_petugas_supervisor],
                    ["", "Pengumpul data/enumerator", keg.vi_jumlah_petugas_enumerator],
                    ["6.7", "Apakah Melakukan Pelatihan Petugas?", keg.vi_apakah_melakukan_pelatihan_petugas],
                    [{
                        content: "VII. PENGOLAHAN DAN ANALISIS",
                        colSpan: 3,
                        styles: {
                            halign: 'center',
                            fillColor: [41, 128, 186],
                            textColor: [255, 255, 255]
                        }
                    }],
                    ["7.1", "Tahapan Pengolahan Data", keg.vii_tahapan_pengolahan_data],
                    ["7.2", "Metode Analisis", keg.vii_metode_analisis],
                    ["7.3", "Unit Analisis", keg.vii_unit_analisis],
                    ["7.4", "Tingkat Penyajian Hasil Analisis", keg.vii_tingkat_penyajian_hasil_analisis],
                    [{
                        content: "VIII. DISEMINASI HASIL",
                        colSpan: 3,
                        styles: {
                            halign: 'center',
                            fillColor: [41, 128, 186],
                            textColor: [255, 255, 255]
                        }
                    }],
                    ["8.1", "Produk Kegiatan yang Tersedia untuk Umum"],
                    ["", "Tercetak (hardcopy)", keg.viii_ketersediaan_produk_tercetak],
                    ["", "Digital (softcopy)", keg.viii_ketersediaan_produk_digital],
                    ["", "Data Mikro", keg.viii_ketersediaan_produk_mikrodata],
                    ["8.2", "Rencana Rilis Produk Kegiatan"],
                    ["", "Tercetak (hardcopy)", parseJsonField(keg.viii_rencana_jadwal_rilis_produk_tercetak)],
                    ["", "Digital (softcopy)", parseJsonField(keg.viii_rencana_jadwal_rilis_produk_digital)],
                    ["", "Data Mikro", parseJsonField(keg.viii_rencana_jadwal_rilis_produk_mikrodata)],
                );

                doc.autoTable({
                    startY: 30,
                    head: [],
                    body: ws_keg_data,
                    margin: {
                        top: 25,
                        bottom: 20
                    },
                    didDrawPage: (d) => drawHeaderFooter(doc, "MS-Keg")
                });

                // --- 2. SECTION MS-Var (PINDAH KE LANDSCAPE) ---
                doc.addPage('a4', 'l'); // 'l' adalah Landscape
                doc.autoTable({
                    startY: 25,
                    head: [
                        ["Nama Variabel", "Alias", "Konsep", "Definisi", "Referensi Pemilihan",
                            "Referensi Waktu", "Tipe Data", "Klasifikasi Isian", "Aturan Validasi",
                            "Kalimat Pertanyaan", "Apakah variabel dapat diakses umum?"
                        ]
                    ],
                    body: data.msvars.map(v => [
                        v.nama,
                        v.alias,
                        parseJsonField(v.konsep),
                        cleanText(v.definisi),
                        parseJsonField(v.referensi_pemilihan),
                        v.referensi_waktu,
                        v.tipe_data,
                        formatValueDomain(v.value_domain),
                        parseJsonField(v.aturan_validasi),
                        cleanText(v.kalimat_pertanyaan),
                        v.apakah_variabel_bisa_diakses_umum,
                    ]),
                    margin: {
                        top: 25,
                        bottom: 20
                    },
                    styles: {
                        fontSize: 7,
                        cellPadding: 3
                    },
                    didDrawPage: (d) => drawHeaderFooter(doc, "MS-Var")
                });

                // --- 3. SECTION MS-Ind (TETAP LANDSCAPE) ---
                doc.addPage('a4', 'l');
                doc.autoTable({
                    startY: 25,
                    head: [
                        ["Nama Indikator", "Konsep", "Definisi", "Interpretasi", "Metode Perhitungan",
                            "Rumus", "Ukuran", "Satuan", "Klasifikasi Penyajian",
                            "Apakah Indikator Komposit", "Indikator Pembangun", "Variabel Pembangun",
                            "Level Estimasi", "Apakah indikator dapat diakses umum"
                        ]
                    ],
                    body: data.msinds.map(i => [
                        i.nama,
                        parseJsonField(i.konsep),
                        cleanText(i.definisi),
                        cleanText(i.interpretasi),
                        cleanText(i.metode_perhitungan),
                        parseLatex(i.rumus),
                        i.ukuran,
                        i.satuan,
                        parseDynamicArray(i.variabel_disaggregasi),
                        i.apakah_indikator_komposit,
                        parseDynamicArray(i.indikator_pembangun),
                        parseDynamicArray(i.variabel_pembangun),
                        parseJsonField(i.level_estimasi),
                        i.apakah_indikator_bisa_diakses_umum
                    ]),
                    margin: {
                        top: 25,
                        bottom: 20
                    },
                    styles: {
                        fontSize: 7,
                        cellPadding: 3
                    },
                    didDrawPage: (d) => drawHeaderFooter(doc, "MS-Ind")
                });

                // Simpan File
                doc.save(`Export_Metadata_${id}.pdf`);

                // Notifikasi Sukses
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'PDF telah berhasil diunduh.',
                    timer: 2000,
                    showConfirmButton: false
                });

            } catch (error) {
                console.error("PDF Export Error:", error);
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal Export',
                    text: error.message
                });
            } finally {
                // 7. Matikan Status Loading (Selalu dijalankan)
                btn.disabled = false;
                btnText.innerText = "Export ke PDF";
                spinner.style.display = "none";
            }
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const btnExport = document.getElementById('btn-export');
            if (btnExport) {
                btnExport.addEventListener('click', function() {
                    // Mengambil data-id
                    const idEncrypted = this.getAttribute('data-id');
                    exportMetadata(idEncrypted);
                });
            }
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const btnPdf = document.getElementById('btn-pdf');
            if (btnPdf) {
                btnPdf.addEventListener('click', function() {
                    // Mengambil data-id
                    const idEncrypted = this.getAttribute('data-id');
                    exportToPdf(idEncrypted);
                });
            }
        });
    </script>
@endsection
