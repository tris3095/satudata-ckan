@extends('layouts.app')

@section('title', 'profil')

@section('content')
    <section class="hero max-w-7xl mx-auto py-8">
        <div class="px-3 md:px-5 relative">
            <h1 class="text-2xl md:text-4xl font-bold text-red-600">Profil <span class="text-black">Satu Data</span></h1>
            <p class="text-lg md:text-2xl">Provinsi Sumatera Selatan</p>
        </div>
    </section>

    <section class="max-w-7xl mx-auto lg:py-8">
        <div class="px-3 md:px-5">
            <div class="relative w-full h-full rounded-lg overflow-hidden grid grid-cols-1 md:grid-cols-2">
                <img class="w-full h-full bg-center" src="{{ asset('images/logo-satudata.png') }}">
            </div>
            <div class="relative text-justify">
                <div class="mt-6 text-base md:text-lg/7">
                    “Satu Data Sumsel adalah kebijakan tata kelola Data pemerintah daerah untuk menghasilkan Data yang akurat, mutakhir, terpadu, dan dapat dipertanggungjawabkan, serta mudah diakses dan dibagipakaikan antar Instansi Pusat dan Daerah melalui pemenuhan Standar Data, Metadata, Interoperabilitas Data, dan menggunakan Kode Referensi dan Data Induk. Kebijakan ini sesuai dalam Peraturan Presiden No. 39 Tahun 2019 tentang Satu Data Indonesia."
                </div>
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto py-8">
        <div class="section-content px-3 md:px-5">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white shadow rounded-lg overflow-hidden flex flex-col">
                    <div class="p-4 flex flex-col flex-grow">
                        <h5 class="text-lg font-semibold mb-4">Buku Pedoman Penyelenggaraan Statistik Sektoral 2024
                        </h5>
                        <a href="{{ asset('images/Buku Pedoman Penyelenggaraan Statistik Sektoral 2024.pdf') }}"
                            class="mt-auto inline-block border border-red-600 text-red-600 px-3 py-2 rounded text-sm hover:bg-red-600 hover:text-white transition">Download
                        </a>
                    </div>
                </div>

                <div class="bg-white shadow rounded-lg overflow-hidden flex flex-col">
                    <div class="p-4 flex flex-col flex-grow">
                        <h5 class="text-lg font-semibold mb-4">Perpres No 39 Tahun 2019
                        </h5>
                        <a href="{{ asset('images/Perpres_Nomor_39_Tahun_2019.pdf') }}"
                            class="mt-auto inline-block border border-red-600 text-red-600 px-3 py-2 rounded text-sm hover:bg-red-600 hover:text-white transition">Download
                        </a>
                    </div>
                </div>

                <div class="bg-white shadow rounded-lg overflow-hidden flex flex-col">
                    <div class="p-4 flex flex-col flex-grow">
                        <h5 class="text-lg font-semibold mb-4">Pergub Sumsel No 4 Tahun 2021
                        </h5>
                        <a href="{{ asset('images/pergub-no4-2021.pdf') }}"
                            class="mt-auto inline-block border border-red-600 text-red-600 px-3 py-2 rounded text-sm hover:bg-red-600 hover:text-white transition">Download
                        </a>
                    </div>
                </div>

                <div class="bg-white shadow rounded-lg overflow-hidden flex flex-col">
                    <div class="p-4 flex flex-col flex-grow">
                        <h5 class="text-lg font-semibold mb-4">SK Gubernur Forum Data Provinsi 2021
                        </h5>
                        <a href="{{ asset('images/SK Forum Data.pdf') }}"
                            class="mt-auto inline-block border border-red-600 text-red-600 px-3 py-2 rounded text-sm hover:bg-red-600 hover:text-white transition">Download
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
@endsection