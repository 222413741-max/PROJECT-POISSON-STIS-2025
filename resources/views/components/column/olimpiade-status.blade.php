@if ($olimpiade)
    <div class="text-xs">
        @if ($isOnTime)
            <x-badges.success name="Tepat Waktu" />
        @elseif ($olimpiade->uploaded_at)
            <x-badges.error name="Telat" />
        @else
            <x-badges.error name="Belum upload" />
        @endif
    </div>
@endif
