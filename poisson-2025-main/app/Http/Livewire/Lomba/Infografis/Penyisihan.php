<?php

namespace App\Http\Livewire\Lomba\Infografis;

use App\Models\Infografis;
use App\Models\Team;
use App\Models\Tanggal;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Penyisihan extends Component
{
    // user input
    public $name;
    public $description;

    // file url
    public $infografis;

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
    public function createNew($name, $description)
    {
        if($this->team->infografis) return $this->team->infografis;

        return Infografis::create([
            'team_id' => $this->team->id,
            'name' => $name,
            'description' => $description,
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
            $name = $this->name;
            $description = $this->description;

            if (!$data) {
                $data = $this->createNew($name, $description);
            } else {
                $data->name = $name;
                $data->description = $description;
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
    public function saveFile($infografis)
    {
        $data = $this->data;

        $data->infografis = $infografis;
        $data->save();

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

        $this->name = $this->data->name;
        $this->description = $this->data->description;
        $this->infografis = $this->data->infografis;
    }

    /**
     * mount
     *
     * @return void
     */
    public function mount()
    {
        $this->team = Auth::user()->teamInfografis();
        $this->data = $this->team->infografis;

        $infografis_penyisihan_end = Tanggal::where('kegiatan', 'Penyisihan Infografis Berakhir')->pluck('time')->first();
        $date = new Carbon($infografis_penyisihan_end);
        $this->isDisabled = $date->isPast();

        $this->reload();
    }

    public function getPresignedUrl($path)
    {
        $aws = new \App\Http\Controllers\AWS();
        return $aws->getPresignedUrl($path);
    }

    public function render()
    {
        return view('lomba.infografis.penyisihan');
    }
}
