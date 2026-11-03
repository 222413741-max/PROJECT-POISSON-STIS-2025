<div class="mt-3">
    <div class="flex justify-between px-2 text-gray-700">
        <div class="font-bold" style="white-space: pre-line;">
            {{ __('dashboard.Pembayaran & Konfirmasi') }}
        </div>
        <div class="flex flex-wrap items-end">
            @if (!$team->hasPermissionTo('fail'))
                @if ($team->type == 'olimpiade') 
                    @if ($team->hasPermissionTo('olimpiade_semifinal_lolos') && !$team->hasPermissionTo('olimpiade_final_peserta'))
                        {{-- confirm button --}}
                        <x-button class="mt-2 mr-2 overflow-hidden whitespace-nowrap dark:bg-green-800 dark:hover:bg-green-700 dark:border-green-800 dark:active:bg-green-700" type="button"
                            wire:click="confirmFinal()" wire:loading.attr="disabled">
                            {{ __('dashboard.Konfirmasi') }}
                        </x-button>
                        {{-- cancel button --}}
                        <x-danger-button class="mt-2 mr-2 overflow-hidden whitespace-nowrap" type="button"
                            wire:click="confirmCancel()" wire:loading.attr="disabled">
                            {{ __('dashboard.Batal Ikut') }}
                        </x-danger-button>
                    @elseif ($team->hasPermissionTo('olimpiade_penyisihan_lolos') && $team->payments()->count() < 2)
                            {{-- upload new payments button --}}
                            <form wire:submit.prevent="addPayments()" class="text-center"
                            x-on:livewire-upload-finish="$refs.form_olimpiade_2.click()">
                              <input type="file" class="hidden" name="payments" x-ref="payments"
                                  wire:model.defer="payments" />
                              <div class="flex">
                                  <x-button class="mt-2 mr-2 overflow-hidden whitespace-nowrap" type="button"
                                      x-on:click.prevent="$refs.payments.click()" wire:loading.attr="disabled">
                                      {{ __('dashboard.Upload Bukti Pembayaran') }}
                                  </x-button>
                              </div>
                              <input type="submit" class="hidden" x-ref="form_olimpiade_2">
                            </form>
                            {{-- cancel button --}}
                            <x-danger-button class="mt-2 mr-2 overflow-hidden whitespace-nowrap" type="button"
                                wire:click="confirmCancel()" wire:loading.attr="disabled">
                                {{ __('dashboard.Batal Ikut') }}
                            </x-danger-button>
                    @endif
                @elseif ($team->type == 'infografis')
                    @if ($team->hasPermissionTo('infografis_penyisihan_lolos') && !$team->hasPermissionTo('infografis_final_peserta'))
                        {{-- confirm button --}}
                        <x-button class="mt-2 mr-2 overflow-hidden whitespace-nowrap dark:bg-green-800 dark:hover:bg-green-700 dark:border-green-800 dark:active:bg-green-700" type="button"
                            wire:click="confirmFinal()" wire:loading.attr="disabled">
                            {{ __('dashboard.Konfirmasi') }}
                        </x-button>
                        {{-- cancel button --}}
                        <x-danger-button class="mt-2 mr-2 overflow-hidden whitespace-nowrap" type="button"
                            wire:click="confirmCancel()" wire:loading.attr="disabled">
                            {{ __('dashboard.Batal Ikut') }}
                        </x-danger-button>
                    @endif
                @elseif ($team->type == 'osc')
                    @if ($team->hasPermissionTo('osc_semifinal_lolos') && !$team->hasPermissionTo('osc_final_peserta'))
                        {{-- confirm button --}}
                        <x-button class="mt-2 mr-2 overflow-hidden whitespace-nowrap dark:bg-green-800 dark:hover:bg-green-700 dark:border-green-800 dark:active:bg-green-700" type="button"
                            wire:click="confirmFinal()" wire:loading.attr="disabled">
                            {{ __('dashboard.Konfirmasi') }} Final
                        </x-button>
                        {{-- cancel button --}}
                        <x-danger-button class="mt-2 mr-2 overflow-hidden whitespace-nowrap" type="button"
                            wire:click="confirmCancel()" wire:loading.attr="disabled">
                            {{ __('dashboard.Batal Ikut') }}
                        </x-danger-button>
                    @endif
                @endif
            @endif
        </div>
    </div>
</div>
