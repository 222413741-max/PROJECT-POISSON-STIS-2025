<?php

namespace App\Http\Livewire\Lomba\Osc\Semifinal;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Tanggal;

class Semifinal extends TahapOsc
{
    public $TAHAP = 'semifinal';
    public $guideLink = "https://drive.google.com/file/d/1lzZIlIfl2tk4No1Jy4lOA7XWS-wzzWsX/view?usp=drive_link";

    public function getPresignedUrl($path)
    {
        $aws = new \App\Http\Controllers\AWS();
        return $aws->getPresignedUrl($path);
    }

    /**
     * mount
     *
     * @return void
     */
    public function mount()
    {
        $this->team = Auth::user()->teamOsc();

        $osc_semifinal_start = Tanggal::where('kegiatan', 'Semifinal OSC Mulai')->pluck('time')->first();
        $osc_semifinal_end = Tanggal::where('kegiatan', 'Semifinal OSC Berakhir')->pluck('time')->first();

        $this->startTime = new Carbon($osc_semifinal_start);
        $this->endTime = new Carbon($osc_semifinal_end);
        $this->now = new Carbon();
        $this->reload();
    }
}
