<?php

namespace App\Http\Livewire\Lomba\Osc;

use Livewire\Component;

class CountdownTimer extends Component
{
    public $remainingSeconds = 2700;
    public $timeFormatted;

    public function mount()
    {
        $this->formatTime();
    }

    public function formatTime()
    {
        $minutes = floor($this->remainingSeconds / 60);
        $seconds = $this->remainingSeconds % 60;

        $this->timeFormatted = sprintf('%02d:%02d', $minutes, $seconds);
    }

    public function decrementTime()
    {
        if ($this->remainingSeconds > 0) {
            $this->remainingSeconds--;
            $this->formatTime();
        }
        $this->emit('timeUpdated', $this->timeFormatted);
    }

    public function render()
    {
        return view('components.countdown-timer');
    }
}
