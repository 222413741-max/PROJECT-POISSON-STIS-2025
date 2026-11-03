<div class="text-xs">
    @if ($row->confirmed)
        <x-badges.success name="Terkonfirmasi" />
    @else
        <x-badges.error name="Tidak terkonfirmasi" />
    @endif
</div>
