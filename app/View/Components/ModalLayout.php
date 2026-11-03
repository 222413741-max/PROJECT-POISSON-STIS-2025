<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ModalLayout extends Component
{
    public $buttonText;
    public $title;
    public $isOpen;

    public function __construct($title, $buttonText, $isOpen) {
        $this->title = $title;
        $this->isOpen = $isOpen;
        $this->buttonText = $buttonText;
    }

    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('layouts.modal');
    }
}
