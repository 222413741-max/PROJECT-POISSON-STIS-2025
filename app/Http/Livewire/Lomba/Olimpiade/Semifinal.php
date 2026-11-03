<?php

namespace App\Http\Livewire\Lomba\Olimpiade;

use Carbon\Carbon;
use App\Models\Team;
use App\Models\Tanggal;
use Livewire\Component; 
use App\Models\Olimpiade;
use Illuminate\Support\Facades\Auth;

class Semifinal extends Component
{
    // file url
    public $olimpiade;

    public $data;
    public $team;

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
        if($this->team->olimpiade->where('tahap', 'semifinal')->first()) return $this->team->olimpiade->where('tahap', 'semifinal')->first();

        return Olimpiade::create([
            'team_id' => $this->team->id,
            'tahap' => 'semifinal',
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
        $this->data = $this->team->olimpiade->where('tahap', 'semifinal')->first();

        $olimpiade_semifinal_end = Tanggal::where('kegiatan', 'Semifinal Olimpiade Berakhir')->pluck('time')->first();
        $end = new Carbon($olimpiade_semifinal_end);
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
        return view('lomba.olimpiade.semifinal');
    }
}
