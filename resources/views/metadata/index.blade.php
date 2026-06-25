@extends('layouts.app')

@section('title', 'Metadata')

@section('content')
    <main class="mb-6">


        @if ($collectionData)
            <section id="berita" class="py-20 bg-gradient-to-b from-gray-50 to-white">
                <div class="max-w-7xl mx-auto px-6 lg:px-8">

                    {{-- Title --}}
                    <div class="text-center mt-10 mb-16">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 tracking-tight">
                            {{ $titleData }}
                        </h2>
                        <div class="mt-4 w-24 h-1 bg-blue-600 mx-auto rounded-full"></div>
                    </div>

                    @php
                        $typeMap = [
                            'METADATA KEGIATAN' => [
                                'title' => 'judul_kegiatan',
                                'publish' => 'tahun',
                                'url_type' => 1,
                                'badge' => 'Kegiatan',
                            ],
                            'METADATA VARIABEL' => [
                                'title' => 'nama',
                                'publish' => 'submission_period',
                                'url_type' => 2,
                                'badge' => 'Variabel',
                            ],
                            'METADATA INDIKATOR' => [
                                'title' => 'nama',
                                'publish' => 'submission_period',
                                'url_type' => 3,
                                'badge' => 'Indikator',
                            ],
                        ];

                        $config = $typeMap[$titleData] ?? null;
                    @endphp

                    @if ($config)
                        <div class="flex flex-col space-y-6 max-w-4xl mx-auto">
                            @foreach ($collectionData as $item)
                                <div class="bg-white rounded-lg border border-gray-200 p-6 shadow-sm hover:shadow-md transition-shadow">
                                    {{-- Title --}}
                                    <a href="{{ route('metadata.detail', [$config['url_type'], $item['id']]) }}" class="text-xl font-semibold text-blue-600 hover:text-blue-800 hover:underline mb-2 block">
                                        {{ $item[$config['title']] ?? '-' }}
                                    </a>
                                    
                                    {{-- Description placeholder --}}
                                    <p class="text-gray-600 text-sm mb-4 leading-relaxed">
                                        @if(isset($item['tujuan_kegiatan']))
                                            {{ \Illuminate\Support\Str::limit($item['tujuan_kegiatan'], 200) }}
                                        @else
                                            Detail informasi mengenai {{ strtolower($config['badge']) }} statistik ini dapat dilihat lebih lanjut dengan mengklik tombol selengkapnya di bawah ini.
                                        @endif
                                    </p>

                                    {{-- Metadata Info --}}
                                    <div class="flex flex-col sm:flex-row sm:items-center justify-between w-full text-sm text-gray-500 mb-5 gap-3">
                                        <div class="flex items-center gap-2">
                                            <i class="bi bi-building text-gray-400 text-base"></i>
                                            <span class="font-medium text-gray-700">{{ $item['produsen_data_name'] ?? '-' }}</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <i class="bi bi-calendar3 text-gray-400 text-base"></i>
                                            <span>Publikasi: {{ $item[$config['publish']] ?? '-' }}</span>
                                        </div>
                                    </div>

                                    {{-- Selengkapnya Button --}}
                                    <div>
                                        <a href="{{ route('metadata.detail', [$config['url_type'], $item['id']]) }}" class="inline-flex items-center justify-center px-4 py-2 bg-gray-50 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-100 hover:text-blue-600 transition-colors">
                                            Selengkapnya
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- Pagination --}}
                        @if (isset($paginationData) && isset($paginationData['last_page']) && $paginationData['last_page'] > 1)
                            <div class="mt-12 flex justify-center">
                                <nav class="inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                    @php
                                        $currentPage = $paginationData['current_page'] ?? 1;
                                        $lastPage = $paginationData['last_page'] ?? 1;
                                        $start = max(1, $currentPage - 2);
                                        $end = min($lastPage, $currentPage + 2);
                                    @endphp

                                    {{-- Previous Page --}}
                                    <a href="{{ $currentPage > 1 ? request()->fullUrlWithQuery(['page' => $currentPage - 1]) : '#' }}"
                                        class="relative inline-flex items-center px-3 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium {{ $currentPage <= 1 ? 'text-gray-300 cursor-not-allowed pointer-events-none' : 'text-gray-500 hover:bg-gray-50' }}">
                                        <span class="sr-only">Previous</span>
                                        <i class="bi bi-chevron-left text-sm"></i>
                                    </a>

                                    {{-- Page Numbers --}}
                                    @for ($i = $start; $i <= $end; $i++)
                                        <a href="{{ request()->fullUrlWithQuery(['page' => $i]) }}"
                                            class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium {{ $i == $currentPage ? 'z-10 bg-blue-50 border-blue-500 text-blue-600' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                                            {{ $i }}
                                        </a>
                                    @endfor

                                    {{-- Next Page --}}
                                    <a href="{{ $currentPage < $lastPage ? request()->fullUrlWithQuery(['page' => $currentPage + 1]) : '#' }}"
                                        class="relative inline-flex items-center px-3 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium {{ $currentPage >= $lastPage ? 'text-gray-300 cursor-not-allowed pointer-events-none' : 'text-gray-500 hover:bg-gray-50' }}">
                                        <span class="sr-only">Next</span>
                                        <i class="bi bi-chevron-right text-sm"></i>
                                    </a>
                                </nav>
                            </div>
                        @endif

                    @endif

                </div>
            </section>
        @endif
    </main>
@endsection
