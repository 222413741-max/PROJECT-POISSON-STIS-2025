<?php

namespace App\View\Components\Teams;

use Illuminate\View\Component;

class Lomba extends Component
{

    public $team;
    public $grup_wa_penyisihan_si = 'https://chat.whatsapp.com/JeRcyAV2QsmGBzjxrQDSdw';
    public $grup_wa_final_si = 'https://chat.whatsapp.com/JAg1rXy2328FS8Isu2Po88';
    public $grup_wa_penyisihan_so = 'https://chat.whatsapp.com/IykZU0XR37lCtHjB4HuOkM';
    public $grup_wa_semifinal_so = 'https://chat.whatsapp.com/KYCvBq8GapQAA2EvkZIYVL';
    public $grup_wa_final_so = 'https://chat.whatsapp.com/JBnu701ms3WH9WJ1oevexz';
    public $grup_wa_penyisihan_osc = 'https://chat.whatsapp.com/BDIPvpQu5E0EqPNJ0NBx6k';
    public $grup_wa_semifinal_osc = 'https://chat.whatsapp.com/DiGOa5PFcOf3lRW43PSMOw';
    public $grup_wa_final_osc = 'https://chat.whatsapp.com/DSPRScNOHhdH0CzaasZDSp';
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
        return view('home.teams.lomba');
    }
}
