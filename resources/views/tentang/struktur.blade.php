@extends('layouts.app')

@section('title', 'Struktur')

@section('content')
    <section class="hero max-w-7xl mx-auto py-8">
        <div class="px-3 md:px-5 relative">
            <h1 class="text-2xl md:text-4xl font-bold text-red-600">Struktur <span class="text-black">Satu Data</span></h1>
            <p class="text-lg md:text-2xl">Provinsi Sumatera Selatan</p>
        </div>
    </section>

    <section class="max-w-7xl mx-auto lg:py-8">
        <div class="px-3 md:px-5">
            <div class="relative w-full h-full rounded-lg overflow-hidden grid grid-cols-1 md:grid-cols-2">
                <img class="w-full h-full bg-center" src="{{ asset('images/logo-satudata.png') }}">
            </div>
        </div>
    </section>
    
@endsection