<?php

namespace App\Http\Livewire\Soal_osc;

use App\Models\Soal_semifinal_osc;
use Livewire\Component;
use Livewire\WithFileUploads;

class Add_semifinal_osc extends Component
{
    use WithFileUploads;

    public $isModalOpen = false;

    // input user
    public $name, $code, $soal, $soal_name, $password;

    /**
     * resetAll
     *
     * @return void
     */
    private function resetAll()
    {   
        // Method dari trait WithFileUploads
        $this->reset('name', 'code', 'soal', 'soal_name','password');
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
            'password' => 'required',
            'soal' => 'required|mimes:pdf|max:2048',
        ], [
            'name.required' => 'Kolom nama wajib diisi.',
            'code.required' => 'Kolom kode wajib diisi.',
            'password.required' => 'Kolom password wajib diisi.',
            'soal.required' => 'Kolom soal wajib diisi.',
            'soal.mimes' => 'Soal harus bertipe pdf.',
            'soal.max' => 'Ukuran soal maksimal 2 MB.',
        ]);

        try {
            // Method store dari trait WithFileUploads
            $path = $this->soal->store('soal_semifinal_osc', 'public');

            Soal_semifinal_osc::Create([
                'name' => $this->name,
                'code' => $this->code,
                'password' => $this->password,
                'type' => 'semifinal',
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
        return view('soal_osc.add_semifinal_osc');
    }
} 
