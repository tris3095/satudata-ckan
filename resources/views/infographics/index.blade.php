@extends('layouts.app')

@section('title', 'Infografis')

@section('content')
    <main class="mb-6">
        <!-- Hero Section -->
        <section class="hero max-w-7xl mx-auto py-8">
            <div class="px-6 relative">
                <h1 class="text-4xl font-bold text-red-600">Info<span class="text-black">grafis</span></h1>
                <p class="mt-2 text-2xl">Provinsi Sumatera Selatan</p>
            </div>
        </section>

        <!-- Content Section -->
        <section class="max-w-7xl mx-auto">
            <!-- <div class="p-6"> -->
            <div class="section-content px-6">
                @if ($datas->isEmpty())
                    <p class="text-gray-500">No infographics available.</p>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach ($datas as $item)
                            <div class="bg-white shadow rounded-xl overflow-hidden hover:shadow-xl transition-all">
                                <a href="javascript:;">
                                    <div class="h-48 w-full overflow-hidden">
                                        <img src="{{ $item->image_url }}" class="w-full h-full object-cover"
                                            alt="{{ $item->title }}">
                                    </div>

                                    <div class="p-4">
                                        <h3 class="font-semibold text-lg line-clamp-2">
                                            {{ $item->title }}
                                        </h3>

                                        <p class="text-sm text-gray-500 mt-2">
                                            {{ \Carbon\Carbon::parse($item->published_at)->format('d M Y') }}
                                        </p>
                                    </div>
                                </a>

                            </div>
                        @endforeach
                    </div>
                @endif

                <div class="my-6">
                    {{ $datas->links('pagination::tailwind') }}
                </div>
            </div>
            <!-- </div> -->
        </section>
    </main>

@endsection
