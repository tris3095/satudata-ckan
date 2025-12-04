@extends('layouts.app')

@section('title', $dberita->judul)

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <section class="max-w-7xl mx-auto">
        <div class="bg-white rounded-xl shadow-lg p-3 md:p-5 md:mt-7">
        
            <div class="mb-5 relative">
                <h1 class="text-black text-xl md:text-4xl font-bold">
                    {{ $dberita->judul }}
                </h1>
            </div>    
            <div class="space-y-4">

                <!-- Desktop Carousel -->
                <div class="hidden md:block">
                    <div class="swiper desktopSwiper relative w-full h-full rounded-lg overflow-hidden">

                        <div class="swiper-wrapper">
                            @foreach ($gambar as $item)
                                <div class="swiper-slide">
                                    <img class="w-full h-[600px] bg-center bg-cover"
                                        style="background-image: url('https://sumselprov.go.id/storage/{{ substr($item, 7) }}')">
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="swiper-pagination !bottom-4"></div>

                        <!-- Navigation -->
                        <div class="swiper-button-prev opacity-50" style="color: white"></div>
                        <div class="swiper-button-next opacity-50" style="color: white"></div>
                    </div>
                </div>

                <!-- Mobile Carousel -->
                <div class="block md:hidden">
                    <div class="swiper mobileSwiper relative w-full h-full rounded-lg overflow-hidden">

                        <div class="swiper-wrapper">
                            @foreach ($gambar as $item)
                                <div class="swiper-slide">
                                    <img src="https://sumselprov.go.id/storage/{{ substr($item, 7) }}"
                                        class="w-full h-full object-cover rounded-md">
                                </div>
                            @endforeach
                        </div>

                        <div class="swiper-pagination"></div>
                        <div class="swiper-button-prev opacity-25" style="color: white"></div>
                        <div class="swiper-button-next opacity-25" style="color: white"></div>
                    </div>
                </div>

                <!-- Content Section -->
                <div class="relative text-justify">
                    <div class="flex items-center text-grey-600 font-bold">
                        <i class="flaticon-calendar"></i>
                        {{ \Carbon\Carbon::parse($dberita->tanggal)->isoFormat('dddd, D MMMM Y') }}
                    </div>

                    <div class="mt-6 text-base md:text-lg/7">
                        {!! $dberita->isi !!}
                    </div>
                </div>

            </div>
        </div>
    </section>

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
@endsection
