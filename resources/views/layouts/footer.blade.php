<footer class="relative text-gray-300 mt-20 overflow-hidden"
    style="background-image: url('/images/bg_footer.jpeg'); 
               background-size: cover; 
               background-position: center;">
    <div class="absolute inset-0 opacity-25 pointer-events-none">
        <div class="absolute w-80 h-80 bg-yellow-600 rounded-full blur-3xl animate-pulse -top-10 -left-20"></div>
        <div class="absolute w-96 h-96 bg-yellow-500 rounded-full blur-3xl animate-ping bottom-0 right-0"></div>
    </div>

    <div class="relative container mx-auto px-6 pt-10 pb-5">
        <div class="grid md:grid-cols-3 gap-10">

            <!-- Brand -->
            <div>
                <h2 class="text-2xl font-bold text-white">SATU DATA SUMSEL</h2>
                <p class="text-white mt-3">
                    Portal Satu Data Sumsel merupakan pusat integrasi dan penyebarluasan data Pemerintah Provinsi
                    Sumatera Selatan yang menjamin data akurat, mutakhir, terstandar, dan dapat dipertanggungjawabkan
                    untuk mewujudkan transparansi serta akuntabilitas.
                </p>
            </div>

            <!-- Kontak -->
            <div>
                <h3 class="text-xl font-semibold text-white mb-3">KONTAK</h3>
                <ul class="space-y-2 text-white">
                    <li>Dinas Kominfo Provinsi Sumatera Selatan</li>
                    <li>Jl. Kapten A. Rivai, Palembang</li>
                    <li>Email : satudata@sumselprov.go.id</li>
                    <li>

                        <i class="bi bi-instagram"></i>&nbsp;@satudatasumsel<br>

                    </li>
                    <li>
                        <i class="bi bi-globe"></i>&nbsp;satudata.sumselprov.go.id<br>

                    </li>
                    <li> <i class="bi bi-facebook"></i> &nbsp;Dinas Kominfo Sumsel

                    </li>
                    <li><i class="bi bi-twitter"></i>&nbsp;
                        @sumsel_maju<br>
                        &nbsp; &nbsp;&nbsp;&nbsp; @diskominfosumsel
                    </li>
                    <li><i class="bi bi-youtube"></i> &nbsp;Diskominfo Sumsel</li>



                    {{-- <a href="https://www.facebook.com/pengelolaan.publik/" target="_blank"
                            class="hover:text-white transition transform hover:scale-110" title="Pengelolaan Publik"><i
                                class="bi bi-facebook"></i></a>&nbsp;
                        <a href="https://www.facebook.com/sumselmaju1/" target="_blank"
                            class="hover:text-white transition transform hover:scale-110" title="Sumsel Maju"><i
                                class="bi bi-facebook"></i></a>&nbsp;
                        <a href="https://twitter.com/diskominfoss" target="_blank"
                            class="hover:text-white transition transform hover:scale-110" title="Diskominfoss"><i
                                class="bi bi-twitter"></i></a>&nbsp; --}}

                    {{-- <a href="https://twitter.com/sumsel_maju" target="_blank"
                        class="hover:text-white transition transform hover:scale-110" title="Sumsel Maju"><i
                            class="bi bi-twitter"></i></a>&nbsp;

                    <a href="https://www.youtube.com/diskominfosumsel/" target="_blank"
                        class="hover:text-white transition transform hover:scale-110" title="Diskominfo Sumsel"><i
                            class="bi bi-youtube"></i></a>
                    </li> --}}
                </ul>
            </div>

            <div>
                <h3 class="text-xl font-semibold text-white mb-3">STATISTIK PENGUNJUNG</h3>
                <div>
                    <p class="text-white text-sm">Total Pengunjung</p>
                    <p class="text-3xl font-bold text-white">
                        {{ number_format($totalVisitors) }}
                    </p>

                    <div class="mt-2 space-y-2">
                        <p class="text-white text-sm">Hari ini:
                            <span class="text-white font-semibold">{{ number_format($todayVisitors) }}</span>
                        </p>
                        <p class="text-white text-sm">Bulan ini:
                            <span class="text-white font-semibold">{{ number_format($monthlyVisitors) }}</span>
                        </p>
                        <p class="text-white text-sm">Tahun ini:
                            <span class="text-white font-semibold">{{ number_format($yearlyVisitors) }}</span>
                        </p>
                        {{-- <p class="text-white text-sm">Pengunjung Online:
                            <span class="text-green-400 font-semibold">{{ $visitorOnline ?? 1 }}</span>
                        </p> --}}
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-12 pt-6 border-t border-white flex flex-col md:flex-row items-center justify-between gap-4">
            <p class="text-white text-sm">
                <i class="bi bi-c-circle"></i> {{ date('Y') }} Satu Data Provinsi Sumatera Selatan. Semua hak
                dilindungi.
            </p>

            <!-- Social -->
            <div class="flex gap-4 text-white text-xl">
                <a href="https://www.instagram.com/sumselsatudata/" target="_blank"
                    class="hover:text-white transition transform hover:scale-110">
                    <i class="bi bi-instagram"></i></a>
            </div>
        </div>
    </div>
</footer>
