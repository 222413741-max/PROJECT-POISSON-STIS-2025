<?php

namespace App\Http\Livewire\Lomba\Osc\Semifinal;

use App\Models\Osc;
use App\Models\Soal_semifinal_osc;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class TahapOsc extends Component
{
    public $TAHAP;
    public $TOLERANCE_TIME = 10; //minutes
    public $UPLOAD_TIME = 2;  // hours
    public $time;

    public $team, $data, $jawaban, $guideLink;
    public $startTime, $endTime, $now, $startUploadTime, $endUploadTime;
    public $isLate = false;

    protected $listeners = ['saveFile' => 'saveFile'];

    /**
     * download
     *
     * @param  mixed $soal
     * @return void
     */
    public function downloadSoal()
    {
        return Storage::download('public/' . $this->data->soal->path, getSoalDownloadName($this->data->soal));
    }

    /**
     * isLate
     *
     * @return void
     */
    private function isLate()
    {
        return (new Carbon($this->endUploadTime))->diffInMinutes($this->data->uploaded_at, false) > $this->TOLERANCE_TIME;
    }

    /**
     * generateSoal
     *
     * @return void
     */
    public function generateSoal()
    {
        $this->reload();
        if ($this->data) {
            $this->emit('timer', $this->time);
            return $this->emit('success', 'Silahkan download soal');
        }

        $soal = Soal_semifinal_osc::getRandomSoal($this->TAHAP);

        \App\Models\Jawaban_semifinal_osc::create([
            'team_id' => $this->team->id,
            'soal_id' => $soal->id,
            'tahap' => $this->TAHAP,
        ]);

        $this->reload();
        $this->emit('timer', $this->time);
        return $this->emit('success', 'Silahkan download soal');
    }


    /**
     * saveFile
     *
     * @param  mixed $jawaban
     * @return void
     */
    public function saveFile($jawaban)
    {
        $this->jawaban = $jawaban;
        $this->data->url = $jawaban;
        $this->data->uploaded_at = now();
        $this->data->save();
        $this->reload();
        return $this->emit('success', 'Berhasil mengunggah file');
    }

    /**
     * getTime
     *
     * @return void
     */
    private function getTime()
    {
        $time = (new Carbon())->diffInSeconds($this->endUploadTime, false);
        return $time > 0 ? $time : 0;
    }

    /**
     * getEndUploadTime
     *
     * @return void
     */
    private function getEndUploadTime()
    {
        $time = (new Carbon($this->data->created_at))->addHours(2)->addMinutes(10);
        return $time->lt($this->endTime) ? $time : $this->endTime;
    }

    /**
     * reload
     *
     * @return void
     */
    public function reload()
    {
        $this->data = $this->team->semifinalOSC()->where('TAHAP', $this->TAHAP)->first();
        if (!$this->data) return;

        $this->jawaban = $this->data->url;
        $this->startUploadTime = new Carbon($this->data->created_at);

        $this->endUploadTime = $this->getEndUploadTime();

        $this->isLate = $this->isLate();
        $this->time = $this->getTime();
    }

    /**
     * render
     *
     * @return void
     */
    public function render()
    {
        return view('lomba.osc.tahap');
    }
}
