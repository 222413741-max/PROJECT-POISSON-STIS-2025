<div x-data="{ isModalOpen: @entangle('isModalOpen'), search: false }">
    <x-button wire:click="openModal">{{ __('dashboard.Tambah Admin Baru') }}</x-button>
    <form wire:submit.prevent="addAdmin" x-show="isModalOpen"
        class="fixed inset-0 z-30 flex bg-black bg-opacity-50 items-center justify-center" x-cloak>
        <!-- Modal -->
        <div x-show="isModalOpen" class="w-full px-6 py-4 bg-primaryPoi25 rounded-md shadow-md m-4 max-w-xl"
            role="dialog">
            <div class="my-2 relative">
                <div class="flex justify-between items-center mb-4">
                    <p class="text-lg font-semibold text-gray-700 capitalize leading-3 dark:text-gray-300">
                        {{ __('dashboard.Tambah Admin Baru') }}</p>
                    <button
                        class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover: hover:text-gray-700"
                        aria-label="close" wire:click="closeModal">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" role="img" aria-hidden="true">
                            <path
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" fill-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <div class="text-sm text-gray-700">
                    <x-input type="text" wire:model="search" placeholder="{{ __('dashboard.Cari pengguna') }}..."
                        x-on:input="search = true" class="block w-full" />
                    <ul x-show="search" @click.away="search = false"
                        class="absolute w-full left-0 my-2 bg-white border border-gray-200 rounded-md shadow-sm dark:bg-dark-700 dark:border-dark-800">
                        @forelse($users as $u)
                            <li wire:click="selectUser({{ $u }})" x-on:click="search = false"
                                class="px-4 py-2 cursor-pointer hover:bg-gray-200 dark:bg-primaryPoisson-800 dark:hover:bg-dark dark:text-gray-300">
                                <p>{{ $u->name }} - <span class="italic">{{ $u->email }}</span> </p>
                            </li>
                        @empty
                            <li
                                class="px-4 py-2 italic dark:bg-primaryPoisson-800 dark:hover:bg-dark dark:text-gray-300">
                                <p>{{ __('dashboard.No user found') }}</p>
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
            <footer
                class="flex flex-col items-center justify-end pt-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-primaryPoi25">
                <x-button> {{ __('dashboard.Tambahkan admin baru') }} </x-button>
            </footer>
        </div>
    </form>

</div>
