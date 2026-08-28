<style>
    /* Custom CSS to guarantee spacing and layout without depending on Tailwind recompilation */
    
    .custom-logo-container {
        flex-shrink: 0 !important;
    }
    .custom-logo {
        flex-shrink: 0 !important;
        object-fit: contain !important;
        width: auto !important;
    }
    

    
    /* By default (mobile & tablet < 1024px) */
    .custom-desktop-only {
        display: none !important;
    }
    
    /* On laptop/desktop (>= 1024px) */
    @media (min-width: 1024px) {
        ul.custom-desktop-only {
            display: flex !important;
        }
        button.custom-desktop-only, div.custom-desktop-only {
            display: block !important;
        }
        .custom-mobile-only {
            display: none !important;
        }
        
        .custom-desktop-menu {
            display: flex !important;
            flex-wrap: nowrap !important;
            gap: 10px !important;
            font-size: 11.5px !important;
            justify-content: center !important;
            align-items: center !important;
            white-space: nowrap !important;
        }
        .custom-login-btn {
            display: block !important;
            padding: 5px 12px !important;
            font-size: 11.5px !important;
        }
        .custom-login-container {
            margin-left: 16px !important;
        }
        .custom-logo-container {
            margin-right: 16px !important;
        }
        .custom-logo {
            height: 32px !important;
        }
    }
    
    @media (min-width: 1280px) {
        .custom-desktop-menu {
            gap: 16px !important;
            font-size: 13px !important;
        }
        .custom-login-btn {
            padding: 6px 14px !important;
            font-size: 13px !important;
        }
        .custom-login-container {
            margin-left: 24px !important;
        }
        .custom-logo-container {
            margin-right: 24px !important;
        }
        .custom-logo {
            height: 36px !important;
        }
    }

    @media (min-width: 1440px) {
        .custom-desktop-menu {
            gap: 24px !important;
            font-size: 14.5px !important;
        }
        .custom-login-btn {
            padding: 8px 18px !important;
            font-size: 14.5px !important;
        }
        .custom-login-container {
            margin-left: 32px !important;
        }
        .custom-logo-container {
            margin-right: 32px !important;
        }
        .custom-logo {
            height: 40px !important;
        }
    }
</style>

