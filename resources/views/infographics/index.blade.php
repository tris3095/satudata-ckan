@extends('layouts.app')

@push('plugin-style')
    <script src="//unpkg.com/alpinejs" defer></script>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
@endpush

@section('title', 'Infografis')

@section('content')
    {{-- <div x-data="{ open: false }">

        <!-- Overlay -->
        <div x-show="open" x-transition.opacity class="fixed inset-0 bg-black/30 z-40">
        </div>

        <!-- Modal Wrapper -->
        <div x-show="open" x-transition class="fixed inset-0 z-50 flex items-center justify-center px-4">

            <!-- Modal -->
            <div class="bg-white w-full max-w-md rounded-lg shadow-xl
                   flex flex-col overflow-hidden">

                <!-- Header -->
                <div class="flex items-center justify-between px-4 py-2 bg-gray-100 border-b">
                    <h3 class="text-sm font-semibold text-gray-700">
                        Informasi Dataset
                    </h3>
                    <button @click="open = false" class="text-gray-500 hover:text-gray-800 text-lg leading-none">
                        ×
                    </button>
                </div>

                <!-- Body -->
                <div class="p-3 text-sm text-gray-700 max-h-[45vh] overflow-y-auto">
                    <img :src="image" class="w-full object-contain rounded">
                </div>

                <!-- Footer -->
                <div class="flex justify-end px-4 py-2 bg-gray-50 border-t">
                    <button @click="open = false" class="px-3 py-1.5 text-xs border rounded hover:bg-gray-100">
                        Tutup
                    </button>
                </div>

            </div>
        </div>
    </div> --}}
    <div x-data="{ open: false, image: '', title: '' }" @keydown.escape.window="open = false" x-cloak>
        <main class="mb-6">

            <!-- Hero Section -->
            <section class="hero max-w-7xl mx-auto py-8">
                <div class="px-6 relative">
                    <h1 class="text-4xl font-bold text-red-600">
                        Info<span class="text-black">grafis</span>
                    </h1>
                    <p class="mt-2 text-2xl">Provinsi Sumatera Selatan</p>
                </div>
            </section>

            <!-- Content -->
            <section class="max-w-7xl mx-auto">
                <div class="section-content px-6">

                    @if ($datas->isEmpty())
                        <p class="text-gray-500">No infographics available.</p>
                    @else
                        <!-- GRID -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                            @foreach ($datas as $item)
                                <div class="bg-white shadow rounded-xl overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300 cursor-pointer"
                                    @click="open = true; image = '{{ $item->image_url }}'; title = '{{ addslashes($item->title) }}'">
                                    <div class="h-48 w-full overflow-hidden">
                                        <img src="{{ $item->image_url }}" class="w-full h-full object-cover"
                                            alt="{{ $item->title }}">
                                    </div>

                                    <div class="p-4">
                                        <h3 class="font-semibold text-lg line-clamp-2">
                                            {{ $item->title }}
                                        </h3>

                                        <p class="text-sm text-gray-500 mt-2">
                                            {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    @endif

                    <!-- PAGINATION -->
                    <div class="my-6">
                        {{ $datas->links('pagination::tailwind') }}
                    </div>

                </div>
            </section>
        </main>

        <!-- 🔥 MODAL (DI LUAR GRID) -->
        <div x-show="open" x-transition.opacity.scale.duration.200ms @click.self="open = false"
            x-effect="document.body.style.overflow = open ? 'hidden' : ''"
            class="fixed inset-0 bg-black/60 flex items-center justify-center  p-4" style="z-index: 99999 !important;">
            <div
                class="bg-white rounded-2xl shadow-2xl max-w-3xl w-full
            bg-white w-full max-w-md rounded-lg shadow-xl
                   flex flex-col overflow-hidden">

                <!-- HEADER -->
                <div class="flex justify-end p-3 border-b bg-white shrink-0">
                    <button @click="open = false" class="text-gray-600 hover:text-red-500 text-2xl">
                        ✕
                    </button>
                </div>

                <!-- BODY -->
                <!-- BODY -->
                <div class="p-4 text-sm text-gray-700 max-h-[45vh] overflow-y-auto">
                    <img :src="image" class="h-auto w-auto max-w-none">
                </div>


                <!-- FOOTER -->
                <div class="p-4 border-t text-center bg-white shrink-0">
                    <h2 class="text-lg font-semibold" x-text="title"></h2>
                </div>

            </div>
        </div>

    </div>
@endsection
