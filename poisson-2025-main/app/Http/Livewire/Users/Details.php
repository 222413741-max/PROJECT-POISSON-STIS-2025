<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Livewire\Component;

class Details extends Component
{
    public $user;
    public $studentCard;
    public $showStudentCard = false;

    /**
     * mount
     *
     * @param  mixed $user
     * @return void
     */
    public function mount($user)
    {
        $this->user = $user;
    }

    /**
     * listeners
     *
     * @var array
     */
    protected $listeners = ['reloadUser' => 'reload'];

    /**
     * reload
     *
     * @return void
     */
    public function reload()
    {
        $this->user = $this->getUser($this->user->id);
    }

    /**
     * get all users where not in role
     *
     * @return User
     */
    private function getUser($id)
    {
        $user = User::find($id);
        $teams = array();
        $teams[] = $user->teamOlimpiade();
        $teams[] = $user->teamInfografis();
        $user->teams = $teams;
        return $user;
    }

    /**
     * showStudentCard
     *
     * @return void
     */
    public function openStudentCard($url)
    {
        $this->showStudentCard = true;
        $this->studentCard = $url;
    }

    /**
     * closeStudentCard
     *
     * @return void
     */
    public function closeStudentCard()
    {
        $this->showStudentCard = false;
        $this->reset('studentCard');
    }

    public function render()
    {
        $this->user = $this->getUser($this->user->id);
        return view('users.details', ['user' => $this->user]);
    }
}
