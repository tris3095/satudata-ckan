@extends('layouts.app')

@section('content')
    <div class="bg-white shadow rounded-xl p-6">

        <h2 class="text-2xl font-bold mb-3">
            {{ $instantion['title'] ?? $instantion['name'] }}
        </h2>

        <p class="text-gray-700 mb-6">
            {{ $instantion['description'] ?? 'Tidak ada deskripsi.' }}
        </p>

        {{-- Jumlah Dataset --}}
        <div class="mb-6">
            <p class="text-lg font-semibold">
                Jumlah Dataset: {{ $datasetCount }}
            </p>

            @if (!$showAll)
                <a href="?show=1" class="inline-block mt-3 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Lihat Semua Dataset →
                </a>
            @endif
        </div>

        {{-- Jika user klik lihat semua --}}
        @if ($showAll)
            <h3 class="font-semibold text-lg mb-3">Daftar Dataset</h3>

            <ul class="space-y-3">
                @foreach ($datasets as $ds)
                    <li class="p-3 border rounded-lg bg-gray-50 hover:bg-gray-100 transition">
                        <a href="{{ route('dataset.show', $ds['name']) }}" class="text-blue-600 font-medium">
                            {{ $ds['title'] ?? $ds['name'] }}
                        </a>

                        <p class="text-gray-600 text-sm mt-1">
                            {{ Str::limit($ds['notes'] ?? 'Tidak ada deskripsi.', 120) }}
                        </p>
                    </li>
                @endforeach
            </ul>

            <div class="mt-5">
                {{ $datasets->links() }}
            </div>
        @endif

    </div>
@endsection
