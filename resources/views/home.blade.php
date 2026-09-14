@extends('layouts.app')
@section('title', 'Home')

@push('plugin-style')
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        .group-card {
            transition: all 0.25s ease-in-out;
        }

        .group-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.12);
        }

        @keyframes marquee {
            from {
                transform: translateX(0);
            }

            to {
                transform: translateX(-50%);
            }
        }

        .animate-marquee {
            animation: marquee 35s linear infinite;
        }

        .regional-logo-marquee img {
            width: auto !important;
            height: 80px !important;
        }

        @keyframes regional-logo-scroll {
            from {
                transform: translateX(0);
            }

            to {
                transform: translateX(calc(-50% - 1.25rem));
            }
        }

        .regional-marquee-track {
            animation: regional-logo-scroll 45s linear infinite;
            will-change: transform;
        }

        .regional-logo-set {
            flex-shrink: 0;
        }

        .regional-logo-marquee:hover .regional-marquee-track {
            animation-play-state: paused;
        }

        @media (prefers-reduced-motion: reduce) {
            .regional-marquee-track {
                animation-play-state: paused;
            }
        }

        .logo-20 {
            @apply flex items-center justify-center h-[20px] flex-shrink-0;
        }

        .logo-20 img {
            @apply h-full w-auto object-contain grayscale transition duration-300 hover:grayscale-0 hover:scale-110;
        }

        @theme {
            --animate-marquee: marquee 35s linear infinite;

            @keyframes marquee {
                from {
                    transform: translateX(0);
                }

                to {
                    transform: translateX(-50%);
                }
            }
        }

        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(-50%);
        }


        .animate-marquee {
            animation: marquee 35s linear infinite;
        }
    </style>
@endpush

