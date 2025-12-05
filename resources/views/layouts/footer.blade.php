<footer class="relative bg-red-900 text-gray-300 mt-20 overflow-hidden">
    <div class="absolute inset-0 opacity-25 pointer-events-none">
        <div class="absolute w-80 h-80 bg-yellow-600 rounded-full blur-3xl animate-pulse -top-10 -left-20"></div>
        <div class="absolute w-96 h-96 bg-yellow-500 rounded-full blur-3xl animate-ping bottom-0 right-0"></div>
    </div>

    <div class="relative container mx-auto px-6 py-10">
        <div class="grid md:grid-cols-3 gap-10">

            <!-- Brand -->
            <div>
                <h2 class="text-2xl font-bold text-white">Satu Data Sumsel</h2>
                <p class="text-gray-400 mt-3">
                    Portal resmi penyediaan data terpadu, akurat, mutakhir dan dapat dipertanggungjawabkan untuk
                    Provinsi Sumatera Selatan.
                </p>
            </div>

            <!-- Kontak -->
            <div>
                <h3 class="text-xl font-semibold text-white mb-3">Kontak</h3>
                <ul class="space-y-2">
                    <li>Dinas Kominfo Provinsi Sumatera Selatan</li>
                    <li>Jl. Kapten A. Rivai, Palembang</li>
                    <li>Email: kominfo@sumselprov.go.id</li>
                </ul>
            </div>

            <div>
                <h3 class="text-xl font-semibold text-white mb-3">Statistik Pengunjung</h3>
                <div>
                    <p class="text-gray-400 text-sm">Total Pengunjung</p>
                    <p class="text-3xl font-bold text-white">
                        {{ number_format($visitorTotal ?? 0) }}
                    </p>

                    <div class="mt-4 pt-4 space-y-2">
                        <p class="text-gray-400 text-sm">Hari ini:
                            <span class="text-white font-semibold">{{ number_format($visitorToday ?? 0) }}</span>
                        </p>
                        <p class="text-gray-400 text-sm">Bulan ini:
                            <span class="text-white font-semibold">{{ number_format($visitorMonth ?? 0) }}</span>
                        </p>
                        <p class="text-gray-400 text-sm">Pengunjung Online:
                            <span class="text-green-400 font-semibold">{{ $visitorOnline ?? 1 }}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-12 pt-6 border-t border-gray-400 flex flex-col md:flex-row items-center justify-between gap-4">
            <p class="text-gray-400 text-sm">
                <i class="bi bi-c-circle"></i> {{ date('Y') }} Satu Data Provinsi Sumatera Selatan. Semua hak
                dilindungi.
            </p>

            <!-- Social -->
            <div class="flex gap-4 text-gray-400 text-xl">
                <a href="https://www.instagram.com/sumselsatudata/" target="_blank"
                    class="hover:text-white transition transform hover:scale-110">
                    <i class="bi bi-instagram"></i></a>
            </div>

        </div>
    </div>
</footer>
