<div class="text-xs">
    @if ($row->confirmed)
        <x-badges.success name="Sukses" />
    @else
        <x-badges.error name="Pending" />
    @endif
</div>
