<!-- Desktop sidebar -->
<aside
    class="z-20 hidden w-64 overflow-y-auto bg-primaryPoi25-50 md:block flex-shrink-0 border-r-2 border-gray-100 scroll-style">
    <div class="py-4 text-gray-800">
        <div class="flex flex-row items-center justify-center">
            <a href="/">
                <img src="{{ asset('img/logo-2025-icon.png') }}" alt="" width="75">
            </a>
            <a href="/">
                <span class="ml-2 text-md font-semibold">POISSON 2025</span>
            </a>
        </div>

        {{ $slot }}

    </div>
</aside>
<!-- Mobile sidebar -->
<aside
    class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-16 overflow-y-auto bg-primaryPoi25-50 md:hidden border-r-2 border-gray-100 scroll-style"
    x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150"
    x-transition:enter-start="opacity-0 transform -translate-x-20" x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0 transform -translate-x-20" @click.away="closeSideMenu"
    @keydown.escape="closeSideMenu" x-cloak>
    <div class="py-4 text-gray-800">
        <div class="flex flex-row items-center justify-center">
            <a href="#">
                <img src="{{ asset('img/logo-2025-icon.png') }}" alt="" width="75">
            </a>
            <a href="#">
                <span class="ml-2 text-md font-semibold">POISSON 2025</span>
            </a>
        </div>

        {{ $slot }}

    </div>
</aside>