<nav class="w-full bg-white shadow-sm sticky top-0 z-50">
    <div class="max-w-[1440px] mx-auto flex items-center justify-between py-4 px-6 lg:px-10">

        <!-- Logo -->
        <a href="{{ route('home.index') }}" class="flex items-center custom-logo-container">
            <img src="{{ asset('images/logo-satudata.png') }}" alt="Logo" class="h-8 lg:h-9 xl:h-10 custom-logo">
        </a>

        <!-- Desktop Menu -->
        <ul class="hidden lg:flex lg:space-x-3 xl:space-x-6 text-sm xl:text-[16px] font-medium custom-desktop-menu custom-desktop-only">

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

            <li class="relative group desktop-dropdown">
                <button class="desktop-dropdown-toggle {{ request()->is('metadata*') ? 'text-red-600 font-semibold' : 'hover:text-red-600' }}">
                    Metadata Statistik
                </button>
                <div class="absolute hidden group-hover:block desktop-dropdown-menu bg-white shadow-lg rounded-md py-2 w-48">
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
            <li class="relative group desktop-dropdown">
                <button
                    class="desktop-dropdown-toggle {{ request()->is('publikasi*') ? 'text-red-600 font-semibold' : 'hover:text-red-600' }}">
                    Publikasi
                </button>

                <div class="absolute hidden group-hover:block desktop-dropdown-menu bg-white shadow-lg rounded-md py-2 w-48">
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
                    <a href="{{ route('esakip.documents') }}"
                        class="block px-4 py-2 {{ request()->is('publikasi/dokumen-esakip*') ? 'text-red-600 font-semibold' : 'hover:text-red-600' }}">Dokumen
                        ESakip</a>

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
            <li class="relative group desktop-dropdown">
                <button class="desktop-dropdown-toggle {{ request()->is('tentang*') ? 'text-red-600 font-semibold' : 'hover:text-red-600' }}">
                    Tentang
                </button>
                <div class="absolute right-0 hidden group-hover:block desktop-dropdown-menu bg-white shadow-lg rounded-md py-2 w-48">
                    <a href="{{ route('tentang.profil') }}" class="block px-4 py-2 hover:text-red-600">Profil</a>

                    <a href="https://data.go.id/regulation" class="block px-4 py-2 hover:text-red-600">Regulasi SDI</a>
                </div>
            </li>

            <li class="relative group desktop-dropdown">

                <button class="desktop-dropdown-toggle {{ request()->is('interop*') ? 'text-red-600 font-semibold' : 'hover:text-red-600' }}">
                    Interopabilitas
                </button>
                <div class="absolute right-0 hidden group-hover:block desktop-dropdown-menu bg-white shadow-lg rounded-md py-2 w-48">
                    <a href="https://esakip.sumselprov.go.id" target="_blank"
                        class="block px-4 py-2 hover:text-red-600">E-Sakip

                    </a>

                    <a href="https://ampera.sumselprov.go.id" target="_blank"
                        class="block px-4 py-2 hover:text-red-600">Data
                        Investasi

                    </a>
                    <a href="https://songket.sumselprov.go.id" target="_blank"
                        class="block px-4 py-2 hover:text-red-600">Songket

                    </a>
                </div>
            </li>
            <li>
                <a href="{{ route('survei.index') }}"
                    class="{{ request()->routeIs('survei.*') ? 'text-red-600 font-semibold' : 'hover:text-red-600' }}">
                    Survei Kepuasan Konsumen
                </a>
            </li>
        </ul>

        <!-- Login Button -->
        <div class="relative inline-block text-left custom-desktop-only custom-login-container">
            <button type="button"
                class="hidden lg:block bg-red-600 text-white px-5 py-2 rounded-lg font-semibold hover:bg-red-700 transition cursor-pointer custom-login-btn"
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
        <button id="mobileMenuBtn" class="lg:hidden text-gray-700 text-3xl focus:outline-none custom-mobile-only">
            <i class="bi bi-list"></i>
        </button>

    </div>

    <!-- Mobile Menu Content -->
    <div id="mobileMenu"
        class="hidden lg:hidden bg-white border-t border-gray-100 shadow-inner max-h-[calc(100vh-80px)] overflow-y-auto custom-mobile-only">
        <ul class="flex flex-col px-4 pt-2 pb-6 text-[16px] font-medium">
            <li class="border-b border-gray-100 py-3">
                <a href="{{ route('home.index') }}"
                    class="block {{ request()->routeIs('home.*') || request()->routeIs('group.*') ? 'text-red-600 font-semibold' : 'text-gray-700 hover:text-red-600' }}">Home</a>
            </li>
            <li class="border-b border-gray-100 py-3">
                <a href="https://opendata.sumselprov.go.id/dataset"
                    class="block {{ request()->routeIs('dataset.*') ? 'text-red-600 font-semibold' : 'text-gray-700 hover:text-red-600' }}">Datasets</a>
            </li>
            <li class="border-b border-gray-100 py-3">
                <a href="https://opendata.sumselprov.go.id/organization"
                    class="block {{ request()->routeIs('instantion.*') ? 'text-red-600 font-semibold' : 'text-gray-700 hover:text-red-600' }}">Instansi</a>
            </li>
            <li class="border-b border-gray-100 py-3">
                <button
                    class="w-full flex justify-between items-center toggle-mobile-dropdown {{ request()->is('metadata*') ? 'text-red-600 font-semibold' : 'text-gray-700 hover:text-red-600' }}">
                    <span>Metadata Statistik</span>
                    <i class="bi bi-chevron-down text-sm transition-transform duration-200"></i>
                </button>
                <div class="hidden flex-col mt-2 pl-4 space-y-2 border-l border-gray-200 mobile-dropdown-menu">
                    <a href="{{ route('metadata.show', 1) }}"
                        class="block py-1 {{ request()->is('metadata/kegiatan*') ? 'text-red-600 font-semibold' : 'text-gray-600 hover:text-red-600' }}">Metadata
                        Kegiatan</a>
                    <a href="{{ route('metadata.show', 2) }}"
                        class="block py-1 {{ request()->is('metadata/variabel*') ? 'text-red-600 font-semibold' : 'text-gray-600 hover:text-red-600' }}">Metadata
                        Variabel</a>
                    <a href="{{ route('metadata.show', 3) }}"
                        class="block py-1 {{ request()->is('metadata/indikator*') ? 'text-red-600 font-semibold' : 'text-gray-600 hover:text-red-600' }}">Metadata
                        Indikator</a>
                </div>
            </li>
            <li class="border-b border-gray-100 py-3">
                <button
                    class="w-full flex justify-between items-center toggle-mobile-dropdown {{ request()->is('publikasi*') ? 'text-red-600 font-semibold' : 'text-gray-700 hover:text-red-600' }}">
                    <span>Publikasi</span>
                    <i class="bi bi-chevron-down text-sm transition-transform duration-200"></i>
                </button>
                <div class="hidden flex-col mt-2 pl-4 space-y-2 border-l border-gray-200 mobile-dropdown-menu">
                    <a href="{{ route('news.index') }}"
                        class="block py-1 {{ request()->is('publikasi/berita*') ? 'text-red-600 font-semibold' : 'text-gray-600 hover:text-red-600' }}">Berita
                        Sumsel</a>
                    <a href="{{ route('brs.index') }}"
                        class="block py-1 {{ request()->is('publikasi/brs*') ? 'text-red-600 font-semibold' : 'text-gray-600 hover:text-red-600' }}">Berita
                        Resmi Statistik</a>
                    <a href="{{ route('prs.index') }}"
                        class="block py-1 {{ request()->is('publikasi/produk*') ? 'text-red-600 font-semibold' : 'text-gray-600 hover:text-red-600' }}">Produk
                        Statistik OPD</a>
                    <a href="{{ route('infographics.index') }}"
                        class="block py-1 {{ request()->is('publikasi/infografis*') ? 'text-red-600 font-semibold' : 'text-gray-600 hover:text-red-600' }}">Infografis</a>
                </div>
            </li>
            <li class="border-b border-gray-100 py-3">
                <a href="https://sites.google.com/view/webinarsatudatasumsel/beranda"
                    class="block {{ request()->is('publikasi/webinar*') ? 'text-red-600 font-semibold' : 'text-gray-700 hover:text-red-600' }}">Webinar</a>
            </li>
            <li class="border-b border-gray-100 py-3">
                <a href="https://petatematikvisual.sumselprov.go.id"
                    class="block {{ request()->is('publikasi/geodata*') ? 'text-red-600 font-semibold' : 'text-gray-700 hover:text-red-600' }}">Peta
                    Tematik</a>
            </li>
            <li class="border-b border-gray-100 py-3">
                <button
                    class="w-full flex justify-between items-center toggle-mobile-dropdown {{ request()->is('tentang*') ? 'text-red-600 font-semibold' : 'text-gray-700 hover:text-red-600' }}">
                    <span>Tentang</span>
                    <i class="bi bi-chevron-down text-sm transition-transform duration-200"></i>
                </button>
                <div class="hidden flex-col mt-2 pl-4 space-y-2 border-l border-gray-200 mobile-dropdown-menu">
                    <a href="{{ route('tentang.profil') }}"
                        class="block py-1 text-gray-600 hover:text-red-600">Profil</a>
                    <a href="https://data.go.id/regulation"
                        class="block py-1 text-gray-600 hover:text-red-600">Regulasi SDI</a>
                </div>
            </li>
            <li class="border-b border-gray-100 py-3">
                <a href="https://splp.layanan.go.id" target="_blank"
                    class="block {{ request()->is('regulasi*') ? 'text-red-600 font-semibold' : 'text-gray-700 hover:text-red-600' }}">Interopabilitas</a>
            </li>
            <li class="border-b border-gray-100 py-3">
                <a href="{{ route('survei.index') }}"
                    class="block {{ request()->routeIs('survei.*') ? 'text-red-600 font-semibold' : 'text-gray-700 hover:text-red-600' }}">Survei
                    Kepuasan Konsumen</a>
            </li>
            <li class="py-4">
                <button
                    class="w-full flex justify-between items-center bg-red-600 text-white px-5 py-2 rounded-lg font-semibold hover:bg-red-700 transition toggle-mobile-dropdown">
                    <span>Login</span>
                    <i class="bi bi-chevron-down text-sm transition-transform duration-200"></i>
                </button>
                <div class="hidden flex-col mt-2 bg-gray-50 rounded-md p-2 space-y-2 mobile-dropdown-menu">
                    <a href="{{ route('login') }}"
                        class="block px-2 py-1 text-sm text-gray-700 hover:text-red-600">Login Operator Satu Data</a>
                    <a href="https://opendata.sumselprov.go.id/user/login"
                        class="block px-2 py-1 text-sm text-gray-700 hover:text-red-600">Login Operator CKAN</a>
                    <a href="https://opendata.sumselprov.go.id/user/login"
                        class="block px-2 py-1 text-sm text-gray-700 hover:text-red-600">Login OPD</a>
                    <a href="https://petatematikvisual.sumselprov.go.id/login"
                        class="block px-2 py-1 text-sm text-gray-700 hover:text-red-600">Login Operator Petatematik</a>
                    <a href="#" class="block px-2 py-1 text-sm text-gray-700 hover:text-red-600">Login Operator
                        Dashboard</a>
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

        // Touch-friendly toggle logic for desktop dropdowns (on tablets/touch devices/smart displays)
        const desktopDropdowns = document.querySelectorAll('.desktop-dropdown');

        desktopDropdowns.forEach(dropdown => {
            const toggle = dropdown.querySelector('.desktop-dropdown-toggle');
            const menu = dropdown.querySelector('.desktop-dropdown-menu');
            
            if (toggle && menu) {
                toggle.addEventListener('click', function(e) {
                    e.stopPropagation();
                    
                    const isAlreadyShown = !menu.classList.contains('hidden');
                    
                    // Close all other desktop dropdowns
                    desktopDropdowns.forEach(other => {
                        const otherMenu = other.querySelector('.desktop-dropdown-menu');
                        if (otherMenu) {
                            otherMenu.classList.add('hidden');
                        }
                    });
                    
                    if (!isAlreadyShown) {
                        menu.classList.remove('hidden');
                    } else {
                        menu.classList.add('hidden');
                    }
                });
            }

            // Close dropdown when mouse leaves the dropdown item area (for desktop mouse hover experience)
            dropdown.addEventListener('mouseleave', function() {
                const menu = this.querySelector('.desktop-dropdown-menu');
                if (menu) {
                    menu.classList.add('hidden');
                }
            });
        });

        // Close desktop dropdowns when tapping outside
        document.addEventListener('click', function(e) {
            desktopDropdowns.forEach(dropdown => {
                const menu = dropdown.querySelector('.desktop-dropdown-menu');
                if (menu) {
                    menu.classList.add('hidden');
                }
            });
        });
    });
</script>
