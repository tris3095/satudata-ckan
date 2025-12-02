@extends('layouts.app')

@section('title', 'Berita Sumsel')

@section('content')
    <main class="mb-6">
        <!-- Hero Section -->
        <section class="hero bg-blue-700 py-12">
            <div class="container mx-auto px-4 relative">
                <h1 class="text-white text-4xl font-bold">Berita Terkini</h1>
                <p class="mt-2 text-white text-lg">Provinsi Sumatera Selatan</p>
            </div>
        </section>

        <!-- Content Section -->
        <section class="container mx-auto px-4 mt-8">
            <div class="bg-white shadow-xl rounded-lg p-6">
                <div class="section-content">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

                        @foreach ($paginator as $item)
                            <div class="bg-white shadow rounded-lg overflow-hidden flex flex-col">
                                <img src="https://sumselprov.go.id/storage/{{ substr($item->filegambar, 7) }}"
                                    alt="{{ $item->judul }}" class="w-full h-48 object-cover">

                                <div class="p-4 flex flex-col flex-grow">
                                    <small class="text-gray-500 mb-1">
                                        <i class="flaticon-calendar mr-1"></i>
                                        {{ \Carbon\Carbon::parse($item->tgl)->isoFormat('dddd, D MMMM Y') }}
                                    </small>

                                    <h5 class="text-lg font-semibold mb-4">
                                        {{ $item->judul }}
                                    </h5>

                                    <a href="{{ route('detail.news', ['slug' => $item->slug]) }}"
                                        class="mt-auto inline-block border border-blue-600 text-blue-600 px-3 py-2 rounded text-sm hover:bg-blue-600 hover:text-white transition">
                                        Baca Selengkapnya
                                    </a>
                                </div>
                            </div>
                        @endforeach

                    </div>

                    <div class="my-6">
                        {{ $paginator->links('pagination::tailwind') }}
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection
