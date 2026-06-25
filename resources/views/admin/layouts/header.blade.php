<header id="header"
    class="
        fixed top-0 right-0
        h-16 bg-white shadow-md z-20
        flex items-center justify-between
        px-4 md:px-6
        ml-0 md:ml-64
        left-0
    ">

    <button onclick="toggleSidebar()" class="p-2 rounded-lg hover:bg-gray-100 transition cursor-pointer md:invisible"
        title="Toggle Sidebar">

        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-700" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>

    </button>


    <!-- User Info -->
    <div class="flex items-center gap-4">

        <div class="text-right leading-tight">
            <p class="text-sm font-semibold text-gray-800">
                {{ Auth::user()->name ?? 'Admin' }}
            </p>
            <p class="text-xs text-gray-500">
                {{ Auth::user()->role ?? '' }}
            </p>
        </div>

        <div class="w-px h-6 bg-gray-200"></div>

        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button class="text-sm font-medium text-red-600 hover:text-red-700 transition">
                Logout
            </button>
        </form>

    </div>
</header>
