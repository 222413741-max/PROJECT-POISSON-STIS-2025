<x-dashboard-layout title="soal">
    <x-card name="list soal">
        @slot('right')
            @livewire('soal.add')
        @endslot
        @livewire('soal.table')
    </x-card>
</x-dashboard-layout> 
