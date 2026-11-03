<?php

namespace App\Http\Livewire\Soal;

use App\Models\Soal;
use Livewire\Component;
use Livewire\WithFileUploads;

class Add extends Component
{
    use WithFileUploads;
 
    public $isModalOpen = false;

    // input user
    public $name, $code, $type, $soal, $soal_name, $password;
 
    /**
     * resetAll
     *
     * @return void
     */
    private function resetAll()
    {
        $this->reset('name', 'code', 'type', 'soal', 'soal_name','password');
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
     * storeSoal
     *
     * @return void
     */
    public function storeSoal()
    {
        $this->validate([
            'name' => 'required',
            'code' => 'required',
            'type' => 'required',
            'password' => 'required',
            'soal' => 'required|mimes:pdf|max:2048',
        ], [
            'name.required' => 'Kolom nama wajib diisi.',
            'code.required' => 'Kolom kode wajib diisi.',
            'type.required' => 'Kolom tipe wajib diisi.',
            'password.required' => 'Kolom password wajib diisi.',
            'soal.required' => 'Kolom soal wajib diisi.',
            'soal.mimes' => 'Soal harus bertipe pdf.',
            'soal.max' => 'Ukuran soal maksimal 2 MB.',
        ]);

        try {
            $path = $this->soal->store('soal', 'public');

            Soal::Create([
                'name' => $this->name,
                'code' => $this->code,
                'password' => $this->password,
                'type' => strtolower($this->type),
                'path' => $path,
            ]);

            $this->closeModal();

            $this->emit('success', 'Berhasil menambahkan soal');
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
        return view('soal.add');
    }
}
