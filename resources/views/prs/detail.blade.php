@extends('layouts.app')

@section('title', $dberita->judul)

@push('plugin-style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
@endpush

@section('content')
    <section class="max-w-7xl mx-auto px-6 py-10">
        <div class="bg-white rounded-xl shadow-lg p-3 md:p-5 md:mt-7">

            <!-- TITLE -->
            <h1 class="text-xl md:text-2xl font-bold text-gray-800">
                {{ $dberita->title }}
            </h1>

            <!-- MAIN CONTENT -->
            <div class="grid md:grid-cols-3 gap-6 mt-6">

                <!-- LEFT: COVER -->
                <div>
                    <div class="  overflow-hidden bg-gray-100">

                        <img src="{{ asset('storage/prs/thumbnail/' . $dberita->thumbnail) }}" class="">
                    </div>

                    <!-- BUTTON -->
                    <a href="{{ asset('storage/prs/' . $dberita->document) }}"
                        class="block mt-4 bg-green-600 text-gray-100 text-center py-2 rounded hover:bg-green-700">
                        📥 Uduh Publikasi
                    </a>
                </div>

                <!-- RIGHT: META -->
                <div class="md:col-span-2">
                    <table class="w-full text-sm text-gray-700">
                        <tbody>

                            <tr>
                                <td class="py-2 font-medium w-48">Nomor Katalog</td>
                                <td>{{ $dberita->nomor_katalog }}</td>
                            </tr>



                            <tr>
                                <td class="py-2 font-medium">ISSN / ISBN</td>
                                <td>{{ $dberita->isbn }}</td>
                            </tr>

                            <tr>
                                <td class="py-2 font-medium">Tanggal Rilis</td>
                                <td>{{ \Carbon\Carbon::parse($dberita->published_at)->format('d F Y') }}</td>
                            </tr>

                            <tr>
                                <td class="py-2 font-medium">Bahasa</td>
                                <td>{{ $dberita->bahasa }}</td>
                            </tr>

                            <tr>
                                <td class="py-2 font-medium">Ukuran File</td>
                                <td>{{ $dberita->file_size }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 font-medium"><b>Abstraksi</b>
                                </td>
                                <td>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"> {!! $dberita->description !!}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>

            </div>

            <!-- ABSTRACT -->

            <!-- RELATED -->

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
