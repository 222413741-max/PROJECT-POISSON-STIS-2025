<?php

namespace App\Http\Livewire\Lomba\Osc;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Penyisihan extends Component
{
    public $paket = 'A';
    public $jml_soal = 1;
    public $no = 1;
    public $soal;
    public $data_jawaban;
    public $data_jawaban_detail;
    public $soal_terisi;

    protected $listeners = ['akhiriUjian'];

    public function __construct($no)
    {
        $this->no = $no;
    }

    /**
     * mount
     *
     * @return void
     */
    public function mount()
    {
        $penyisihan_osc_mulai = new \Carbon\Carbon(\App\Models\Tanggal::where('kegiatan', 'Penyisihan OSC Mulai')->pluck('time')->first());
        $penyisihan_osc_berakhir = new \Carbon\Carbon(\App\Models\Tanggal::where('kegiatan', 'Penyisihan OSC Berakhir')->pluck('time')->first());

        if (!\Carbon\Carbon::now()->between($penyisihan_osc_mulai, $penyisihan_osc_berakhir)) {
            return abort(403, 'Ujian hanya bisa diakses pada ' . $penyisihan_osc_mulai->isoFormat('D MMMM Y HH:mm:ss') . ' - ' . $penyisihan_osc_berakhir->isoFormat('D MMMM Y HH:mm:ss'));
        }

        $this->setPaket();

        $this->data_jawaban = \App\Models\Jawaban_osc::where('user_id', auth()->user()->id)->first();
        if (!$this->data_jawaban) {
            $this->createJawabanOSC();
        } else {
            $this->data_jawaban->time_over = \Carbon\Carbon::parse($this->data_jawaban->time_over)->addMinutes(0);

            // if (\Carbon\Carbon::now()->greaterThan(\Carbon\Carbon::parse($this->data_jawaban->time_over)) || $this->data_jawaban->status == '2') {
            //     // return dd('asdknj');
            //     $this->redirectToFinish();
            //     // $this->akhiriUjian();
            //     return;
            // }
        }

        $this->loadSoal();
    }

    public function redirectToFinish()
    {
        return redirect()->route('lomba.osc.penyisihan.finish');
    }

    public function createJawabanOSC()
    {
        $this->data_jawaban = \App\Models\Jawaban_osc::create([
            'user_id' => auth()->user()->id,
            'package' => $this->paket,
            'status' => '1',
            'time_over' => \Carbon\Carbon::now()->addMinutes(60),
        ]);

        $soal = \App\Models\Soal_osc::where('type', 'penyisihan')
                        ->where('package', $this->paket)
                        ->get();

        foreach ($soal as $item) {
            $store = \App\Models\Jawaban_detail_osc::create([
                'jawaban_osc_id' => $this->data_jawaban->id,
                'soal_id' => $item->id,
                'point' => $item->blank_point
            ]);
        }
    }

    public function setPaket()
    {
        switch (auth()->user()->TeamOSC()->getUserOrderInTeam()) {
            case 1:
                $this->paket = 'A';
                break;
            case 2:
                $this->paket = 'B';
                break;
            case 3:
                $this->paket = 'C';
                break;
        }
    }

    public function loadSoal()
    {
        $soal = \App\Models\Soal_osc::where('type', 'penyisihan')
                        ->where('package', $this->paket);
        $this->jml_soal = $soal->count();
        $this->soal = $soal->limit(1)
                        ->offset($this->no - 1)
                        ->first();

        $this->data_jawaban_detail = \App\Models\Jawaban_detail_osc::where('jawaban_osc_id', $this->data_jawaban->id)
                                        ->where('soal_id', $this->soal->id)
                                        ->first();

        $this->soal_terisi = \App\Models\Jawaban_detail_osc::where('jawaban_osc_id', $this->data_jawaban->id)->pluck('answer');
    }

    public function nextQuestion()
    {
        $this->no++;
        $this->updateUrl();
        $this->loadSoal();
    }

    public function prevQuestion()
    {
        if ($this->no > 1) {
            $this->no--;
            $this->updateUrl();
            $this->loadSoal();
        }
    }

    public function goToQuestion($no)
    {
        $this->no = $no;
        $this->updateURL();
        $this->loadSoal();
    }

    public function updateURL()
    {
        $this->emit('updateUrl', url("/lomba/osc/penyisihan/{$this->no}"));
    }

    public function storeJawaban($jawaban)
    {
        $this->data_jawaban_detail->answer = $jawaban;
        $this->data_jawaban_detail->status = ($jawaban == $this->soal->option_key) ? '1' : '0';
        $this->data_jawaban_detail->point = ($jawaban == $this->soal->option_key) ? $this->soal->correct_point : $this->soal->wrong_point;

        $this->data_jawaban_detail->save();
        if ($this->no < $this->jml_soal) {
            $this->nextQuestion();
        }
    }

    public function akhiriUjian()
    {
        $this->data_jawaban->status = '2';
        $total_points = 0;
        foreach ($this->data_jawaban->jawabanDetail as $item) {
            $total_points += $item->point;
        }

        $this->data_jawaban->total_points = $total_points;
        $this->data_jawaban->save();

        return redirect()->route('lomba.osc.penyisihan.finish');
    }

    public function render()
    {
        return view('lomba.osc.penyisihan');
    }
}
