@extends('layouts.app')

@section('title', 'Dokumen Perencanaan')

@section('content')
    <main class="mb-6">
        <!-- Hero Section -->
        <section class="hero max-w-7xl mx-auto py-8">
            <div class="px-3 md:px-5 relative">
                <h1 class="text-2xl md:text-4xl font-bold text-red-600">Dokumen <span class="text-black">Perencanaan</span>
                </h1>
                <p class="text-lg md:text-2xl">Provinsi Sumatera Selatan</p>
            </div>
        </section>

        <!-- Content Section -->
        <section class="max-w-5xl mx-auto px-3 md:px-5">

            {{-- Filter --}}
            <form method="GET" action="{{ route('esakip.documents') }}"
                class="flex flex-wrap items-end gap-3 mb-6 bg-white border rounded-lg p-4">
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Jenis Dokumen</label>
                    <input type="text" name="berkas" value="{{ $filters['berkas'] ?? '' }}" list="berkas-options"
                        placeholder="Contoh: Renstra, RPJMD, LKjIP" class="w-56 border rounded-md p-2 text-sm">
                    <datalist id="berkas-options">
                        <option value="RPJPD">
                        <option value="RPJMD">
                        <option value="Renstra">
                        <option value="Renja">
                        <option value="Perjanjian Kinerja">
                        <option value="LKjIP">
                    </datalist>
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Tahun</label>
                    <input type="number" name="year" value="{{ $filters['year'] ?? '' }}" placeholder="2026"
                        min="2000" max="{{ now()->year + 1 }}" class="w-28 border rounded-md p-2 text-sm">
                </div>

                <button type="submit"
                    class="px-4 py-2 bg-red-700 text-white text-sm rounded-md hover:bg-red-800 cursor-pointer">
                    Filter
                </button>

                @if (!empty($filters['berkas']) || !empty($filters['year']))
                    <a href="{{ route('esakip.documents') }}" class="text-sm text-gray-500 hover:underline">
                        Reset
                    </a>
                @endif
            </form>

            @if ($error)
                <div class="bg-red-50 border border-red-200 text-red-700 rounded-lg p-4">
                    {{ $message ?? 'Gagal mengambil data dari layanan E-SAKIP.' }}
                </div>
            @elseif ($documents->isEmpty())
                <p class="text-gray-500">
                    {{ !empty($filters['berkas']) || !empty($filters['year']) ? 'Tidak ada dokumen yang cocok dengan filter tersebut.' : 'Belum ada dokumen tersedia.' }}
                </p>
            @else
                <div class="space-y-4">
                    @foreach ($documents as $item)
                        <div class="bg-white border rounded-lg p-4 hover:shadow-md transition">
                            <div class="flex flex-wrap items-center gap-2 text-xs text-gray-500 mb-1">
                                <span class="px-2 py-0.5 rounded-full bg-red-100 text-red-700 font-medium">
                                    {{ $item['berkas']['name'] ?? '-' }}
                                </span>
                                <span>{{ $item['agency']['name'] ?? '-' }}</span>
                                <span>&bull;</span>
                                <span>{{ $item['year'] ?? '-' }}</span>
                                <span>&bull;</span>
                                <span>{{ $item['created_at'] ?? '-' }}</span>
                            </div>

                            <h3 class="text-base font-semibold text-gray-800">
                                {{ $item['description'] ?? '-' }}
                            </h3>

                            @if (!empty($item['file_url']))
                                <a href="{{ $item['file_url'] }}" target="_blank" rel="noopener"
                                    class="inline-block mt-3 text-blue-600 text-sm font-medium hover:underline">
                                    📄 Unduh Dokumen
                                </a>
                            @endif
                        </div>
                    @endforeach
                </div>

                <div class="my-6">
                    {{ $documents->links('pagination::tailwind') }}
                </div>
            @endif
        </section>
    </main>
@endsection
