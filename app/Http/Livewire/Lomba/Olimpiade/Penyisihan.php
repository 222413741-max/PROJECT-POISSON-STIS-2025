<?php

namespace App\Http\Livewire\Lomba\Olimpiade;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Tanggal;

class Penyisihan extends TahapOlimpiade
{
    public $TAHAP = 'penyisihan';
    public $guideLink = "https://drive.google.com/file/d/1XxS3x0yAWzzNfBzilDzsBVNRuf8NNl7r/view?usp=sharing";
    public $template = "https://docs.google.com/document/d/147EH2y8rPo1WjonCHMCtucwGzTTUBwN7/edit?usp=drivesdk&ouid=101895489645769031040&rtpof=true&sd=true";

    /**
     * mount
     *
     * @return void
     */
    public function mount()
    {
        $this->team = Auth::user()->teamOlimpiade();

        $olimpiade_penyisihan_start = Tanggal::where('kegiatan', 'Penyisihan Olimpiade Mulai')->pluck('time')->first();
        $olimpiade_penyisihan_end = Tanggal::where('kegiatan', 'Penyisihan Olimpiade Berakhir')->pluck('time')->first();

        $this->startTime = new Carbon($olimpiade_penyisihan_start);
        $this->endTime = new Carbon($olimpiade_penyisihan_end);
        $this->now = new Carbon();
        $this->reload();
    }
}
