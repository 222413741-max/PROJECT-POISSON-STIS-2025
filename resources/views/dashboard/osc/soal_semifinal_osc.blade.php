<x-dashboard-layout title="soal semifinal">
    <x-card name="list soal (PDF)">
        @slot('right')
            @livewire('soal_osc.add_semifinal_osc')
        @endslot
        @livewire('soal_osc.table_semifinal_osc')
    </x-card>
</x-dashboard-layout> 
