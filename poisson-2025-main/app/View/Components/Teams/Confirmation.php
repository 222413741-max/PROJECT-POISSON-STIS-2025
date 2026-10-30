<?php

namespace App\View\Components\Teams;

use Illuminate\View\Component;

class Confirmation extends Component
{
    
    public $team;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($team)
    {
        $this->team = $team;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('home.teams.confirmation');
    }
}
