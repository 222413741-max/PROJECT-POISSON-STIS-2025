<div class="text-xs">
    @if ($row->hasRole('admin'))
        <x-badges.success name="Administrator" />
    @elseif($row->hasRole('peserta'))
        <x-badges.success name="Terverifikasi" />
    @else
        <x-badges.error name="Tidak terverifikasi" />
    @endif
</div>
