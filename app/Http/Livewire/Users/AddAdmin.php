<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Livewire\Component;

class AddAdmin extends Component
{
    private $ROLE_ADMIN = "admin";
    private $ROLE_USERS = "users";
    public $user;
    public $users;
    public $search;
    public $isModalOpen = false;


    /**
     * resetAll
     *
     * @return void
     */
    private function resetAll()
    {
        $this->reset('search', 'users', 'user');
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
     * selectUser
     *
     * @param  mixed $user
     * @return void
     */
    public function selectUser(User $user)
    {
        $this->user = $user;
        $this->search = $user->name;
        $this->reset('users');
    }

    /**
     * addAdmin
     *
     * @return void
     */
    public function addAdmin()
    {
        try {
            $this->user->syncRoles($this->ROLE_ADMIN);
            $this->emit('success', 'Berhasil menambah admin');
            $this->emit('reloadAdmin');
        } catch (\Exception $e) {
            $this->emit('error', 'Gagal menambah admin');
        } finally {
            return $this->closeModal();
        }
    }

    /**
     * render
     *
     * @return void
     */
    public function render()
    {
        $search = '%' . $this->search . '%';

        $this->users = $this->search !== ''
            ? User::role($this->ROLE_USERS)->where('name', 'like', $search)->limit(5)->get()
            : [];

        return view('users.add-admin');
    }
}
