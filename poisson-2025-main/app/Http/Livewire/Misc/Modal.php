<?php

namespace App\Http\Livewire\Misc;

use Livewire\Component;

class Modal extends Component
{
    public $isOpen = false;

    /**
     * toggleModal
     *
     * open or close modal
     * 
     * @return void
     */
    public function toggleModal()
    {
        return $this->isOpen = !$this->isOpen;
    }
}
