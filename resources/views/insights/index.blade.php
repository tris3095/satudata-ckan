@extends('layouts.app')

@section('title', 'Data Insight')

@section('content')
    <section class="container mx-auto mt-10">
        <h2 class="text-3xl font-bold mb-6">
            <span class="text-blue-600">Data</span> Insight
        </h2>

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
@endsection
