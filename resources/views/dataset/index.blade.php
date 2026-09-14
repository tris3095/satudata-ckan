@extends('layouts.app')

@section('title', 'Dataset')

@section('content')
    <main class="mb-6">
        <!-- Hero Section -->
        <section class="hero max-w-7xl mx-auto py-8">
            <div class="px-6 relative">
                <h1 class="text-4xl font-bold text-red-600">Data<span class="text-black">set</span></h1>
                <p class="mt-2 text-2xl">Provinsi Sumatera Selatan</p>
            </div>
        </section>

        <!-- Content Section -->
        <section class="max-w-7xl mx-auto">

            {{-- Search Bar --}}
            {{-- <form method="GET" action="{{ route('dataset.index') }}" class="mb-6">
                <input type="text" name="q" value="{{ $keyword }}" placeholder="Cari dataset..."
                    class="w-full md:w-1/2 px-4 py-2 border rounded-lg focus:ring focus:border-blue-500">
            </form> --}}

            {{-- Dataset Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 mb-6">

                @foreach ($datasets as $group)
                    <a href="{{ route('group.show', $group['name']) }}">
                        <div
                            class="group-card flex items-center gap-4 p-6 bg-white rounded-xl shadow hover:shadow-md transition">
                            <div class="p-3 bg-red-100 rounded-lg text-red-600 text-2xl"> <i
                                    class="{{ group_icon($group['name']) }}"></i> </div>
                            <h3 class="text-lg font-semibold">
                                {{ $group['title'] ?? ($group['display_name'] ?? $group['name']) }} </h3>
                        </div>
                    </a>
                @endforeach

            </div>

            {{-- Pagination --}}
            {{-- <div class="mt-4">
                {{ $datasets->appends(['q' => $keyword])->links() }}
            </div> --}}
        </section>
    </main>
@endsection
