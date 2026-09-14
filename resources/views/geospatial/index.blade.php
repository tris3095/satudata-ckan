@extends('layouts.app')

@section('title', 'Data Geospasial')

@section('content')
    <main class="mb-10">
        <section class="max-w-7xl mx-auto px-4 py-8">
            <h1 class="text-4xl font-bold text-red-600">Data Geospasial</h1>
            <p class="mt-2 text-xl text-gray-600">Katalog data dan peta geospasial Provinsi Sumatera Selatan</p>
        </section>

        <section class="max-w-7xl mx-auto px-4">
            @if ($error)
                <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4 text-red-700">
                    {{ $message ?? 'Data Geoportal belum dapat dimuat. Silakan coba kembali.' }}
                </div>
            @endif

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                @forelse ($records as $item)
                    <article class="flex h-full flex-col overflow-hidden rounded-xl border border-gray-100 bg-white shadow transition hover:shadow-lg">
                        <div class="flex w-full items-center justify-center overflow-hidden bg-gray-100"
                            style="height: 200px; min-height: 200px; max-height: 200px;">
                            @if (!empty($item['thumbnail']))
                                <img src="{{ $item['thumbnail'] }}"
                                    alt="Peta {{ $item['title'] ?? 'Data geospasial' }}"
                                    class="h-full w-full object-cover" loading="lazy"
                                    onerror="this.onerror=null;this.src='{{ asset('images/default.png') }}';">
                            @else
                                <span class="text-4xl font-bold text-gray-500">{{ $item['org_initial'] ?? 'ORG' }}</span>
                            @endif
                        </div>

                        <div class="flex flex-1 flex-col p-5">
                            <h2 class="mb-3 text-xl font-semibold text-gray-800">
                                {{ $item['title'] ?? 'Tidak ada judul' }}
                            </h2>
                            <p class="mb-5 text-sm text-gray-500">
                                <strong>Sumber:</strong> {{ $item['organization'] ?? 'Tidak diketahui' }}
                            </p>
                            <a href="https://geoportal.sumselprov.go.id/main/katalog" target="_blank" rel="noopener noreferrer"
                                class="mt-auto inline-flex w-fit items-center gap-2 rounded-lg bg-red-600 px-4 py-2 text-white transition hover:bg-red-700">
                                Lihat Detail <i class="bi bi-box-arrow-up-right"></i>
                            </a>
                        </div>
                    </article>
                @empty
                    @unless ($error)
                        <div class="col-span-full rounded-lg border border-gray-200 bg-white p-8 text-center text-gray-500">
                            Belum ada data geospasial yang tersedia.
                        </div>
                    @endunless
                @endforelse
            </div>

            @if ($records->hasPages())
                <div class="mt-8">
                    {{ $records->links() }}
                </div>
            @endif
        </section>
    </main>
@endsection
