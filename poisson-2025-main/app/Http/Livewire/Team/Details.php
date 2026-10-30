<?php

namespace App\Http\Livewire\Team;

use App\Models\Payment;
use App\Models\Team;
use App\Notifications\PaymentsNotification; 
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class Details extends Component
{

    public $team;

    /**
     * mount
     *
     * @param  mixed $teams
     * @return void
     */
    public function mount($team)
    {
        $this->team = $team;
    }

    /**
     * reload
     *
     * @return void
     */
    public function reload()
    {
        $this->team = Team::find($this->team->id);
    }

    /**
     * confirm
     *
     * @return void
     */
    public function verifyTeam()
    {
        try {
            $this->team->confirmed = true;
            $this->team->save();

            switch ($this->team->payments->first()->type) {
                case config('variables.payments.olimpiade_1'):
                    $this->team->givePermissionTo('olimpiade_penyisihan_peserta');
                    break;
                case config('variables.payments.infografis_1'):
                    $this->team->givePermissionTo('infografis_penyisihan_peserta');
                    break;
                case config('variables.payments.osc_1'):
                    $this->team->givePermissionTo('osc_penyisihan_peserta');
                    break;
                default:
                    return false;
            }

            return $this->emit('success', 'Berhasil Mengonfirmasi Tim');
        } catch (\Throwable $e) {
            return $this->emit('error', 'Gagal Mengonfirmasi Tim');
        }
    }

    /**
     * verifyPayment
     *
     * @param  mixed $payment_id
     * @return void
     */
    public function verifyPayment($payment_id)
    {
        $verify = Payment::verify($payment_id);

        if (!$verify) return $this->emit('error', 'Gagal Mengonfirmasi Pembayaran');

        $team = $this->team;

        Notification::send($team->users->first(), new PaymentsNotification($team->name));

        $this->reload();

        return $this->emit('success', 'Berhasil Mengonfirmasi Pembayaran');
    }

    /**
     * render
     *
     * @return void
     */
    public function render()
    {
        return view('team.details', ['team' => $this->team]);
    }
}
