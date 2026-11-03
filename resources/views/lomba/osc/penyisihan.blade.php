<div class="flex flex-row gap-5">
    <div class="overflow-y-auto basis-2/3 min-h-60">
        <p>{{ $no }}.</p>
        {!! $soal->question !!}
        <div class="flex flex-col gap-3 mt-5">
            <x-secondary-button @class(['bg-secondaryPoi24-700 text-white hover:bg-secondaryPoi24-700 hover:text-white' => $data_jawaban_detail->answer == 'A']) wire:click="storeJawaban('A')">A. {{ $soal->option_a }}</x-secondary-button>
            <x-secondary-button @class(['bg-secondaryPoi24-700 text-white hover:bg-secondaryPoi24-700 hover:text-white' => $data_jawaban_detail->answer == 'B']) wire:click="storeJawaban('B')">B. {{ $soal->option_b }}</x-secondary-button>
            <x-secondary-button @class(['bg-secondaryPoi24-700 text-white hover:bg-secondaryPoi24-700 hover:text-white' => $data_jawaban_detail->answer == 'C']) wire:click="storeJawaban('C')">C. {{ $soal->option_c }}</x-secondary-button>
            <x-secondary-button @class(['bg-secondaryPoi24-700 text-white hover:bg-secondaryPoi24-700 hover:text-white' => $data_jawaban_detail->answer == 'D']) wire:click="storeJawaban('D')">D. {{ $soal->option_d }}</x-secondary-button>
        </div>
        <div class="flex flex-row justify-between mt-5">
            <x-button wire:click="prevQuestion">Sebelumnya</x-button>
            @if ($no < $jml_soal)
                <x-button wire:click="nextQuestion">Selanjutnya</x-button>
            @else
                <x-button
                    x-on:click="if(confirm('Apakah Anda yakin ingin mengakhiri ujian? Jawaban tidak bisa diubah lagi.')) { $wire.akhiriUjian() }"
                    color="bg-red-800">
                    Akhiri Ujian
                </x-button>
            @endif
        </div>
    </div>
    <div class="basis-1/3 min-h-60">
        <x-card>
            <div x-data="countdownTimer('{{ $data_jawaban->time_over }}')">
                <h2 class="w-full py-1 mb-3 text-3xl font-bold text-center text-white rounded-md bg-secondaryPoi24-700" x-text="formattedTime">00:00:00</h2>
            </div>
            @for ($i = 1; $i <= $jml_soal; $i++)
                @if ($soal_terisi[$i-1])
                <x-secondary-button color="bg-secondaryPoi24-700 text-white hover:text-black" wire:click="goToQuestion({{ $i }})" @class(['m-1'])>{{ $i }}</x-secondary-button>
                @else
                <x-secondary-button wire:click="goToQuestion({{ $i }})" @class(['m-1'])>{{ $i }}</x-secondary-button>
                @endif
            @endfor
        </x-card>
    </div>
</div>

@push('scripts')
<script>
    function countdownTimer(timeOver) {
        return {
            remainingSeconds: 0,
            formattedTime: '',

            init() {
                const timeOverDate = new Date(timeOver);
                const now = new Date((new Date).toLocaleString("en-US", { timeZone: "Asia/Jakarta" }));
                this.remainingSeconds = Math.floor((timeOverDate - now) / 1000);
                this.updateFormattedTime();
                this.startTimer();
            },

            updateFormattedTime() {
                let hours = Math.floor(this.remainingSeconds / 3600);
                let minutes = Math.floor((this.remainingSeconds % 3600) / 60);
                let seconds = this.remainingSeconds % 60;
                this.formattedTime = `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
            },

            startTimer() {
                this.interval = setInterval(() => {
                    if (this.remainingSeconds > 0) {
                        this.remainingSeconds--;
                        this.updateFormattedTime();
                    } else {
                        clearInterval(this.interval);
                        Livewire.emit('akhiriUjian');
                    }
                }, 1000);
            }
        }
    }
</script>
<script>
    Livewire.on('updateUrl', (newUrl) => {
        history.pushState(null, '', newUrl);
    });
    document.addEventListener('livewire:load', function () {
        @if ($data_jawaban->status == '2')
            Livewire.emit('akhiriUjian');
        @endif
    });
</script>
</script>
@endpush
