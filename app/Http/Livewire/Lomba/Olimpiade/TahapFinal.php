<?php

namespace App\Http\Livewire\Lomba\Olimpiade;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Tanggal;

class TahapFinal extends TahapOlimpiade
{
    public $TAHAP = 'final';
    public $guideLink = "https://s.stis.ac.id/sQhHd";

    public function mount()
    {
        $this->team = Auth::user()->teamOlimpiade();

        $olimpiade_final_start = Tanggal::where('kegiatan', 'Final Olimpiade Mulai')->pluck('time')->first();
        $olimpiade_final_end = Tanggal::where('kegiatan', 'Final Olimpiade Berakhir')->pluck('time')->first();

        $this->startTime = new Carbon($olimpiade_final_start);
        $this->endTime = new Carbon($olimpiade_final_end);
        $this->now = new Carbon();
        $this->reload();
    }

    public function render()
    {
        return view('lomba.olimpiade.final');
    }
}
