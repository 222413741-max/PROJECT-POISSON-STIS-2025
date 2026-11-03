<?php

namespace App\Http\Livewire\Pengumuman;

use App\Models\Pengumuman;
use Livewire\Component;

class Add extends Component
{
    public $isModalOpen = false;

    // input user
    public $name, $description, $link;

    /**
     * resetAll
     *
     * @return void
     */
    private function resetAll()
    {
        $this->reset('name', 'description', 'link');
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
        ], [
            'name.required' => __('message.Kolom judul wajib diisi.')
        ]);

        try {
            Pengumuman::Create([
                'name' => $this->name,
                'description' => $this->description,
                'link' => $this->link,
            ]);

            $this->closeModal();

            $this->emit('success', __('message.Berhasil menambahkan pengumuman'));
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
        return view('pengumuman.add');
    }
}
