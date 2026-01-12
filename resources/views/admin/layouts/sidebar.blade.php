<aside id="sidebar"
    class="fixed top-0 left-0 z-40 w-64
           h-[100dvh] bg-white
           transform -translate-x-full md:translate-x-0
           transition-transform duration-300 ease-in-out
           flex flex-col">

    <!-- Logo -->
    <div class="h-16 flex items-center justify-center">
        <img src="{{ asset('images/logo-satudata.png') }}" alt="Satu Data Sumsel" class="h-9">
    </div>

    <!-- Menu -->
    <nav class="flex-1 px-4 py-6 text-sm space-y-1">

        <a href="{{ route('admin.dashboard.index') }}"
            class="flex items-center gap-3 px-3 py-2 rounded-lg transition
           {{ request()->routeIs('admin.dashboard.index')
               ? 'bg-red-50 text-red-700 font-semibold shadow-sm'
               : 'text-gray-700 hover:bg-gray-100' }}">
            <i class="bi bi-speedometer2"></i>
            Dashboard
        </a>

        <a href="{{ route('admin.banner.index') }}"
            class="flex items-center gap-3 px-3 py-2 rounded-lg transition
       {{ request()->routeIs('admin.banner.index')
           ? 'bg-red-50 text-red-700 font-semibold shadow-sm'
           : 'text-gray-700 hover:bg-gray-100' }}">
            <i class="bi bi-image"></i>
            Banner
        </a>

        <a href="{{ route('admin.infographic.index') }}"
            class="flex items-center gap-3 px-3 py-2 rounded-lg transition
       {{ request()->routeIs('admin.infographic.index')
           ? 'bg-red-50 text-red-700 font-semibold shadow-sm'
           : 'text-gray-700 hover:bg-gray-100' }}">
            <i class="bi bi-bar-chart"></i>
            Infografis
        </a>

        <a href="{{ route('admin.webinar.index') }}"
            class="flex items-center gap-3 px-3 py-2 rounded-lg transition
       {{ request()->routeIs('admin.webinar.index')
           ? 'bg-red-50 text-red-700 font-semibold shadow-sm'
           : 'text-gray-700 hover:bg-gray-100' }}">
            <i class="bi bi-camera-video"></i>
            Webinar
        </a>

        {{-- <a href="{{ route('admin.user.index') }}"
            class="flex items-center gap-3 px-3 py-2 rounded-lg transition
           {{ request()->routeIs('admin.user.index')
               ? 'bg-red-50 text-red-700 font-semibold shadow-sm'
               : 'text-gray-700 hover:bg-gray-100' }}">
            <i class="bi bi-people"></i>
            Pengguna
        </a> --}}

    </nav>

    <!-- Footer -->
    <div class="p-4 text-xs text-gray-400">
        © {{ date('Y') }} Satu Data Sumsel
    </div>
</aside>
