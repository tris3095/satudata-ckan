@extends('layouts.app')

@section('title', 'Dataset')

@section('content')
    <main class="mb-6">
        <!-- Hero Section -->
        <section class="hero max-w-7xl mx-auto py-8">
            <div class="px-6 relative">
                <h1 class="text-4xl font-bold text-red-600">
                    {{ $items[0]['groups'][0]['display_name'] ?? 'Tidak ada Data' }}<span class="text-black"></span></h1>
                <p class="mt-2 text-2xl">Jumlah dataset : {{ count($items) }} </p>
            </div>
        </section>

        <!-- Content Section -->
        <section class="max-w-7xl mx-auto">

            {{-- Search Bar --}}
            <form method="GET" action="{{ route('dataset.index') }}" class="mb-6">
                <input type="text" name="q" value="" placeholder="Cari dataset..."
                    class="w-full md:w-1/2 px-4 py-2 border rounded-lg focus:ring focus:border-blue-500">
            </form>

            {{-- Dataset Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 mb-6">

                @forelse  ($items as $item)
                    <a href="{{ route('dataset.show', $item['name']) }}"
                        class="block bg-white rounded-xl shadow hover:shadow-lg transition p-5">

                        <h3 class="font-semibold text-lg mb-2">
                            {{ $item['title'] ?? $item['name'] }}
                        </h3>

                        <p class="text-gray-600 text-sm mb-3">
                            {{ Str::limit($item['notes'] ?? 'No description.', 100) }}
                        </p>

                        <span class="inline-block text-blue-600 text-sm font-medium">
                            Lihat Detail →
                        </span>
                    </a>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">
                            Tidak ada dataset tersedia.
                        </div>
                    </div>
                @endforelse

            </div>

            {{-- Pagination --}}
            <div class="mt-4">

            </div>
        </section>
    </main>
@endsection
