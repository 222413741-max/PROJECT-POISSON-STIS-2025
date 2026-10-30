<div class="text-xs text-right">
    @if ($row->hasPermissionTo('fail'))
        <x-badges.error name="Tidak Lolos" />
        <span class="ml-2">
            <x-danger-button wire:click="cancelFail({{ $row->id }})">
                Batal
            </x-danger-button>
        </span>
    @elseif ($row->hasPermissionTo('infografis_final_peserta'))
        <x-badges.success name="Peserta Final" />
    @elseif ($row->hasPermissionTo('infografis_penyisihan_lolos'))
        <x-badges.success name="Lolos penyisihan" />
        <span class="ml-2">
            <x-danger-button wire:click="cancelLolos({{ $row->id }})">
                Batal
            </x-danger-button>
        </span>
    @elseif($row->hasPermissionTo('infografis_penyisihan_peserta'))
        <x-button class="dark:bg-green-800 dark:hover:bg-green-700 dark:border-green-800 dark:active:bg-green-700 mx-2" wire:loading.attr="disabled" wire:click="assignLolos({{ $row->id }})">
            Loloskan
        </x-button>
        <x-danger-button wire:loading.attr="disabled" wire:click="assignFail({{ $row->id }})">
            Gagal
        </x-danger-button>
    @endif
</div>
