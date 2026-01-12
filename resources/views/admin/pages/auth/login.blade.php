@extends('admin.layouts.app')

@section('title', 'Login')

@section('content')
    <div class="w-full max-w-md">
        <div class="bg-white/95 backdrop-blur-xl shadow-2xl rounded-3xl p-8 relative overflow-hidden">

            <!-- Glow merah -->
            <div class="absolute -top-20 -right-20 w-48 h-48 bg-red-500/20 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-20 -left-20 w-48 h-48 bg-rose-500/20 rounded-full blur-3xl"></div>

            <!-- Header -->
            <div class="relative text-center mb-8">
                <div class="mx-auto flex items-center justify-center">
                    <img src="{{ asset('images/logo-satudata.png') }}" alt="Satu Data Sumsel" class="object-contain">
                </div>

                <p class="text-sm text-gray-500">
                    Masuk ke dashboard administrator
                </p>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email -->
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1 uppercase tracking-wide">
                        Email
                    </label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm bg-gray-50
                           focus:bg-white focus:outline-none focus:ring-2
                           focus:ring-red-600 focus:border-red-600 transition">
                    @error('email')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="relative">
                    <label class="block text-xs font-semibold text-gray-600 mb-1 uppercase tracking-wide">
                        Password
                    </label>
                    <div class="relative">
                        <input id="password" type="password" name="password" required
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm bg-gray-50
                   focus:bg-white focus:outline-none focus:ring-2
                   focus:ring-red-600 focus:border-red-600 transition">

                        <!-- Tombol toggle dengan bi icon -->
                        <button type="button" onclick="togglePassword()"
                            class="absolute inset-y-0 right-3 flex items-center text-gray-500 hover:text-red-600 focus:outline-none cursor-pointer">
                            <i id="toggleIcon" class="bi bi-eye"></i>
                        </button>
                    </div>

                    @error('password')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember -->
                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center gap-2 text-gray-600 cursor-pointer">
                        <input type="checkbox" name="remember"
                            class="rounded text-red-600 focus:ring-red-600 cursor-pointer">
                        Ingat Saya
                    </label>
                    {{-- <a href="{{ route('password.request') }}" class="text-red-600 hover:underline">
                        Lupa password?
                    </a> --}}
                </div>

                <!-- Button -->
                <button type="submit"
                    class="w-full py-3 rounded-xl
                       bg-gradient-to-r from-red-700 to-red-500
                       text-white font-semibold
                       hover:from-red-800 hover:to-red-600
                       transition shadow-lg cursor-pointer">
                    Masuk
                </button>
            </form>

            <!-- Footer -->
            <p class="text-center text-xs text-gray-400 mt-8">
                © {{ date('Y') }} Satu Data Sumsel
            </p>
        </div>
    </div>
@endsection

<script>
    function togglePassword() {
        const input = document.getElementById('password');
        const icon = document.getElementById('toggleIcon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('bi-eye-slash', 'bi-eye');
        }
    }
</script>
