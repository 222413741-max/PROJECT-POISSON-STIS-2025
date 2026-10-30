<?php

namespace App\Http\Livewire\Lomba\Infografis;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Tanggal;

class TahapFinal extends Component
{

    public $data;
    public $team;

    // file input
    public $ppt;

    public $isDisabled;

    protected $listeners = ['saveFile'];

    /**
     * mount
     *
     * @return void
     */
    public function mount()
    {
        $this->team = Auth::user()->teamInfografis();
        $this->data = $this->team->infografis;
        $this->isDisabled = $this->data->ppt;

        $infografis_final_start = Tanggal::where('kegiatan', 'Final Infografis Mulai')->pluck('time')->first();
        $infografis_final_end = Tanggal::where('kegiatan', 'Final Infografis Berakhir')->pluck('time')->first();

        $startDate = new Carbon($infografis_final_start);
        $endDate = new Carbon($infografis_final_end);
        // $this->isDisabled = !now()->between($startDate, $endDate);

        $this->reload();
    }

    public function getPresignedUrl($path)
    {
        $aws = new \App\Http\Controllers\AWS();
        return $aws->getPresignedUrl($path);
    }

    /**
     * saveFile
     *
     * save ppt url after store in AWS S3
     *
     * @param  mixed $ppt
     * @return void
     */
    public function saveFile($ppt)
    {
        $this->data->ppt = $ppt;
        $this->data->save();
        $this->isDisabled = true;
        $this->reload();
        return $this->emit('success', 'Berhasil mengunggah file');
    }

    /**
     * reload
     *
     * @return void
     */
    public function reload()
    {
        if ($this->data) $this->ppt = $this->data->ppt;
    }

    public function render()
    {
        return view('lomba.infografis.final');
    }
}
