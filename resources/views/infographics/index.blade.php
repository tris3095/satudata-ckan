@extends('layouts.app')

@section('title', 'Infografis')

@section('content')
    <main class="mb-6">
        <!-- Hero Section -->
        <section class="hero max-w-7xl mx-auto py-8">
            <div class="px-6 relative">
                <h1 class="text-4xl font-bold text-red-600">Info<span class="text-black">grafis</span></h1>
                <p class="mt-2 text-2xl">Provinsi Sumatera Selatan</p>
            </div>
        </section>

        <!-- Content Section -->
        <section class="max-w-7xl mx-auto">
            <!-- <div class="p-6"> -->
            <div class="section-content px-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                    @foreach ($datas as $item)
                    @endforeach

                </div>

                <div class="my-6">
                    {{ $datas->links('pagination::tailwind') }}
                </div>
            </div>
            <!-- </div> -->
        </section>
    </main>

@endsection
