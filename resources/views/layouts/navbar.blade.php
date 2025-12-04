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
                    class="{{ request()->routeIs('home.*') ? 'text-red-600 font-semibold' : 'hover:text-red-600' }}">
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
                    <a href="/tentang/profil" class="block px-4 py-2 hover:text-red-600">Profil</a>
                    <a href="/tentang/struktur" class="block px-4 py-2 hover:text-red-600">Struktur</a>
                </div>
            </li>

            <li>
                <a href="#"
                    class="{{ request()->is('regulasi*') ? 'text-red-600 font-semibold' : 'hover:text-red-600' }}">
                    Regulasi SDI
                </a>
            </li>
        </ul>

        <!-- Login Button -->
        <a href="#"
            class="hidden md:block bg-red-600 text-white px-5 py-2 rounded-lg font-semibold hover:bg-red-700 transition">
            Login
        </a>

        <!-- Mobile Button -->
        <button class="md:hidden text-gray-700 text-3xl">
            <i class="bi bi-list"></i>
        </button>

    </div>
</nav>
