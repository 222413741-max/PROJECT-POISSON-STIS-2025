@if(!$user)
    <div class="space-y-3">
        <div class="p-4 border-2 border-dashed border-gray-300 rounded-lg text-center">
            <p class="text-gray-500 mb-2"><b class="text-red-500">WARNING!</b> Anggota belum lengkap</b>
        </div>
    </div>
@else
<div class="space-y-3">
    <p class="font-bold">{{ $user->name }}</p>
    <p>Status:
        @switch($user->jawabanOsc->status ?? 0)
            @case(0)
                <x-badges.error name="Belum mengerjakan"></x-badges.error>
                @break
            @case(1)
                <x-badges.warning name="Sedang mengerjakan"></x-badges.warning>
                @break
            @case(2)
                <x-badges.success name="Selesai"></x-badges.success>
                @break
            @default
                <x-badges.error name="Belum mengerjakan"></x-badges.error>
                @break
        @endswitch
    </p>
    <p>
        <x-badges.success name="Point: {{ $user->jawabanOsc->total_points ?? '0' }}" />
    </p>
</div>
@endif