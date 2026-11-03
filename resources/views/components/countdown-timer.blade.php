<div>
    <h2 class="w-full bg-secondaryPoi24-700 text-center text-white font-bold text-3xl py-1 mb-3 rounded-md">{{ $timeFormatted }}</h2>
</div>

@push('scripts')
<script>
    document.addEventListener('livewire:load', function () {
        setInterval(function() {
            Livewire.emit('decrementTime');
        }, 1000);

        Livewire.on('timeUpdated', time => {
            console.log('Time Updated:', time);
        });
    });
</script>
@endpush
