<?php

namespace App\Http\Livewire\Soal_osc;

use App\Models\Soal_osc;
use Livewire\Component;

class Form extends Component
{
    public $soalOscId;

    // input user
    public $question = '';
    public $option_a, $option_b, $option_c, $option_d, $option_key, $type, $correct_point, $wrong_point, $blank_point, $package;

    public $isEdit = false;

    public function mount($soalOscId = null)
    {
        if ($soalOscId) {
            $this->isEdit = true;
            $soalOsc = Soal_osc::findOrFail($soalOscId);
            $this->fill($soalOsc->toArray());
            $this->soalOscId = $soalOscId;
        }
    }

    /**
     * resetAll
     *
     * @return void
     */
    private function resetAll()
    {
        $this->reset('question', 'option_a', 'option_b', 'option_c', 'option_d', 'option_key', 'type', 'correct_point', 'wrong_point', 'blank_point', 'package');
    }

    /**
     * storeSoal
     *
     * @return void
     */
    public function storeSoal()
    {
        $this->validate([
            'question' => 'required',
            'option_a' => 'required',
            'option_b' => 'required',
            'option_c' => 'required',
            'option_d' => 'required',
            'option_key' => 'required',
            // 'type' => 'required',
            // 'correct_point' => 'required|min:0|max:100',
            // 'wrong_point' => 'required',
            // 'blank_point' => 'required',
            'package' => 'required'
        ], [
            'question.required' => 'Kolom soal wajib diisi.',
            'option_a.required' => 'Kolom opsi_a wajib diisi.',
            'option_b.required' => 'Kolom opsi_b wajib diisi.',
            'option_c.required' => 'Kolom opsi_c wajib diisi.',
            'option_d.required' => 'Kolom opsi_d wajib diisi.',
            'option_key.required' => 'Kolom opsi_key wajib diisi.',
            // 'type.required' => 'Kolom type wajib diisi.',
            // 'correct_point.required' => 'Kolom correct_point wajib diisi.',
            // 'wrong_point.required' => 'Kolom wrong_point wajib diisi.',
            // 'blank_point.required' => 'Kolom blank_point wajib diisi.',
            'package.required' => 'Kolom package wajib diisi.'
        ]);

        try {
            if ($this->isEdit) {
                $soalOsc = Soal_osc::findOrFail($this->soalOscId);
                $soalOsc->update([
                    'question' => $this->question,
                    'option_a' => $this->option_a,
                    'option_b' => $this->option_b,
                    'option_c' => $this->option_c,
                    'option_d' => $this->option_d,
                    'option_key' => $this->option_key,
                    'type' => 'penyisihan',
                    'correct_point' => 3,
                    'wrong_point' => -1,
                    'blank_point' => 0,
                    'package' => $this->package
                ]);
            } else {
                Soal_osc::Create([
                    'question' => $this->question,
                    'option_a' => $this->option_a,
                    'option_b' => $this->option_b,
                    'option_c' => $this->option_c,
                    'option_d' => $this->option_d,
                    'option_key' => $this->option_key,
                    'type' => 'penyisihan',
                    'correct_point' => 3,
                    'wrong_point' => -1,
                    'blank_point' => 0,
                    'package' => $this->package
                ]);
            }

            // $this->emit('success', 'Berhasil menambahkan soal');
            // $this->emit('reloadSoal');
            session()->flash('success', 'Berhasil menambahkan soal');
            return redirect()->route('osc.soal_osc');
        } catch (\Exception $e) {
            $this->emit('error', $e->getMessage());
        }
    }


    /**
     * render
     *
     * @return void
     */
    public function render()
    {
        return view('soal_osc.form');
    }
}
