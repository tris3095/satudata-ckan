@extends('layouts.app')

@section('title', 'Survei Kepuasan Konsumen')

@section('content')
    <main class="mb-12">
        <!-- Hero Section -->
        <section class="hero max-w-7xl mx-auto py-10">
            <div class="px-6 relative text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-red-50 text-red-600 mb-4">
                    <i class="bi bi-clipboard2-heart text-3xl"></i>
                </div>
                <h1 class="text-4xl font-bold text-red-600">Survei <span class="text-black">Kepuasan Konsumen</span></h1>
                <p class="mt-3 text-lg text-gray-600 max-w-2xl mx-auto">
                    Silakan Bapak/Ibu menilai kepuasan layanan Portal Satu Data Sumsel. Pendapat Anda sangat membantu
                    kami meningkatkan kualitas layanan.
                </p>
            </div>
        </section>

        <!-- Content Section -->
        <section class="max-w-3xl mx-auto px-6">

            @if (session('success'))
                <div class="mb-6 flex items-start gap-3 rounded-xl border border-green-200 bg-green-50 text-green-700 px-4 py-3">
                    <i class="bi bi-check-circle-fill text-xl mt-0.5"></i>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 text-red-700 px-4 py-3">
                    <i class="bi bi-exclamation-triangle-fill text-xl mt-0.5"></i>
                    <p>Mohon lengkapi semua pertanyaan yang wajib diisi sebelum mengirim survei.</p>
                </div>
            @endif

            @if ($alreadySubmitted)
                <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-10 text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-green-50 text-green-600 mb-4">
                        <i class="bi bi-check-circle-fill text-3xl"></i>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-800">Terima kasih!</h2>
                    <p class="mt-2 text-gray-500">
                        Anda sudah mengisi Survei Kepuasan Layanan Portal Satu Data Sumsel dari perangkat ini.
                        Setiap perangkat hanya dapat mengisi survei sebanyak satu kali.
                    </p>
                </div>
            @elseif ($pertanyaans->isEmpty())
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-10 text-center text-gray-500">
                    Survei belum tersedia saat ini.
                </div>
            @else
                <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-red-600 to-red-500 px-6 py-4 text-white">
                        <p class="text-sm font-medium">Skala penilaian 1 - 5</p>
                        <p class="text-xs text-red-100">1 = Sangat Buruk/Sulit &nbsp;&middot;&nbsp; 5 = Sangat Bagus/Mudah</p>
                    </div>

                    <form action="{{ route('survei.store') }}" method="POST" id="surveiForm" class="p-6 sm:p-8 space-y-8">
                        @csrf

                        @foreach ($pertanyaans as $pertanyaan)
                            <div class="survey-question {{ $pertanyaan->is_conditional ? 'conditional-question hidden' : '' }}"
                                data-conditional="{{ $pertanyaan->is_conditional ? 'true' : 'false' }}">
                                <div class="flex items-start gap-3">
                                    <span class="flex items-center justify-center w-9 h-9 rounded-full bg-red-50 text-red-600 font-semibold shrink-0">
                                        @if ($pertanyaan->tipe === 'ya_tidak')
                                            <i class="bi bi-patch-question"></i>
                                        @elseif ($pertanyaan->tipe === 'teks')
                                            <i class="bi bi-chat-left-text"></i>
                                        @else
                                            <i class="bi bi-emoji-smile"></i>
                                        @endif
                                    </span>

                                    <div class="flex-1">
                                        <label class="block font-medium text-gray-800">
                                            {{ $pertanyaan->pertanyaan }}
                                            @if ($pertanyaan->is_required)
                                                <span class="text-red-500">*</span>
                                            @endif
                                        </label>

                                        @if ($pertanyaan->tipe === 'skala')
                                            <div class="mt-3 flex items-center gap-3">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <div>
                                                        <input type="radio" id="q{{ $pertanyaan->id }}_{{ $i }}"
                                                            name="jawaban[{{ $pertanyaan->id }}]" value="{{ $i }}"
                                                            class="peer hidden"
                                                            {{ old('jawaban.' . $pertanyaan->id) == $i ? 'checked' : '' }}>
                                                        <label for="q{{ $pertanyaan->id }}_{{ $i }}"
                                                            class="peer-checked:bg-red-600 peer-checked:text-white peer-checked:border-red-600
                                                                w-10 h-10 flex items-center justify-center rounded-full border-2 border-gray-300
                                                                text-gray-500 font-semibold cursor-pointer transition hover:border-red-400">
                                                            {{ $i }}
                                                        </label>
                                                    </div>
                                                @endfor
                                            </div>
                                            <div class="mt-1 flex justify-between text-xs text-gray-400 max-w-[13rem]">
                                                <span>Sangat Buruk</span>
                                                <span>Sangat Bagus</span>
                                            </div>
                                        @elseif ($pertanyaan->tipe === 'ya_tidak')
                                            <div class="mt-3 flex items-center gap-3">
                                                <div>
                                                    <input type="radio" id="q{{ $pertanyaan->id }}_1"
                                                        name="jawaban[{{ $pertanyaan->id }}]" value="1"
                                                        class="peer hidden gate-question"
                                                        {{ old('jawaban.' . $pertanyaan->id) == 1 ? 'checked' : '' }}>
                                                    <label for="q{{ $pertanyaan->id }}_1"
                                                        class="peer-checked:bg-gray-700 peer-checked:text-white peer-checked:border-gray-700
                                                            px-4 py-2 rounded-full border-2 border-gray-300 text-gray-600 font-medium
                                                            cursor-pointer transition hover:border-gray-500">
                                                        Tidak Pernah
                                                    </label>
                                                </div>
                                                <div>
                                                    <input type="radio" id="q{{ $pertanyaan->id }}_2"
                                                        name="jawaban[{{ $pertanyaan->id }}]" value="2"
                                                        class="peer hidden gate-question"
                                                        {{ old('jawaban.' . $pertanyaan->id) == 2 ? 'checked' : '' }}>
                                                    <label for="q{{ $pertanyaan->id }}_2"
                                                        class="peer-checked:bg-red-600 peer-checked:text-white peer-checked:border-red-600
                                                            px-4 py-2 rounded-full border-2 border-gray-300 text-gray-600 font-medium
                                                            cursor-pointer transition hover:border-red-400">
                                                        Pernah
                                                    </label>
                                                </div>
                                            </div>
                                        @else
                                            <textarea name="jawaban[{{ $pertanyaan->id }}]" rows="4"
                                                class="mt-3 w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-red-500 focus:border-red-500"
                                                placeholder="Tuliskan kritik dan saran Anda di sini...">{{ old('jawaban.' . $pertanyaan->id) }}</textarea>
                                        @endif

                                        @error('jawaban.' . $pertanyaan->id)
                                            <span class="text-sm text-red-500 mt-2 block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="pt-2 border-t border-gray-100">
                            <button type="submit"
                                class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-red-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-red-700 transition cursor-pointer">
                                <i class="bi bi-send-fill"></i>
                                Kirim Survei
                            </button>
                        </div>
                    </form>
                </div>
            @endif
        </section>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const gateInputs = document.querySelectorAll('.gate-question');
            const conditionalQuestions = document.querySelectorAll('.conditional-question');

            function applyGateState(value) {
                conditionalQuestions.forEach(function(el) {
                    if (value === '2') {
                        el.classList.remove('hidden');
                    } else {
                        el.classList.add('hidden');
                        el.querySelectorAll('input, textarea').forEach(function(field) {
                            field.checked = false;
                            field.value = '';
                        });
                    }
                });
            }

            gateInputs.forEach(function(input) {
                input.addEventListener('change', function() {
                    applyGateState(this.value);
                });

                if (input.checked) {
                    applyGateState(input.value);
                }
            });
        });
    </script>
@endsection
