<?php

namespace App\Http\Livewire\Tanggal;

use App\Models\Tanggal;
use Livewire\Component;

class Update extends Component
{
    public $isModalOpen = false;

    //input user
    public $kegiatan, $time;

    /**
     * resetAll
     *
     * @return void
     */
    private function resetAll()
    {
        $this->reset('kegiatan', 'time');
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
     * update function
     */
    public function updateTanggal()
    {
        $this->validate([
            'time' => 'required',
            'kegiatan' => 'required'
        ], [
            'time' => 'Waktu wajib diisi.',
            'kegiatan' => 'Kegiatan wajib diisi.',
        ]);

        $tanggal = Tanggal::where('kegiatan', $this->kegiatan)->first();
        try {
            $tanggal->update([
                'time'   => $this->time
            ]);
            $this->emit('success', 'Tanggal Berhasil Diubah');
            $this->closeModal();
        } catch (\Exception $e) {
            $this->emit('error', $e->getMessage());
        }
    }

    public function render()
    {
        return view('dashboard.tanggal.update');
    }
}
