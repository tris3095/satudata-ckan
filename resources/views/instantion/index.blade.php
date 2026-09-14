@extends('layouts.app')

@section('title', 'Instansi')

@section('content')
    <main class="mb-6">
        <section class="hero max-w-7xl mx-auto py-8">
            <div class="px-6 relative">
                <h1 class="text-4xl font-bold text-red-600">Instansi</h1>
                <p class="mt-2 text-2xl">Provinsi Sumatera Selatan</p>
            </div>
        </section>

        <section class="max-w-7xl mx-auto">
            {{-- Search Bar --}}
            <form method="GET" action="{{ route('instantion.index') }}" class="mb-6">
                <input type="text" name="q" value="{{ $keyword }}" placeholder="Cari instantion..."
                    class="w-full md:w-1/2 px-4 py-2 border rounded-lg focus:ring focus:border-blue-500">
            </form>

            {{-- instantion Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 mb-6">

                @foreach ($instantions as $item)
                    <a href="{{ route('instantion.show', $item['name']) }}?show=1"
                        class="group block overflow-hidden bg-white rounded-xl border border-gray-100 shadow hover:shadow-lg transition">

                        <div class="w-full overflow-hidden bg-gray-50 p-6"
                            style="height: 200px; min-height: 200px; max-height: 200px;">
                            <img src="{{ $item['image_display_url'] ?? asset('images/default.png') }}"
                                alt="Logo {{ $item['title'] ?? $item['name'] }}"
                                class="h-full w-full object-contain transition duration-300 group-hover:scale-105"
                                onerror="this.onerror=null;this.src='{{ asset('images/default.png') }}';">
                        </div>

                        <div class="p-5">

                            <h3 class="font-semibold text-lg mb-2 text-gray-900 group-hover:text-red-600 transition">
                                {{ $item['title'] ?? $item['name'] }}
                            </h3>

                            {{-- <p class="text-gray-600 text-sm mb-3">
                                {{ Str::limit($item['notes'] ?? 'No description.', 100) }}
                            </p>

                            <span class="inline-block text-blue-600 text-sm font-medium">
                                Lihat Detail →
                            </span> --}}
                        </div>
                    </a>
                @endforeach

            </div>

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $instantions->appends(['q' => $keyword])->links() }}
            </div>
        </section>
    </main>
@endsection
