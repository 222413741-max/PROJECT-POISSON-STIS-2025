<?php

namespace App\View\Components\Teams;

use Illuminate\View\Component;

class Payments extends Component
{

    public $payments;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($payments)
    {
        $this->payments = $payments;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('home.teams.payments');
    }
}
