<div>
    <div>
        <h4 class="mb-4 flex-1 text-lg font-semibold text-gray-600 capitalize">
            {{ __('dashboard.Peserta & Admin') }}
        </h4>

        <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
            {{-- peserta --}}
            <x-home.card title="Total Peserta" amount="{{ App\Models\User::role('peserta')->count() }}"
                class="text-primary-600 bg-primary-100">
                <x-icons.user />
            </x-home.card>

            {{-- pendaftar baru --}}
            <x-home.card title="Pendaftar Baru" amount="{{ App\Models\User::role('users')->count() }}"
                class="text-secondary-600 bg-secondary-200">
                <x-icons.user-new />
            </x-home.card>

            {{-- admin --}}
            <x-home.card title="Anak Setis"
                amount="{{ App\Models\User::role('peserta')->where('college', 'like', '%stis%')->count() }}"
                class="text-green-600 bg-green-100">
                <x-icons.smile />
            </x-home.card>

            {{-- admin --}}
            <x-home.card title="Admin" amount="{{ App\Models\User::role('admin')->count() }}"
                class="text-red-600 bg-red-100">
                <x-icons.settings />
            </x-home.card>

        </div>
    </div>

    <div>
        <h4 class="mb-4 flex-1 text-lg font-semibold text-gray-600 capitalize">
            {{ __('dashboard.Pembayaran') }}
        </h4>

        <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
            {{-- infografis --}}
            <x-home.card title="Menunggu Konfirmasi"
                amount="{{ App\Models\Payment::where('confirmed', false)->count() }}" class="text-red-600 bg-red-100">
                <x-icons.money />
            </x-home.card>

            {{-- infografis --}}
            <x-home.card title="Total Pembayaran"
                amount="{{ App\Models\Payment::where('confirmed', true)->count() }}" class="text-green-600 bg-green-100">
                <x-icons.money />
            </x-home.card>
        </div>
    </div>

    <div>
        <h4 class="mb-4 flex-1 text-lg font-semibold text-gray-600 capitalize">
            {{ __('dashboard.Perlombaan') }}
        </h4>

        <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
            {{-- olimpiade --}}
            <x-home.card title="Total Tim Olimpiade"
                amount="{{ App\Models\Team::where('type', 'olimpiade')->count() }}"  class="text-secondary-600 bg-secondary-200">
                <x-icons.users />
            </x-home.card>

            {{-- infografis --}}
            <x-home.card title="Total Tim Infografis"
                amount="{{ App\Models\Team::where('type', 'infografis')->count() }}"  class="text-primary-600 bg-primary-100">
                <x-icons.users />
            </x-home.card>

            {{-- osc --}}
            <x-home.card title="Total Tim OSC"
                amount="{{ App\Models\Team::where('type', 'osc')->count() }}"  class="text-red-600 bg-primary-100">
                <x-icons.users />
            </x-home.card>
        </div>
    </div>
</div>
