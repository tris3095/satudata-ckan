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
                <a href="{{ route('dataset.index') }}"
                    class="{{ request()->routeIs('dataset.*') ? 'text-red-600 font-semibold' : 'hover:text-red-600' }}">
                    Datasets
                </a>
            </li>

            <li>
                <a href="{{ route('instantion.index') }}"
                    class="{{ request()->routeIs('instantion.*') ? 'text-red-600 font-semibold' : 'hover:text-red-600' }}">
                    Instansi
                </a>
            </li>

            <li>
                <a href="{{ route('insights.index') }}"
                    class="{{ request()->is('data-insight*') ? 'text-red-600 font-semibold' : 'hover:text-red-600' }}">
                    Data Insight
                </a>
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
                    <a href="{{ route('infographics.index') }}"
                        class="block px-4 py-2 {{ request()->is('publikasi/infografis*') ? 'text-red-600 font-semibold' : 'hover:text-red-600' }}">Infografis</a>
                </div>
            </li>

            <!-- Dropdown Tentang -->
            <li class="relative group">
                <button class="{{ request()->is('tentang*') ? 'text-red-600 font-semibold' : 'hover:text-red-600' }}">
                    Tentang
                </button>
                <div class="absolute hidden group-hover:block bg-white shadow-lg rounded-md py-2 w-48">
                    <a href="{{ route('tentang.profil') }}" class="block px-4 py-2 hover:text-red-600">Profil</a>
                    <a href="{{ route('tentang.struktur') }}" class="block px-4 py-2 hover:text-red-600">Struktur</a>
                </div>
            </li>

            <li>
                <a href="https://data.go.id/regulation" target="_blank"
                    class="{{ request()->is('regulasi*') ? 'text-red-600 font-semibold' : 'hover:text-red-600' }}">
                    Regulasi SDI
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
                        <a href="http://103.239.165.103/user/login"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Login Operator CKAN
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Login Operator Geodata Peta
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
        <button class="md:hidden text-gray-700 text-3xl">
            <i class="bi bi-list"></i>
        </button>

    </div>
</nav>
