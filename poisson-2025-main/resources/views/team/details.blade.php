<div class="overflow-x-hidden w-full">
    {{-- user list --}}
    <x-card name="{{ $team->name }}">
        @slot('right')
            <span class="text-sm">
                @if ($team->confirmed)
                    <x-badges.success name="Sudah Diverifikasi" />
                @else
                    <x-button wire:loading.attr="disabled" wire:click="verifyTeam()">Verifikasi</x-button>
                @endif
            </span>
        @endslot
        <x-table :theads="['name', 'email','no telepon', 'universitas/sekolah','ktm/kartu pelajar']">
            @foreach ($team->users as $item)
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3 text-sm whitespace-nowrap">
                        <a class="underline" href=" {{ route('users_details', ['id' => $item->id]) }}">
                            {{ $item->name }}
                        </a>
                    </td>
                    <td class="px-4 py-3 text-sm">
                        <p>{{ $item->email }}</p>
                    </td>
                    <td class="px-4 py-3 text-sm">
                        <p>{{ $item->no_telp }}</p>
                    </td>
                    <td class="px-4 py-3 text-sm whitespace-nowrap">
                        <p>{{ $item->college }}</p>
                    </td>
                    <td class="px-4 py-3 text-sm w-10 whitespace-nowrap">
                        @livewire('misc.modal-image', ['img' => $item->student_card_url], key($item->id))
                    </td>
                </tr>
            @endforeach
        </x-table>
    </x-card>

    {{-- payments list --}}
    <x-card name="{{ __('dashboard.Pembayaran') }}">
        <x-table :theads="['pembayaran','tanggal', 'midtrans order id', 'metode pembayaran', 'status pembayaran']">
            @foreach ($team->payments as $item)
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3 text-sm whitespace-nowrap">
                        <p class="font-semibold">{{ getPaymentType($item->type) }}</p>
                    </td>
                    <td class="px-4 py-3 text-sm whitespace-nowrap">
                        <p>{{ $item->created_at }}</p>
                    </td>
                    <td class="px-4 py-3 text-sm whitespace-nowrap">
                        <p>{{ $item->midtrans_order_id }}</p>
                    </td>
                    <td class="px-4 py-3 text-sm whitespace-nowrap">
                        <p>{{ $item->payment_method }}</p>
                    </td>
                    <td class="px-4 py-3 text-sm whitespace-nowrap">
                        @if ($item->confirmed)
                            <x-badges.success name="Sukses" />
                        @else
                            <x-badges.error name="Pending" />
                        @endif
                    </td>
                </tr>
            @endforeach
        </x-table>
    </x-card>
</div>
