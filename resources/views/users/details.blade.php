<div class="lg:grid lg:grid-cols-3 md:gap-6">
    <div class="md:col-span-1">
        <div class="px-4 py-5 mb-5 bg-primaryPoi25 sm:p-6 shadow sm:rounded-md">
            <div class="mt-2 mb-4 flex justify-center">
                <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}"
                    class="rounded-full h-40 w-40 object-cover">
            </div>
        </div>
    </div>
    <div class="md:col-span-2">
        <div class="px-4 py-5 mb-5 bg-primaryPoi25 sm:p-6 shadow sm:rounded-md">
            <h2 class="font-bold mb-6 text-lg dark:text-gray-300">{{ __('dashboard.Informasi Profil') }}</h2>
            <div class="md:flex mb-6">
                <div class="md:w-1/3">
                    <span class="text-gray-500 dark:text-gray-400">{{ __('Nama') }}</span>
                </div>
                <div class="md:w-2/3 dark:text-gray-300">
                    {{ $user->name }}
                </div>
            </div>
            <div class="md:flex mb-6">
                <div class="md:w-1/3">
                    <span class="text-gray-500 dark:text-gray-400">Email</span>
                </div>
                <div class="md:w-2/3 dark:text-gray-300">
                    {{ $user->email }}
                </div>
            </div>
            <div class="md:flex mb-6">
                <div class="md:w-1/3">
                    <span class="text-gray-500 dark:text-gray-400">{{ __('dashboard.Tipe Akun') }}</span>
                </div>
                <div class="md:w-2/3 dark:text-gray-300">
                    {{ $user->university_tipe == 0 ? __('dashboard.universitas') : ($user->university_tipe == 1 ? __('dashboard.SMA') : __('dashboard.universitas_luar')) }}
                </div>
            </div>
            <div class="md:flex mb-6">
                <div class="md:w-1/3">
                    <span class="text-gray-500 dark:text-gray-400">{{ __('dashboard.Universitas / Sekolah') }}</span>
                </div>
                <div class="md:w-2/3 dark:text-gray-300">
                    {{ $user->college }}
                </div>
            </div>
            <div class="md:flex mb-6">
                <div class="md:w-1/3">
                    <span class="text-gray-500 dark:text-gray-400">{{ __('dashboard.Nomor Whatsapp (WA)') }}</span>
                </div>
                <div class="md:w-2/3 dark:text-gray-300">
                    {{ $user->no_telp }}
                </div>
            </div>
            <div class="md:flex mb-6">
                <div class="md:w-1/3">
                    <span class="text-gray-500 dark:text-gray-400">{{ __('dashboard.Tahun Masuk') }}</span>
                </div>
                <div class="md:w-2/3 dark:text-gray-300">
                    {{ $user->year_in }}
                </div>
            </div>
            <div class="md:flex mb-6">
                <div class="md:w-1/3">
                    <span class="text-gray-500 dark:text-gray-400">{{ __('dashboard.Link Twibbon') }}</span>
                </div>
                <div class="md:w-2/3 dark:text-gray-300">
                    <a href="{{ $user->link_twibbon }}" target="_blank"
                        class="text-blue-500 underline">{{ $user->link_twibbon }}</a>
                </div>
            </div>
            <div class="md:flex mb-6">
                <div class="md:w-1/3">
                    <span class="text-gray-500 dark:text-gray-400">{{ __('dashboard.KTM') }}</span>
                </div>
                <div class="md:w-2/3 dark:text-gray-300">
                    @livewire('misc.modal-image', ['img' => $user->student_card_url], key($user->id))
                </div>
            </div>
        </div>
        <div class="px-4 py-5 mb-5 bg-primaryPoi25 sm:p-6 shadow sm:rounded-md">
            <h2 class="font-bold mb-6 text-lg dark:text-gray-300">{{ __('dashboard.tim') }}</h2>
            <x-table :theads="['nama', 'lomba', 'status', 'tanggal registrasi']">
                @forelse ($user->getAllTeams() as $item)
                    @if (!empty($item))
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3 text-sm whitespace-nowrap">
                                <a class="underline"
                                    href="{{ route('teams_details', ['id' => $item->id]) }}">{{ $item->name }}</a>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <p>{{ $item->type }}</p>
                            </td>
                            <td class="px-4 py-3 text-xs">
                                @if ($item->confirmed)
                                    <x-badges.success name="Terkonfirmasi" />
                                @else
                                    <x-badges.error name="Belum Terkonfirmasi" />
                                @endif
                            </td>
                            <td class="px-4 py-3 text-sm whitespace-nowrap">
                                <p>{{ $item->created_at }}</p>
                            </td>
                        </tr>
                    @endif
                @empty
                    <tr class="text-gray-600 italic text-center">
                        <td colspan="5">
                            <div class="mt-2">{{ __('dashboard.no-teams-found') }}</div>
                        </td>
                    </tr>
                @endforelse
            </x-table>
        </div>
    </div>
</div>
