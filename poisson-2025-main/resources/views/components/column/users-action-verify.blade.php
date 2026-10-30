@if ($row->hasRole('peserta'))
    <x-danger-button wire:loading.attr="disabled" wire:click="unverify({{ $row->id }})">
        Batalkan Verifikasi
    </x-danger-button>
@elseif($row->hasRole('admin'))
    <div class="text-xs">
        <x-badges.error name="Tidak Diizinkan" />
    </div>
@else
    <x-button class="dark:bg-green-800 dark:hover:bg-green-700 dark:border-green-800 dark:active:bg-green-700" wire:loading.attr="disabled" wire:click="verify({{ $row->id }})">
        Verifikasi
    </x-button>
@endif
