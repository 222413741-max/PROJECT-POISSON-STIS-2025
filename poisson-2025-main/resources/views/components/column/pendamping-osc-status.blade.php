<div>
    @if ($row->getPendampingOsc())
        <x-badges.success name="Sudah Upload" />
    @else 
        <x-badges.error name="Belum Upload" />
    @endif
</div>