@extends('layouts.app')

@section('title', $dberita->judul)

@push('plugin-style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
@endpush

@section('content')
    <section class="max-w-7xl mx-auto">
        <div class="bg-white rounded-xl shadow-lg p-3 md:p-5 md:mt-7">

            <div class="mb-5 relative">
                <h1 class="text-black text-xl md:text-4xl font-bold">
                    {{ $dberita->judul }}
                </h1>
            </div>
            <div class="space-y-4">
                
                <div class="">
                    <div class="swiper mobileSwiper relative w-full h-full rounded-lg overflow-hidden">

                        <div class="swiper-wrapper">
                            @foreach ($gambar as $item)
                                <div class="swiper-slide">
                                    <img src="https://sumselprov.go.id/storage/{{ substr($item, 7) }}"
                                        class="w-full h-full 
                                        md:h-[600px] object-cover rounded-md">
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
@endsection

@push('plugin-scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
@endpush
@push('custom-scripts')
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
@endpush
