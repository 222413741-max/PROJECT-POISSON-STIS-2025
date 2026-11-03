<?php

namespace App\Http\Livewire\Lomba\Olimpiade;

use Carbon\Carbon;
use App\Models\Team;
use App\Models\Tanggal;
use Livewire\Component;
use App\Models\Olimpiade;
use Illuminate\Support\Facades\Auth;

class FinalSo extends Component
{
    // file url
    public $olimpiade;

    public $data;
    public $team;
    public $tahap = 'final';

    public $isDisabled;

    protected $listeners = ['saveFile'];

    /**
     * createNew
     *
     * @param  mixed $name
     * @param  mixed $description
     * @return void
     */
    public function createNew()
    {
        if($this->team->olimpiade->where('tahap', $this->tahap)->first()) return $this->team->olimpiade->where('tahap', $this->tahap)->first();

        return Olimpiade::create([
            'team_id' => $this->team->id,
            'tahap' => $this->tahap,
            'url' => $this->olimpiade,
            'soal_id' => \App\Models\Soal::where('type', 'semifinal')->first()->id,
            'uploaded_at' => time(),
        ]);
    }

    /**
     * save
     *
     * @return void
     */
    public function save()
    {
        try {
            $data = $this->data;

            if (!$data) {
                $data = $this->createNew();
            } else {
                $data->url = $this->olimpiade;
                $data->save();
            }

            $this->data = $data;
            $this->reload();
            return $this->emit('success', 'Berhasil');
        } catch (\Exception $e) {
            return $this->emit('error', "Terjadi Kesalahan, harap ulangi lagi");
        }
    }

    /**
     * saveFile
     *
     * save url file infografis after
     * upload to AWS S3.
     *
     * @param  mixed $infografis
     * @return void
     */
    public function saveFile($olimpiade)
    {
        $data = $this->data;

        $this->olimpiade = $olimpiade;
        if (!$data) {
            $data = $this->createNew();
        } else {
            $data->url = $this->olimpiade;
            $data->save();
        }

        $this->data = $data;
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
        if (!$this->data) return;

        $this->olimpiade = $this->data->url;
    }

    /**
     * mount
     *
     * @return void
     */
    public function mount()
    {
        $this->team = Auth::user()->teamOlimpiade();
        $this->data = $this->team->olimpiade->where('tahap', $this->tahap)->first();

        $olimpiade_final_end = Tanggal::where('kegiatan', 'Final Olimpiade Berakhir')->pluck('time')->first();
        $end = new Carbon($olimpiade_final_end);
        $this->isDisabled = $end->isPast();

        $this->reload();
    }

    public function getPresignedUrl($path)
    {
        $aws = new \App\Http\Controllers\AWS();
        return $aws->getPresignedUrl($path);
    }

    public function render()
    {
        return view('lomba.olimpiade.final');
    }
}
