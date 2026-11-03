<form wire:submit.prevent="createteam">
    <div class="grid lg:grid-cols-2 grid-cols-1 lg:gap-6 gap-2">
        <div>
            <label for="team_name" class="text-sm text-gray-600 dark:text-gray-300">{{ __('dashboard.Nama Tim') }}</label>
            <x-input required name="team_name" id="team_name" type="text" class="mt-1 block w-full" wire:model.defer="team_name" />
        </div>
        <div>
            <label for="team_name" class="text-sm text-gray-600 dark:text-gray-300">{{ __('dashboard.Metode Pembayaran') }}</label>
            <x-select required name="payments" class="mt-1 block w-full" id="payments" wire:model.defer="payments">
                <option value="">-- {{ __('dashboard.Pilih Metode Pembayaran') }} --</option>
                <option value="other_qris">QRIS</option>
                {{-- <option value="credit_card">Debit/Credit Card (+Admin Rp4.500)</option> --}}
            </x-select>
        </div>
    </div>
    <div class="my-2">
        @error('payments')
            <small class="text-red-600">{{ $message }}</small>
        @enderror
    </div>
    <x-button class="float-right" wire:loading.attr="disabled">
        <span wire:loading.remove>{{ __('dashboard.buat-tim') }}</span>
        <span wire:loading>{{ __('Loading') }}</span>
    </x-button>
</form>
