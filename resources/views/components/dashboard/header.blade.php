<header class="z-10 py-4 shadow-md bg-gradient-to-r from-primaryPoi25 to-primaryPoi25-200">
    <div class="container flex items-center justify-between h-full px-6 mx-auto text-purple-600 dark:text-purple-300">
        <!-- Mobile hamburger -->
        <button
            class="p-1 mr-5 -ml-1 rounded-md md:hidden focus:outline-none focus:text-gray-800 hover:text-gray-800 text-gray-600"
            @click="toggleSideMenu" aria-label="Menu">
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                    clip-rule="evenodd"></path>
            </svg>
        </button>
        @livewire('language-switcher')
        <ul class="flex items-center flex-shrink-0 space-x-6 ml-auto">
            <!-- Profile menu -->
            <li class="relative">
                <button
                    class="text-sm font-medium text-gray-700 hover:text-gray-900 flex items-center px-2 focus:outline-none"
                    @click="toggleProfileMenu" @keydown.escape="closeProfileMenu" aria-label="Account"
                    aria-haspopup="true">
                    <span class="mr-2">{{ __('dashboard.halo') }} {{ Auth::user()->name }}</span>
                    <div class="align-middle rounded-full">
                        <img class="object-cover w-8 h-8 rounded-full" src="{{ Auth::user()->profile_photo_url }}"
                            alt="" aria-hidden="true" />
                    </div>
                </button>
                {{-- <template x-if="isProfileMenuOpen" x-cloak> --}}
                <ul x-show="isProfileMenuOpen" x-cloak x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                    @click.away="closeProfileMenu" @keydown.escape="closeProfileMenu"
                    class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-primaryPoi25 light:border light:border-gray-100 rounded-md shadow-md"
                    aria-label="submenu">
                    <!-- Begin Profile -->
                    <x-dropdown-link href="{{ route('profile.show') }}">
                        {{ __('dashboard.profil') }}
                    </x-dropdown-link>
                    <!-- Begin Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link href="{{ route('logout') }}"
                            onclick="event.preventDefault();this.closest('form').submit();">
                            {{ __('dashboard.keluar') }}
                        </x-dropdown-link>
                    </form>
                </ul>
                {{-- </template> --}}
            </li>
        </ul>
    </div>
</header>
