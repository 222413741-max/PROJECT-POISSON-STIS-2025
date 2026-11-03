<div class="text-xs text-right">
    @switch($tahap)
        @case('penyisihan')
            @if ($row->hasPermissionTo('fail'))
                <x-badges.error name="Tidak Lolos" />
                <span class="ml-2">
                    <x-danger-button wire:click="cancelFail({{ $row->id }})">
                        Batal
                    </x-danger-button>
                </span>
            @elseif ($row->hasPermissionTo('osc_penyisihan_lolos'))
                <x-badges.success name="Lolos {{ $tahap }}" /> 
                <span class="ml-2">
                    <x-danger-button wire:click="cancelLolos({{ $row->id }}, '{{ $tahap }}')">
                        Batal
                    </x-danger-button>
                </span>
            @else
                <x-button class="dark:bg-green-800 dark:hover:bg-green-700 dark:border-green-800 dark:active:bg-green-700 mx-2" wire:click="assignLolos({{ $row->id }}, '{{ $tahap }}')">
                    Loloskan
                </x-button>
                <x-danger-button wire:click="assignFail({{ $row->id }})">
                    Gagal
                </x-danger-button>
            @endif
        @break
        @case('semifinal') 
            @if ($row->hasPermissionTo('fail'))
                <x-badges.error name="Tidak Lolos" />
                <span class="ml-2">
                    <x-danger-button wire:click="cancelFail({{ $row->id }})">
                        Batal
                    </x-danger-button> 
                </span>
            @elseif ($row->hasPermissionTo('osc_semifinal_lolos'))
                <x-badges.success name="Lolos {{ $tahap }}" />
                <span class="ml-2">
                    <x-danger-button wire:click="cancelLolos({{ $row->id }}, '{{ $tahap }}')">
                        Batal
                    </x-danger-button>
                </span>
            @else
                <x-button class="dark:bg-green-800 dark:hover:bg-green-700 dark:border-green-800 dark:active:bg-green-700 mx-2" wire:click="assignLolos({{ $row->id }}, '{{ $tahap }}')">
                    Loloskan
                </x-button>
                <x-danger-button wire:click="assignFail({{ $row->id }})">
                    Gagal
                </x-danger-button>
            @endif
        @break
        @case('final')
            @if ($row->hasPermissionTo('fail'))
                <x-badges.error name="Gagal" />
                <span class="ml-2">
                    <x-danger-button wire:click="cancelFail({{ $row->id }})">
                        Batal
                    </x-danger-button>
                </span>
            @else
                <x-danger-button wire:click="assignFail({{ $row->id }})">
                    Gagal
                </x-danger-button>
            @endif
        @break
    @endswitch
</div>
