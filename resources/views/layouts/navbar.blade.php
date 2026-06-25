<nav class="w-full bg-white shadow-sm sticky top-0 z-50">
    <div class="max-w-screen-xl mx-auto flex items-center justify-between py-4 px-4">

        <!-- Logo -->
        <a href="{{ route('home.index') }}" class="flex items-center">
            <img src="{{ asset('images/logo-satudata.png') }}" alt="Logo" class="h-10">
        </a>

        <!-- Desktop Menu -->
        <ul class="hidden md:flex space-x-8 text-[16px] font-medium">

            <li>
                <a href="{{ route('home.index') }}"
                    class="{{ request()->routeIs('home.*') || request()->routeIs('group.*') ? 'text-red-600 font-semibold' : 'hover:text-red-600' }}">
                    Home
                </a>
            </li>

            <li>
                <a href="https://opendata.sumselprov.go.id/dataset"
                    class="{{ request()->routeIs('dataset.*') ? 'text-red-600 font-semibold' : 'hover:text-red-600' }}">
                    Datasets
                </a>
            </li>

            <li>
                <a href="https://opendata.sumselprov.go.id/organization"
                    class="{{ request()->routeIs('instantion.*') ? 'text-red-600 font-semibold' : 'hover:text-red-600' }}">
                    Instansi
                </a>
            </li>

            <li class="relative group">
                <button class="{{ request()->is('metadata*') ? 'text-red-600 font-semibold' : 'hover:text-red-600' }}">
                    Metadata Statistik
                </button>
                <div class="absolute hidden group-hover:block bg-white shadow-lg rounded-md py-2 w-48">
                    <a href="{{ route('metadata.show', 1) }}"
                        class="block px-4 py-2 {{ request()->is('metadata/kegiatan*') ? 'text-red-600 font-semibold' : 'hover:text-red-600' }}">Metadata
                        Kegiatan
                    </a>
                    <a href="{{ route('metadata.show', 2) }}"
                        class="block px-4 py-2 {{ request()->is('metadata/variabel*') ? 'text-red-600 font-semibold' : 'hover:text-red-600' }}">Metadata
                        Variabel
                    </a>
                    <a href="{{ route('metadata.show', 3) }}"
                        class="block px-4 py-2 {{ request()->is('metadata/indikator*') ? 'text-red-600 font-semibold' : 'hover:text-red-600' }}">Metadata
                        Indikator</a>

                </div>
            </li>

            <!-- Dropdown Publikasi -->
            <li class="relative group">
                <button
                    class="{{ request()->is('publikasi*') ? 'text-red-600 font-semibold' : 'hover:text-red-600' }}">
                    Publikasi
                </button>

                <div class="absolute hidden group-hover:block bg-white shadow-lg rounded-md py-2 w-48">
                    <a href="{{ route('news.index') }}"
                        class="block px-4 py-2 {{ request()->is('publikasi/berita*') ? 'text-red-600 font-semibold' : 'hover:text-red-600' }}">Berita
                        Sumsel</a>
                    <a href="{{ route('brs.index') }}"
                        class="block px-4 py-2 {{ request()->is('publikasi/brs*') ? 'text-red-600 font-semibold' : 'hover:text-red-600' }}">Berita
                        Resmi Statistik</a>
                    <a href="{{ route('prs.index') }}"
                        class="block px-4 py-2 {{ request()->is('publikasi/produk*') ? 'text-red-600 font-semibold' : 'hover:text-red-600' }}">Produk
                        Statistik OPD</a>


                    <a href="{{ route('infographics.index') }}"
                        class="block px-4 py-2 {{ request()->is('publikasi/infografis*') ? 'text-red-600 font-semibold' : 'hover:text-red-600' }}">Infografis</a>

                </div>
            </li>
            <li>
                <a href="https://sites.google.com/view/webinarsatudatasumsel/beranda"
                    class=" {{ request()->is('publikasi/webinar*') ? 'text-red-600 font-semibold' : 'hover:text-red-600' }}">Webinar</a>

            </li>
            <li>
                <a href="https://petatematikvisual.sumselprov.go.id"
                    class="{{ request()->is('publikasi/geodata*') ? 'text-red-600 font-semibold' : 'hover:text-red-600' }}">
                    Peta Tematik</a>

            </li>

            <!-- Dropdown Tentang -->
            <li class="relative group">
                <button class="{{ request()->is('tentang*') ? 'text-red-600 font-semibold' : 'hover:text-red-600' }}">
                    Tentang
                </button>
                <div class="absolute hidden group-hover:block bg-white shadow-lg rounded-md py-2 w-48">
                    <a href="{{ route('tentang.profil') }}" class="block px-4 py-2 hover:text-red-600">Profil</a>

                    <a href="https://data.go.id/regulation" class="block px-4 py-2 hover:text-red-600">Regulasi SDI</a>
                </div>
            </li>

            <li>
                <a href="https://splp.layanan.go.id" target="_blank"
                    class="{{ request()->is('regulasi*') ? 'text-red-600 font-semibold' : 'hover:text-red-600' }}">
                    Interopabilitas
                </a>
            </li>
            <li>
                <a href="{{ route('survei.index') }}"
                    class="{{ request()->routeIs('survei.*') ? 'text-red-600 font-semibold' : 'hover:text-red-600' }}">
                    Survei Kepuasan Konsumen
                </a>
            </li>
        </ul>

        <!-- Login Button -->
        <div class="relative inline-block text-left">
            <button type="button"
                class="hidden md:block bg-red-600 text-white px-5 py-2 rounded-lg font-semibold hover:bg-red-700 transition cursor-pointer"
                id="loginMenuButton">
                Login
            </button>

            <!-- Dropdown menu -->
            <div id="loginMenu"
                class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5">
                <ul class="py-1">
                    <li>
                        <a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Login Operator Satu Data
                        </a>
                    </li>
                    <li>
                        <a href="https://opendata.sumselprov.go.id/user/login"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Login Operator CKAN
                        </a>
                    </li>
                    <li>
                        <a href="https://opendata.sumselprov.go.id/user/login"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Login OPD
                        </a>
                    </li>
                    <li>
                        <a href="https://petatematikvisual.sumselprov.go.id/login"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Login Operator Petatematik
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Login Operator Dashboard
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Mobile Button -->
        <button id="mobileMenuBtn" class="md:hidden text-gray-700 text-3xl focus:outline-none">
            <i class="bi bi-list"></i>
        </button>

    </div>

    <!-- Mobile Menu Content -->
    <div id="mobileMenu" class="hidden md:hidden bg-white border-t border-gray-100 shadow-inner max-h-[calc(100vh-80px)] overflow-y-auto">
        <ul class="flex flex-col px-4 pt-2 pb-6 text-[16px] font-medium">
            <li class="border-b border-gray-100 py-3">
                <a href="{{ route('home.index') }}" class="block {{ request()->routeIs('home.*') || request()->routeIs('group.*') ? 'text-red-600 font-semibold' : 'text-gray-700 hover:text-red-600' }}">Home</a>
            </li>
            <li class="border-b border-gray-100 py-3">
                <a href="https://opendata.sumselprov.go.id/dataset" class="block {{ request()->routeIs('dataset.*') ? 'text-red-600 font-semibold' : 'text-gray-700 hover:text-red-600' }}">Datasets</a>
            </li>
            <li class="border-b border-gray-100 py-3">
                <a href="https://opendata.sumselprov.go.id/organization" class="block {{ request()->routeIs('instantion.*') ? 'text-red-600 font-semibold' : 'text-gray-700 hover:text-red-600' }}">Instansi</a>
            </li>
            <li class="border-b border-gray-100 py-3">
                <button class="w-full flex justify-between items-center toggle-mobile-dropdown {{ request()->is('metadata*') ? 'text-red-600 font-semibold' : 'text-gray-700 hover:text-red-600' }}">
                    <span>Metadata Statistik</span>
                    <i class="bi bi-chevron-down text-sm transition-transform duration-200"></i>
                </button>
                <div class="hidden flex-col mt-2 pl-4 space-y-2 border-l border-gray-200 mobile-dropdown-menu">
                    <a href="{{ route('metadata.show', 1) }}" class="block py-1 {{ request()->is('metadata/kegiatan*') ? 'text-red-600 font-semibold' : 'text-gray-600 hover:text-red-600' }}">Metadata Kegiatan</a>
                    <a href="{{ route('metadata.show', 2) }}" class="block py-1 {{ request()->is('metadata/variabel*') ? 'text-red-600 font-semibold' : 'text-gray-600 hover:text-red-600' }}">Metadata Variabel</a>
                    <a href="{{ route('metadata.show', 3) }}" class="block py-1 {{ request()->is('metadata/indikator*') ? 'text-red-600 font-semibold' : 'text-gray-600 hover:text-red-600' }}">Metadata Indikator</a>
                </div>
            </li>
            <li class="border-b border-gray-100 py-3">
                <button class="w-full flex justify-between items-center toggle-mobile-dropdown {{ request()->is('publikasi*') ? 'text-red-600 font-semibold' : 'text-gray-700 hover:text-red-600' }}">
                    <span>Publikasi</span>
                    <i class="bi bi-chevron-down text-sm transition-transform duration-200"></i>
                </button>
                <div class="hidden flex-col mt-2 pl-4 space-y-2 border-l border-gray-200 mobile-dropdown-menu">
                    <a href="{{ route('news.index') }}" class="block py-1 {{ request()->is('publikasi/berita*') ? 'text-red-600 font-semibold' : 'text-gray-600 hover:text-red-600' }}">Berita Sumsel</a>
                    <a href="{{ route('brs.index') }}" class="block py-1 {{ request()->is('publikasi/brs*') ? 'text-red-600 font-semibold' : 'text-gray-600 hover:text-red-600' }}">Berita Resmi Statistik</a>
                    <a href="{{ route('prs.index') }}" class="block py-1 {{ request()->is('publikasi/produk*') ? 'text-red-600 font-semibold' : 'text-gray-600 hover:text-red-600' }}">Produk Statistik OPD</a>
                    <a href="{{ route('infographics.index') }}" class="block py-1 {{ request()->is('publikasi/infografis*') ? 'text-red-600 font-semibold' : 'text-gray-600 hover:text-red-600' }}">Infografis</a>
                </div>
            </li>
            <li class="border-b border-gray-100 py-3">
                <a href="https://sites.google.com/view/webinarsatudatasumsel/beranda" class="block {{ request()->is('publikasi/webinar*') ? 'text-red-600 font-semibold' : 'text-gray-700 hover:text-red-600' }}">Webinar</a>
            </li>
            <li class="border-b border-gray-100 py-3">
                <a href="https://petatematikvisual.sumselprov.go.id" class="block {{ request()->is('publikasi/geodata*') ? 'text-red-600 font-semibold' : 'text-gray-700 hover:text-red-600' }}">Peta Tematik</a>
            </li>
            <li class="border-b border-gray-100 py-3">
                <button class="w-full flex justify-between items-center toggle-mobile-dropdown {{ request()->is('tentang*') ? 'text-red-600 font-semibold' : 'text-gray-700 hover:text-red-600' }}">
                    <span>Tentang</span>
                    <i class="bi bi-chevron-down text-sm transition-transform duration-200"></i>
                </button>
                <div class="hidden flex-col mt-2 pl-4 space-y-2 border-l border-gray-200 mobile-dropdown-menu">
                    <a href="{{ route('tentang.profil') }}" class="block py-1 text-gray-600 hover:text-red-600">Profil</a>
                    <a href="https://data.go.id/regulation" class="block py-1 text-gray-600 hover:text-red-600">Regulasi SDI</a>
                </div>
            </li>
            <li class="border-b border-gray-100 py-3">
                <a href="https://splp.layanan.go.id" target="_blank" class="block {{ request()->is('regulasi*') ? 'text-red-600 font-semibold' : 'text-gray-700 hover:text-red-600' }}">Interopabilitas</a>
            </li>
            <li class="border-b border-gray-100 py-3">
                <a href="{{ route('survei.index') }}" class="block {{ request()->routeIs('survei.*') ? 'text-red-600 font-semibold' : 'text-gray-700 hover:text-red-600' }}">Survei Kepuasan Konsumen</a>
            </li>
            <li class="py-4">
                <button class="w-full flex justify-between items-center bg-red-600 text-white px-5 py-2 rounded-lg font-semibold hover:bg-red-700 transition toggle-mobile-dropdown">
                    <span>Login</span>
                    <i class="bi bi-chevron-down text-sm transition-transform duration-200"></i>
                </button>
                <div class="hidden flex-col mt-2 bg-gray-50 rounded-md p-2 space-y-2 mobile-dropdown-menu">
                    <a href="{{ route('login') }}" class="block px-2 py-1 text-sm text-gray-700 hover:text-red-600">Login Operator Satu Data</a>
                    <a href="https://opendata.sumselprov.go.id/user/login" class="block px-2 py-1 text-sm text-gray-700 hover:text-red-600">Login Operator CKAN</a>
                    <a href="https://opendata.sumselprov.go.id/user/login" class="block px-2 py-1 text-sm text-gray-700 hover:text-red-600">Login OPD</a>
                    <a href="https://petatematikvisual.sumselprov.go.id/login" class="block px-2 py-1 text-sm text-gray-700 hover:text-red-600">Login Operator Petatematik</a>
                    <a href="#" class="block px-2 py-1 text-sm text-gray-700 hover:text-red-600">Login Operator Dashboard</a>
                </div>
            </li>
        </ul>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        
        if (mobileMenuBtn && mobileMenu) {
            mobileMenuBtn.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
                const icon = mobileMenuBtn.querySelector('i');
                if (icon.classList.contains('bi-list')) {
                    icon.classList.remove('bi-list');
                    icon.classList.add('bi-x', 'text-4xl');
                } else {
                    icon.classList.remove('bi-x', 'text-4xl');
                    icon.classList.add('bi-list');
                }
            });
        }

        const dropdownToggles = document.querySelectorAll('.toggle-mobile-dropdown');
        dropdownToggles.forEach(toggle => {
            toggle.addEventListener('click', function() {
                const menu = this.nextElementSibling;
                if (menu && menu.classList.contains('mobile-dropdown-menu')) {
                    menu.classList.toggle('hidden');
                    menu.classList.toggle('flex');
                    const icon = this.querySelector('i');
                    if (icon) {
                        if (menu.classList.contains('hidden')) {
                            icon.style.transform = 'rotate(0deg)';
                        } else {
                            icon.style.transform = 'rotate(180deg)';
                        }
                    }
                }
            });
        });
    });
</script>
