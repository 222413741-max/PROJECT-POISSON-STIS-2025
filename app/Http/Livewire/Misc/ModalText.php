<?php

namespace App\Http\Livewire\Misc;

class ModalText extends Modal
{

    public $text, $title;
        
    public function mount($title,$text)
    {
        $this->title = $title;
        $this->text = $text;
    }

    public function render()
    {
        return view('livewire.misc.modal-text');
    }
}
