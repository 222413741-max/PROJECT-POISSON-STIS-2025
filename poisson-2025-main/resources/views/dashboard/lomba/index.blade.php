<x-dashboard-layout title="perlombaan">
    @php
        $olimpiade = Auth::user()->teamOlimpiade();
        $infografis = Auth::user()->teamInfografis();
        $osc = Auth::user()->teamOSC();
    @endphp
    @if ($olimpiade)
        <x-card name="{{ __('dashboard.olimpiade') }}">
            <x-teams.lomba :team="$olimpiade" />
        </x-card>
    @endif
    @if ($infografis)
        <x-card name="{{ __('dashboard.infografis') }}">
            <x-teams.lomba :team="$infografis" />
        </x-card>
    @endif
    @if ($osc)
        <x-card name="{{ __('dashboard.osc') }}">
            <x-teams.lomba :team="$osc" />
        </x-card>
    @endif
</x-dashboard-layout>
