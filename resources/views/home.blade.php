@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div>
        <section class="slider__area relative z-10" x-data="{
            active: 0,
            total: {{ $banner->isNotEmpty() ? $banner->count() : 1 }},
            init() {
                setInterval(() => {
                    this.active = (this.active + 1) % this.total
                }, 5000)
            }
        }">

            <div class="relative overflow-hidden h-[550px]">
                @if ($banner->isNotEmpty())
                    <template x-for="(item, index) in {{ $banner->toJson() }}">
                        <div x-show="active === index" x-transition.opacity class="absolute inset-0">
                            <img :src="item.image_url" class="w-full h-full object-cover" />
                        </div>
                    </template>
                @else
                    <div x-show="active === 0" x-transition.opacity class="absolute inset-0">
                        <img src="{{ asset('images/satu-data.jpeg') }}" class="w-full h-full object-cover" />
                    </div>
                @endif

                @if ($banner->isNotEmpty())
                    <button @click="active = active === 0 ? total - 1 : active - 1"
                        class="absolute left-3 top-1/2 -translate-y-1/2 bg-black/40 hover:bg-black/60 text-white p-3 rounded-full">
                        <i class="bi bi-chevron-left"></i>
                    </button>

                    <button @click="active = (active + 1) % total"
                        class="absolute right-3 top-1/2 -translate-y-1/2 bg-black/40 hover:bg-black/60 text-white p-3 rounded-full">
                        <i class="bi bi-chevron-right"></i>
                    </button>
                @endif
            </div>

            @if ($banner->isNotEmpty())
                <div class="flex gap-3 justify-center mt-4">
                    <template x-for="index in total">
                        <button @click="active = index - 1" :class="active === index - 1 ? 'bg-blue-600' : 'bg-white/50'"
                            class="w-3 h-3 rounded-full border border-white"></button>
                    </template>
                </div>
            @endif
            <div class="overflow-hidden bg-gray-100 border-t border-b">
                <div class="whitespace-nowrap text-red-700 font-semibold py-2 animate-marquee-delay">
                    Untuk meningkatkan keterpaduan dan transparansi, website SIMATA Sumsel resmi bertransformasi menjadi
                    Satu Data Sumsel sesuai kebijakan nasional Satu Data Indonesia.
                </div>
            </div>

        </section>

        <section class="py-12">
            <div class="text-center mb-10">
                <h2 class="text-3xl font-bold">
                    <span class="text-red-600">Topik </span>Data
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-7xl mx-auto px-4">

                @foreach ($groups as $group)
                    {{-- <a href="{{ route('group.show', $group['name']) }}"> --}}
                    <a href="#">
                        <div class="flex items-center gap-4 p-6 bg-white rounded-xl shadow hover:shadow-md transition">
                            <div class="p-3 bg-red-100 rounded-lg text-red-600 text-2xl">
                                <i class="{{ group_icon($group['name']) }}"></i>
                            </div>
                            <h3 class="text-lg font-semibold">
                                {{ $group['title'] ?? ($group['display_name'] ?? $group['name']) }}
                            </h3>
                        </div>
                    </a>
                @endforeach

            </div>
        </section>

        <section class="max-w-7xl mx-auto mt-10 px-4">
            <div class="flex justify-between items-center mb-10">
                <h2 class="text-3xl font-bold">
                    <span class="text-red-600">Berita</span> Terkini
                </h2>

                <a href="{{ route('news.index') }}"
                    class="px-4 py-2 border rounded-xl flex items-center gap-2 hover:text-white hover:border-white hover:bg-red-600 transition">
                    Lihat Semua <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            <div class="relative">
                <div id="news-slider" class="grid grid-cols-1 md:grid-cols-3 gap-6 snap-x snap-mandatory pb-4">
                    @foreach ($news as $item)
                        <a href="{{ route('detail.news', $item['slug']) }}"
                            class="bg-white shadow rounded-xl snap-start hover:shadow-lg transition-all flex flex-col">
                            <div class="h-48 w-full overflow-hidden rounded-t-xl">
                                <img src="{{ $item['filegambar'] }}" class="w-full h-full object-cover"
                                    onerror="this.src='/default-news.png'">
                            </div>

                            <div class="p-4 flex-1 flex flex-col">
                                <p class="text-sm text-gray-500">
                                    {{ $item['tgl'] }}
                                </p>
                                <h3 class="text-lg font-semibold mt-1 line-clamp-2">
                                    {{ $item['judul'] }}
                                </h3>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="max-w-7xl mx-auto mt-10 px-4">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-bold">
                    <span class="text-red-600">Info</span>grafis
                </h2>

                <a href="{{ route('infographics.index') }}"
                    class="px-4 py-2 border rounded-xl flex items-center gap-2 hover:text-white hover:border-white hover:bg-red-600 transition">
                    Lihat Semua <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            @if ($infographics->isEmpty())
                <p class="text-gray-500">No infographics available.</p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                    @foreach ($infographics as $item)
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
        </section>
    </div>
@endsection
