<?php

namespace App\Http\Livewire\Soal_osc;

use App\Models\Soal_osc;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit_osc extends Component
{
    use WithFileUploads;

    public $isModalOpen = false;

    // input user
    public $question, $option_a, $option_b, $option_c, $option_d, $option_e, $option_key, $type;

    /**
     * resetAll
     *
     * @return void
     */
    private function resetAll()
    {
        $this->reset('question', 'option_a', 'option_b', 'option_c', 'option_d', 'option_e', 'option_key', 'type');
    }

    /**
     * openModal
     *
     * @return void
     */
    public function openModal()
    {
        $this->isModalOpen = true;
    }

    /**
     * closeModal
     *
     * @return void
     */
    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->resetAll();
    }

    /**
     * editSoal
     *
     * @return void
     */
    public function edit($id)
    {
        $data = Soal_osc::find($id);
        $this->question = $data->question;
        $this->option_a = $data->option_a;
        $this->option_b = $data->option_b;
        $this->option_c = $data->option_c;
        $this->option_d = $data->option_d;
        $this->option_e = $data->option_e;
        $this->option_key = $data->option_key;
        $this->type = $data->type;
    }

    public function update()
    {
        $rules = [
            'question' => 'required',
            'option_a' => 'required',
            'option_b' => 'required',
            'option_c' => 'required',
            'option_d' => 'required',
            'option_e' => 'required',
            'option_key' => 'required',
            'type' => 'required'
        ];
        $pesan = [
            'question.required' => 'Kolom soal wajib diisi.',
            'option_a.required' => 'Kolom opsi_a wajib diisi.',
            'option_b.required' => 'Kolom opsi_b wajib diisi.',
            'option_c.required' => 'Kolom opsi_c wajib diisi.',
            'option_d.required' => 'Kolom opsi_d wajib diisi.',
            'option_e.required' => 'Kolom opsi_e wajib diisi.',
            'option_key.required' => 'Kolom opsi_key wajib diisi.',
            'type.required' => 'Kolom type wajib diisi.'
        ];
        try {
            $validated = $this->validate($rules, $pesan);
            $data = Soal_osc::find($this->id);
            $data->update($validated);

            $this->closeModal();

            $this->emit('success', 'Berhasil update soal');
            $this->emit('reloadSoal');
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
        return view('soal_osc.edit_osc');
    }
}
