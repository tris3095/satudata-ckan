@extends('layouts.app')

@section('title', 'Data Insight')

@section('content')
    <main class="mb-6">
        <section class="hero max-w-7xl mx-auto py-8">
            <div class="px-6 relative">
                <h1 class="text-4xl font-bold text-red-600">Data <span class="text-black">Insight</span></h1>
                <p class="mt-2 text-2xl">Provinsi Sumatera Selatan</p>
            </div>
        </section>
        <section class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($insights as $item)
                    <div
                        class="flex items-center gap-4 bg-gray-50 border border-gray-200 rounded-xl p-4 shadow-sm hover:shadow-md transition">

                        <img src="{{ asset($item->icon) }}" alt="{{ $item->title }}" class="w-14 h-14 object-contain">

                        <h3 class="text-lg font-semibold">{{ $item->title }}</h3>
                    </div>
                @endforeach
            </div>
        </section>
    </main>
@endsection
