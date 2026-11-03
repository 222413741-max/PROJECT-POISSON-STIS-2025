<x-table :theads="['pembayaran','tanggal', 'metode', 'bayar']">
    @foreach ($payments as $item)
        <tr class="text-gray-700 dark:text-gray-400">
            <td class="px-4 py-3 text-sm whitespace-nowrap">
                <p class="font-semibold">
                    {{ __('dashboard.' . getPaymentType($item->type)) }}
                    @if(!$item->confirmed)
                        <x-badges.error name="{{ __('dashboard.Menunggu pembayaran') }}" />
                    @endif 
                </p>
            </td>
            <td class="px-4 py-3 text-sm whitespace-nowrap">
                <p>{{ $item->created_at->format('d/m/Y H:m') }}</p>
            </td>
            <form wire:submit.prevent="editPayments({{ $item->id }})" class="text-center">
                <td class="w-56 px-4 py-3 text-sm">
                    @if ($item->confirmed)
                        <x-badges.success name="{{ $item->payment_method == 'other_qris' ? 'QRIS' : 'Bank Transfer' }}" />
                    @else
                        <x-select required name="payments" class="block w-full mt-1" id="payments" wire:model.defer="payments">
                            <option value="other_qris" selected>QRIS</option>
                            {{-- <option value="credit_card">Credit/Debit Card (+Admin Rp4.500)</option> --}}
                        </x-select>
                    @endif
                </td>
                <td class="w-10 px-4 py-3 text-sm">
                    @if ($item->confirmed)
                    <x-badges.success name="{{ __('dashboard.Sukses') }}" />
                    @else
                    <x-button class="float-right" wire:loading.attr="disabled">
                        <span wire:loading.remove>{{ __('dashboard.bayar') }}</span>
                        <span wire:loading>{{ __('Loading') }}</span>
                    </x-button>
                    @endif
                </td>
            </form>
        </tr>
    @endforeach
</x-table>
