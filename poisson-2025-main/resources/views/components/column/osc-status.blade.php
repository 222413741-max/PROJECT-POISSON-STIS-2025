@if ($semifinalOsc)
    <div class="text-xs">
        @if ($isOnTime)
            <x-badges.success name="Tepat Waktu" />
        @elseif ($semifinalOsc->uploaded_at)
            <x-badges.error name="Telat" />
        @else
            <x-badges.error name="Belum upload" />
        @endif
    </div>
@endif
