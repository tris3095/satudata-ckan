@extends('layouts.app')

@section('title', 'Dataset')

@section('content')
    <h2 class="text-2xl font-bold mb-5">Dataset</h2>

    {{-- Search Bar --}}
    <form method="GET" action="{{ route('dataset.index') }}" class="mb-6">
        <input type="text" name="q" value="{{ $keyword }}" placeholder="Cari dataset..."
            class="w-full md:w-1/2 px-4 py-2 border rounded-lg focus:ring focus:border-blue-500">
    </form>

    {{-- Dataset Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 mb-6">

        @foreach ($datasets as $item)
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
        @endforeach

    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $datasets->appends(['q' => $keyword])->links() }}
    </div>
@endsection
