@extends('admin.layouts.app')

@section('title', 'Halaman Tidak Ditemukan')

@section('content')
    <div class="w-full max-w-md text-center">
        <div class="bg-white/95 backdrop-blur-xl shadow-2xl rounded-3xl p-10 relative overflow-hidden">

            <!-- Glow -->
            <div class="absolute -top-24 -right-24 w-56 h-56 bg-red-500/20 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-24 -left-24 w-56 h-56 bg-rose-500/20 rounded-full blur-3xl"></div>

            <div class="relative">
                <div
                    class="mx-auto w-20 h-20 flex items-center justify-center
                       bg-gradient-to-br from-red-700 to-red-500
                       text-white text-3xl font-extrabold shadow-lg py-2">
                    404
                </div>

                <div class="p-3">
                    <h1 class="mt-6 text-2xl font-extrabold text-gray-800">
                        Halaman Tidak Ditemukan
                    </h1>

                    <p class="mt-2 text-sm text-gray-500">
                        Data atau halaman yang Anda cari tidak tersedia atau telah dipindahkan.
                    </p>
                </div>

                <a href="{{ url('/') }}"
                    class="inline-block mt-8 px-6 py-3 rounded-xl
                       bg-gradient-to-r from-red-700 to-red-500
                       text-white font-semibold
                       hover:from-red-800 hover:to-red-600
                       transition shadow-lg">
                    Kembali ke Beranda
                </a>
            </div>
        </div>

        <p class="text-xs text-white/80 mt-6">
            © {{ date('Y') }} Satu Data Sumsel
        </p>
    </div>
@endsection