@section('content')
    {{-- <div x-data="{ open: true }">

        <!-- Overlay -->
        <div x-show="open" x-transition.opacity class="fixed inset-0 bg-black/30 z-40">
        </div>

        <!-- Modal Wrapper -->
        <div x-show="open" x-transition class="fixed  -->
            <div class="bg-white w-full max-w-md rounded-lg shadow-xl
                   flex flex-col overflow-hidden">

                <!-- Header -->
                <div class="flex items-center justify-between px-4 py-2 bg-gray-100 border-b">
                    <h3 class="text-sm font-semibold text-gray-700">
                        Informasi Dataset
                    </h3>
                    <button @click="open = false" class="text-gray-500 hover:text-gray-800 text-lg leading-none">
                        ×
                    </button>
                </div>

                <!-- Body -->
                <div class="p-3 text-sm text-gray-700 max-h-[45vh] overflow-y-auto">
                    <img src="{{ asset('storage/infographic/indikator.jpg') }}" class="w-full object-contain rounded">
                </div>

                <!-- Footer -->
                <div class="flex justify-end px-4 py-2 bg-gray-50 border-t">
                    <button @click="open = false" class="px-3 py-1.5 text-xs border rounded hover:bg-gray-100">
                        Tutup
                    </button>
                </div>

            </div>
        </div>
    </div> --}}

    <section class="mx-0" x-data="{
        active: 0,
        total: {{ $banner->isNotEmpty() ? $banner->count() : 1 }},
        init() {
            setInterval(() => { this.active = (this.active + 1) % this.total }, 5000)
        }
    }">
        <div class="inset-0 relative w-full h-full">
            @if ($banner->isNotEmpty())
                @foreach ($banner as $index => $item)
                    {{-- <div class="absolute inset-0 w-full h-full {{ $loop->first ? '' : 'hidden' }}">
                        <img src="{{ $item->image_url }}" class="w-full h-full object-cover" />
                    </div> --}}
                    <div x-show="active === 0" x-transition.opacity class=" inset-0">
                        <video class="w-full h-auto object-cover" autoplay muted loop playsinline>
                            <source src="{{ asset('storage/banner/banner.mp4') }}" type="video/mp4">
                            Browser Anda tidak mendukung video.
                        </video>
                        {{-- <img src="{{ $item->image_url }}" class="w-full h-full bg-cover" /> --}}
                    </div>
                @endforeach
            @else
                <div x-show="active === 0" x-transition.opacity class=" inset-0">
                    <video class="w-full h-auto object-cover" autoplay muted loop playsinline>
                        <source src="{{ asset('storage/banner/banner.mp4') }}" type="video/mp4">
                        Browser Anda tidak mendukung video.
                    </video>
                    {{-- <img src="{{ asset('images/satu-data.jpeg') }}" class="w-full h-full bg-center bg-cover p-0" /> --}}
                </div>
            @endif

            @if ($banner->isNotEmpty())
                <button @click="active = active === 0 ? total - 1 : active - 1"
                    class="absolute left-3 top-1/2 -translate-y-1/2 bg-black/40 hover:bg-black/60 text-white p-3 rounded-full">
                    <i class="bi bi-chevron-left"></i>
                </button>
                <button @click="active = (active + 1) % total"
                    class="absolute right-3 top-1/2 -translate-y-1/2 bg-black/40 hover:bg-black/60 text-white p-3 rounded-full">
                    <i class="bi bi-chevron-right"></i>
                </button>
            @endif
        </div>

        @if ($banner->isNotEmpty())
            <div class="flex gap-3 justify-center mt-4">
                <template x-for="index in total">
                    <button @click="active = index - 1" :class="active === index - 1 ? 'bg-blue-600' : 'bg-white/50'"
                        class="w-3 h-3 rounded-full border border-white">
                    </button>
                </template>
            </div>
        @endif
    </section>
    {{-- <div class="overflow-hidden bg-gray-100 border-t border-b">
        <div class="whitespace-nowrap text-red-700 font-semibold py-2 animate-marquee-delay"> Hubungi HELP CENTER Whatsapp
            0812-6463-3386 Pusat Bantuan Layanan Data Statistik Sektoral Provinsi Sumatera Selatan
        </div>
    </div> --}}

    <div class="regional-logo-marquee w-full overflow-hidden py-6">
        <div class="relative">

            <div class="regional-marquee-track flex w-max gap-10">

                {{-- Set pertama --}}
                <div id="regionalLogoSource" class="regional-logo-set flex items-center gap-10">

                    <a href="http://satudata.okukab.go.id" target="_blank" rel="noopener noreferrer"
                        class="flex shrink-0 items-center justify-center transition duration-300 hover:scale-110">
                        <img src="{{ asset('/storage/lambangdaerah//XpAtpzVEPvPKg0LRt2T7fD7vzFL9w5Z0BxQ9pdC5.png') }}"
                            class="h-[60px] w-[50px] object-contain" alt="Logo OKU">
                    </a>

                    <a href="http://portal-data.kaboki.go.id" target="_blank" rel="noopener noreferrer"
                        class="flex shrink-0 items-center justify-center transition duration-300 hover:scale-110">
                        <img src="{{ asset('/storage/lambangdaerah//qBgXbz9TZCr6dEXkmEKNnQUQR644yTT9Wt2b4A55.png') }}"
                            class="h-[60px] w-[50px] object-contain" alt="Logo OKI">
                    </a>

                    <a href="http://satudata.muaraenimkab.go.id" target="_blank" rel="noopener noreferrer"
                        class="flex shrink-0 items-center justify-center transition duration-300 hover:scale-110">
                        <img src="{{ asset('/storage/lambangdaerah//c8znEbK0XdM0u3PMPm0I4XqL4QcW9lJrGEkJ6xON.png') }}"
                            class="h-[60px] w-[50px] object-contain" alt="Logo Muara Enim">
                    </a>

                    <a href="http://satudata.lahatkab.go.id" target="_blank" rel="noopener noreferrer"
                        class="flex shrink-0 items-center justify-center transition duration-300 hover:scale-110">
                        <img src="{{ asset('/storage/lambangdaerah//scJuX9tPcpUgMfB66tOS1zTqFH3sYAkQmRFUrqDh.png') }}"
                            class="h-[60px] w-[50px] object-contain" alt="Logo Lahat">
                    </a>

                    <a href="http://satudata.musirawaskab.go.id" target="_blank" rel="noopener noreferrer"
                        class="flex shrink-0 items-center justify-center transition duration-300 hover:scale-110">
                        <img src="{{ asset('/storage/lambangdaerah//dEmLAC0SijuoOuJQEA3uD8ZCa61mUofSc5cdyDIu.png') }}"
                            class="h-[60px] w-[50px] object-contain" alt="Logo Musi Rawas">
                    </a>

                    <a href="https://satudata.mubakab.go.id/" target="_blank" rel="noopener noreferrer"
                        class="flex shrink-0 items-center justify-center transition duration-300 hover:scale-110">
                        <img src="{{ asset('/storage/lambangdaerah//t5fcRimArVW8FvdsZjz0qeeOBuUfvn6Re7SIaktv.png') }}"
                            class="h-[60px] w-[50px] object-contain" alt="Logo Musi Banyuasin">
                    </a>

                    <a href="https://banyuasinkab.go.id/" target="_blank" rel="noopener noreferrer"
                        class="flex shrink-0 items-center justify-center transition duration-300 hover:scale-110">
                        <img src="{{ asset('/storage/lambangdaerah//vb7IcENdi5tVGJvkp7SH5afVokdYNmAa7z0uFEPe.png') }}"
                            class="h-[60px] w-[50px] object-contain" alt="Logo Banyuasin">
                    </a>

                    <a href="https://satudata.okutimurkab.go.id" target="_blank" rel="noopener noreferrer"
                        class="flex shrink-0 items-center justify-center transition duration-300 hover:scale-110">
                        <img src="{{ asset('/storage/lambangdaerah//WeZ6PedRNAdshbHUK4Zr4u1RGPKVvQKsdsKa8kwW.png') }}"
                            class="h-[60px] w-[50px] object-contain" alt="Logo OKU Timur">
                    </a>

                    <a href="https://satudata.okuselatankab.go.id" target="_blank" rel="noopener noreferrer"
                        class="flex shrink-0 items-center justify-center transition duration-300 hover:scale-110">
                        <img src="{{ asset('/storage/lambangdaerah//mQ5WIRCkEpbNMXeO8Fu8coHwdu5gye6oGiRmwiV1.png') }}"
                            class="h-[60px] w-[50px] object-contain" alt="Logo OKU Selatan">
                    </a>

                    <a href="http://satudata.oganilirkab.go.id" target="_blank" rel="noopener noreferrer"
                        class="flex shrink-0 items-center justify-center transition duration-300 hover:scale-110">
                        <img src="{{ asset('/storage/lambangdaerah//7GyzCcKTbkvvNPk7FG3wE6WNuSqWy4qu19esUr9Q.png') }}"
                            class="h-[60px] w-[50px] object-contain" alt="Logo Ogan Ilir">
                    </a>

                    <a href="https://bankdata.bappedaempatlawang.info" target="_blank" rel="noopener noreferrer"
                        class="flex shrink-0 items-center justify-center transition duration-300 hover:scale-110">
                        <img src="{{ asset('/storage/lambangdaerah//PmtaoXmeTcoaGZRes4DvBcCWjqyoIFMHZMS06mct.png') }}"
                            class="h-[60px] w-[50px] object-contain" alt="Logo Empat Lawang">
                    </a>

                    <a href="https://satudata.palikab.go.id" target="_blank" rel="noopener noreferrer"
                        class="flex shrink-0 items-center justify-center transition duration-300 hover:scale-110">
                        <img src="{{ asset('/storage/lambangdaerah//KljTWZJMvxsFrb3B2LQF38lnj1IsGiOusf4x3Gw2.png') }}"
                            class="h-[60px] w-[50px] object-contain" alt="Logo">
                    </a>

                    <a href="https://satudata.muratarakab.go.id" target="_blank" rel="noopener noreferrer"
                        class="flex shrink-0 items-center justify-center transition duration-300 hover:scale-110">
                        <img src="{{ asset('/storage/lambangdaerah//bBgImqwgCvyLwObYV92GDvupBhoHPYUntulr0HCr.png') }}"
                            class="h-[60px] w-[50px] object-contain" alt="Logo Muratara">
                    </a>

                    <a href="http://satudata.palembang.go.id" target="_blank" rel="noopener noreferrer"
                        class="flex shrink-0 items-center justify-center transition duration-300 hover:scale-110">
                        <img src="{{ asset('/storage/lambangdaerah//oIFpGbA0B6zB9AGctEjDYvZLMNdP2bmRFMW4Bej2.png') }}"
                            class="h-[60px] w-[50px] object-contain" alt="Logo Palembang">
                    </a>

                    <a href="http://satudata.pagaralamkota.go.id" target="_blank" rel="noopener noreferrer"
                        class="flex shrink-0 items-center justify-center transition duration-300 hover:scale-110">
                        <img src="{{ asset('/storage/lambangdaerah//dl5KT7EhjuAcUjhexp6MklvHHqJVpRHxDDSbS4x0.png') }}"
                            class="h-[60px] w-[50px] object-contain" alt="Logo Pagar Alam">
                    </a>

                    <a href="https://ssc.lubuklinggaukota.go.id" target="_blank" rel="noopener noreferrer"
                        class="flex shrink-0 items-center justify-center transition duration-300 hover:scale-110">
                        <img src="{{ asset('/storage/lambangdaerah//R3CISULoOMdUZv5aZpdCpaBwC8neJSojvH8TULIC.png') }}"
                            class="h-[60px] w-[50px] object-contain" alt="Logo Lubuklinggau">
                    </a>

                    <a href="https://satudata.kotaprabumulih.go.id/new/badan-statistik" target="_blank"
                        rel="noopener noreferrer"
                        class="flex shrink-0 items-center justify-center transition duration-300 hover:scale-110">
                        <img src="{{ asset('/storage/lambangdaerah//tJOKobzYkSFKZ3qPk70qErcP4YBp6lyNu0A5ljle.png') }}"
                            class="h-[60px] w-[50px] object-contain" alt="Logo Prabumulih">
                    </a>

                </div>

                {{-- Duplikasi agar animasi infinite tidak putus --}}
                <div id="regionalLogoClone" class="regional-logo-set flex items-center gap-10" aria-hidden="true">

                    <a href="#" class="flex shrink-0 items-center justify-center">
                        <img src="{{ asset('/storage/lambangdaerah//XpAtpzVEPvPKg0LRt2T7fD7vzFL9w5Z0BxQ9pdC5.png') }}"
                            class="h-[60px] w-[50px] object-contain" alt="">
                    </a>

                    <a href="#" class="flex shrink-0 items-center justify-center">
                        <img src="{{ asset('/storage/lambangdaerah//qBgXbz9TZCr6dEXkmEKNnQUQR644yTT9Wt2b4A55.png') }}"
                            class="h-[60px] w-[50px] object-contain" alt="">
                    </a>

                    <a href="#" class="flex shrink-0 items-center justify-center">
                        <img src="{{ asset('/storage/lambangdaerah//c8znEbK0XdM0u3PMPm0I4XqL4QcW9lJrGEkJ6xON.png') }}"
                            class="h-[60px] w-[50px] object-contain" alt="">
                    </a>

                    {{-- lanjutkan copy semua logo dari set pertama --}}

                </div>

            </div>

        </div>
    </div>
    <script>
        (() => {
            const source = document.getElementById('regionalLogoSource');
            const clone = document.getElementById('regionalLogoClone');

            if (!source || !clone) return;

            clone.innerHTML = source.innerHTML;
            clone.querySelectorAll('a').forEach(link => link.setAttribute('tabindex', '-1'));
            clone.querySelectorAll('img').forEach(image => image.setAttribute('alt', ''));
        })();
    </script>



    <div class="mx-auto">
        <section class="max-w-7xl mx-auto mt-10 px-4">
            <div class="flex justify-between items-center mb-6">
                {{-- <h2 class="text-3xl font-bold"> <span class="text-red-600"> </h2> <a
                    href="{{ route('infographics.index') }}"
                    class="px-4 py-2 border rounded-xl flex items-center gap-2 hover:text-white hover:border-white hover:bg-red-600 transition">
                    Lihat Semua <i class="bi bi-arrow-right"></i> </a> --}}
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">

                <div class="bg-white shadow rounded-xl overflow-hidden hover:shadow-xl transition-all"> <a
                        href="javascript:;">
                        <div class="h-full w-full overflow-hidden"> <img
                                src="{{ asset('storage/infographic/magang.jpeg') }}" class="w-full h-full object-cover"
                                alt="Indikator" /> </div>

                    </a> </div>
                <div class="bg-white shadow rounded-xl overflow-hidden hover:shadow-xl transition-all"> <a
                        href="javascript:;">
                        <div class="h-full w-full overflow-hidden"> <img
                                src="{{ asset('storage/infographic/2033.jpeg') }}" class="w-full h-full object-cover"
                                alt="Indikator" /> </div>

                    </a> </div>

                <div class="bg-white shadow rounded-xl overflow-hidden hover:shadow-xl transition-all"> <a
                        href="javascript:;">
                        <div class="h-full w-full overflow-hidden"> <img
                                src="{{ asset('storage/infographic/babb2.jpeg') }}" class="w-full h-full object-cover"
                                alt="Help Center" /> </div>

                    </a> </div>

                <div class="bg-white shadow rounded-xl overflow-hidden hover:shadow-xl transition-all"> <a
                        href="javascript:;">
                        <div class="h-full w-full overflow-hidden"> <img
                                src="{{ asset('storage/infographic/babb.jpeg') }}" class="w-full h-full object-cover"
                                alt="Indikator" /> </div>

                    </a> </div>


            </div>

        </section>
        <section class="max-w-7xl mx-auto mt-10 px-4">
            <div class="text-center mb-10">
                <h2 class="text-3xl font-bold"> <span class="text-red-600">Topik </span>Data </h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                @foreach ($groups as $group)
                    <a href="{{ route('group.show', $group['name']) }}">
                        <div
                            class="group-card flex items-center gap-4 p-6 bg-white rounded-xl shadow hover:shadow-md transition">
                            <div class="p-3 bg-red-100 rounded-lg text-red-600 text-2xl"> <i
                                    class="{{ group_icon($group['name']) }}"></i> </div>
                            <h3 class="text-lg font-semibold">
                                {{ $group['title'] ?? ($group['display_name'] ?? $group['name']) }} </h3>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
        <section id="link" class="py-4 overflow-hidden">
            <div class="max-w-7xl mx-auto px-4">

                <div
                    class="flex items-center gap-8 animate-marquee
                    hover:[animation-play-state:paused]">

                    <a href="https://bappenas.go.id/" target="_blank" class="flex-shrink-0">
                        <img src="https://data.go.id/images/bappenas.png" class="h-[50px] w-auto object-contain logo-20"
                            alt="">
                    </a>

                    <a href="https://data.go.id/" target="_blank" class="flex-shrink-0">
                        <img src="{{ asset('storage/link') }}/link-1.png" class="h-[50px] w-auto object-contain logo-20"
                            alt="">
                    </a>

                    <a href="https://tanahair.indonesia.go.id/portal-web/" target="_blank" class="flex-shrink-0">
                        <img src="https://tanahair.indonesia.go.id/portal-web/static/images/logobig.png"
                            class="h-[50px] w-auto object-contain logo-20" alt="Ina Geoportal">
                    </a>

                    <a href="https://www.kemendagri.go.id/" target="_blank" class="flex-shrink-0">
                        <img src="{{ asset('storage/link') }}/link-2.png" class="h-[50px] w-auto object-contain logo-20"
                            alt="">
                    </a>

                    <a href="https://www.komdigi.go.id/" target="_blank" class="flex-shrink-0">
                        <img src="{{ asset('storage/link') }}/komdigi.png" class="h-[50px] w-auto object-contain logo-20"
                            alt="">
                    </a>

                    <a href="https://sumselprov.go.id/" target="_blank" class="flex-shrink-0">
                        <img src="{{ asset('storage/link') }}/link-4.png" class="h-[50px] w-auto object-contain logo-20"
                            alt="Sumselprov">
                    </a>

                    <a href="https://sumsel.bps.go.id/" target="_blank" class="flex-shrink-0">
                        <img src="{{ asset('storage/link') }}/link-5.png" class="h-[50px] w-auto object-contain logo-20"
                            alt="">
                    </a>

                    <a href="http://songket.sumselprov.go.id/" target="_blank" class="flex-shrink-0">
                        <img src="{{ asset('storage/link') }}/songket3.png"
                            class="h-[50px] w-auto object-contain logo-20" alt="Songket">
                    </a>

                    <a href="https://giwang.sumselprov.go.id/" target="_blank" class="flex-shrink-0">
                        <img src="{{ asset('storage/link') }}/giwang.svg" class="h-[50px] w-auto object-contain logo-20"
                            alt="Giwang">
                    </a>


                    <a href="https://svelte-descan.vercel.app/" target="_blank" class="flex-shrink-0">
                        <img src="https://svelte-descan.vercel.app/images/logo/logofont.png"
                            class="h-[50px] w-auto object-contain  logo-20" alt="Desa Bumi Sriwijaya">
                    </a>
                    <a href="https://esakip.sumselprov.go.id/" target="_blank" class="flex-shrink-0">
                        <img src="{{ asset('storage/link') }}/sakip.png" class="h-[50px] w-auto object-contain logo-20"
                            alt="esakip">
                    </a>
                    <a href="https://ampera.sumselprov.go.id/" target="_blank" class="flex-shrink-0">
                        <img src="{{ asset('storage/link') }}/ampera.png" class="h-[50px] w-auto object-contain logo-20"
                            alt="Ampera">
                    </a>
                </div>
            </div>
        </section>

        {{-- ========================= --}} {{-- GEOPORTAL SUMSEL SECTION --}} {{-- ========================= --}}
        @if (!empty($records))
            <section class="max-w-7xl mx-auto mt-10 px-4">
                <div class="flex justify-between items-center mb-10">
                    <h2 class="text-3xl font-bold"> <span class="text-red-600">Geo</span>spasial </h2><a
                        href="{{ route('geospatial.index') }}"
                        class="px-4 py-2 border rounded-xl flex items-center gap-2 hover:text-white hover:border-white hover:bg-red-600 transition">
                        Lihat Semua <i class="bi bi-arrow-right"></i> </a>
                </div> <!-- Grid Card -->
                <div id="recordGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                    @foreach ($records as $item)
                        <div class="bg-white shadow rounded-lg overflow-hidden card-item justify-center mb-4">
                            <!-- Thumbnail -->
                            @if ($item['thumbnail'])
                                <img src="{{ $item['thumbnail'] }}" class="rounded-full object-cover"
                                    style="width: 120px; height: 120px;" />
                            @else
                                <div class="w-full h-24 flex items-center justify-center bg-gray-700 text-white text-3xl">
                                    {{ $item['org_initial'] }} </div>
                            @endif
                            <div class="p-5">
                                <h2 class="text-xl font-semibold text-gray-800 mb-2">
                                    {{ $item['title'] ?? 'Tidak ada judul' }}
                                </h2>
                                <p class="text-sm text-gray-500 mb-3"> <strong>Sumber:</strong>
                                    {{ $item['organization'] ?? 'Tidak diketahui' }} </p> <a
                                    href="https://geoportal.sumselprov.go.id/main/katalog" target="_blank"
                                    class="inline-block bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                                    Lihat
                                    Detail </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif
        <section class="max-w-7xl mx-auto mt-10 px-4">
            <div class="flex justify-between items-center mb-10">
                <h2 class="text-3xl font-bold"> <span class="text-red-600">Berita</span> Terkini </h2> <a
                    href="{{ route('news.index') }}"
                    class="px-4 py-2 border rounded-xl flex items-center gap-2 hover:text-white hover:border-white hover:bg-red-600 transition">
                    Lihat Semua <i class="bi bi-arrow-right"></i> </a>
            </div>
            <div class="relative">
                <div id="news-slider" class="grid grid-cols-1 md:grid-cols-3 gap-6 snap-x snap-mandatory pb-4">
                    @foreach ($news as $item)
                        <a href="{{ route('detail.news', $item['slug']) }}"
                            class="bg-white shadow rounded-xl hover:shadow-xl hover:-translate-y-1 transition-all flex flex-col">
                            <div class="h-48 w-full overflow-hidden rounded-t-xl"> <img src="{{ $item['filegambar'] }}"
                                    class="w-full h-full object-cover" onerror="this.src='/default-news.png'" /> </div>
                            <div class="p-4 flex-1 flex flex-col">
                                <p class="text-sm text-gray-500"> {{ $item['tgl'] }} </p>
                                <h3 class="text-lg font-semibold mt-1 line-clamp-2"> {{ $item['judul'] }} </h3>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
        <section class="max-w-7xl mx-auto mt-10 px-4">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-bold"> <span class="text-red-600">Info</span>grafis </h2> <a
                    href="{{ route('infographics.index') }}"
                    class="px-4 py-2 border rounded-xl flex items-center gap-2 hover:text-white hover:border-white hover:bg-red-600 transition">
                    Lihat Semua <i class="bi bi-arrow-right"></i> </a>
            </div>
            @if ($infographics->isEmpty())
                <p class="text-gray-500">No infographics available.</p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ($infographics as $item)
                        <div class="bg-white shadow rounded-xl overflow-hidden hover:shadow-xl transition-all"> <a
                                href="{{ route('infographics.index') }}">
                                <div class="h-48 w-full overflow-hidden"> <img src="{{ $item->image_url }}"
                                        class="w-full h-full object-cover" alt="{{ $item->title }}" /> </div>
                                <div class="p-4">
                                    <h3 class="font-semibold text-lg line-clamp-2"> {{ $item->title }} </h3>
                                    <p class="text-sm text-gray-500 mt-2">
                                        {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }} </p>
                                </div>
                            </a> </div>
                    @endforeach
                </div>
            @endif
        </section>
    </div>
@endsection

@push('custom-scripts')
    {{-- <script>
            const items = document.querySelectorAll(".card-item");
            const perPage = 6;
            let currentPage = 1;

            function showPage(page) {
                const start = (page - 1) * perPage;
                const end = start + perPage;
                items.forEach((item, index) => {
                    item.style.display = (index >= start && index < end) ? "block" : "none";
                });
                document.getElementById("pageInfo").innerText = Page $ {
                    page
                }
                of $ {
                    Math.ceil(items.length / perPage)
                };
                document.getElementById("prevBtn").disabled = page === 1;
                document.getElementById("nextBtn").disabled = page === Math.ceil(items.length / perPage);
            }
            document.getElementById("prevBtn").addEventListener("click", () => {
                if (currentPage > 1) {
                    currentPage--;
                    showPage(currentPage);
                }
            });
            document.getElementById("nextBtn").addEventListener("click", () => {
                if (currentPage < Math.ceil(items.length / perPage)) {
                    currentPage++;
                    showPage(currentPage);
                }
            });
            showPage(currentPage);
        </script> --}}
@endpush
