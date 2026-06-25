@extends('admin.layouts.master')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

    <!-- Statistik Ringkas -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">

        <div class="bg-white border rounded-lg p-5">
            <p class="text-sm text-gray-500">Total Banner</p>
            <h3 class="mt-2 text-2xl font-semibold text-gray-800">{{ $bannerCount ?? 0 }}</h3>
        </div>

        <div class="bg-white border rounded-lg p-5">
            <p class="text-sm text-gray-500">Total Infografis</p>
            <h3 class="mt-2 text-2xl font-semibold text-gray-800">{{ $infographicCount ?? 0 }}</h3>
        </div>

        <div class="bg-white border rounded-lg p-5">
            <p class="text-sm text-gray-500">Total Pengguna</p>
            <h3 class="mt-2 text-2xl font-semibold text-gray-800">{{ $userCount ?? 0 }}</h3>
        </div>

        <div class="bg-white border rounded-lg p-5">
            <p class="text-sm text-gray-500">Kunjungan Hari Ini</p>
            <h3 class="mt-2 text-2xl font-semibold text-gray-800">{{ number_format($todayVisitors) }}</h3>
        </div>

    </div>

@endsection
