<?php

namespace App\Http\Livewire\Misc;

class ModalImage extends Modal
{

    public $img;
        
    /**
     * mount
     *
     * @param  mixed $img
     * @return void
     */
    public function mount($img)
    {
        $this->img = $img;
    }

    public function render()
    {
        return view('livewire.misc.modal-image');
    }
}
