<?php

namespace App\Http\Livewire\Team;

use App\Models\Payment;
use App\Models\Team;
use App\Models\Tanggal;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class Home extends Component
{
    use WithFileUploads;

    public $team;
    public $buat_tim = true;
    public $lomba = "infografis";

    // user input 
    public $token;
    public $team_name;
    public $payments;
    public $isClosed;


    /**
     * createteam
     *
     * @return void
     */
    public function createteam()
    {
        $this->validate([
            'payments' => 'image|max:2048'
        ], [
            'payments.image' => 'Bukti pembayaran harus bertipe gambar.',
            'payments.max' => 'Bukti pembayaran maksimal 2 MB.',
        ]);

        $url = $this->payments->store('payments', 'public');

        $team = $this->lomba == 'infografis'
            ? Team::createInfografis($this->team_name)
            : Team::createOlimpiade($this->team_name);

        $type = $this->lomba == 'infografis'
            ? config('variables.payments.infografis_1')
            : config('variables.payments.olimpiade_1');

        Payment::create([
            'team_id' => $team->id,
            'url' => $url,
            'type' => $type
        ]);

        $this->token = $team->token;

        $assign = Auth::user()->assignTeams($this->token, $this->lomba);

        if (!$assign) return $this->emit('error', 'Gagal, cek lagi token anda');

        $this->team = $team;

        return $this->emit('success', 'Tim berhasil dibuat');
    }

    /**
     * assignteam
     *
     * @return void
     */
    public function assignteam()
    {
        $assign = Auth::user()->assignTeams($this->token, $this->lomba);

        if (!$assign) return $this->emit('error', 'Gagal, cek lagi token anda');

        $team = Team::where('token', $this->token)->first();

        $this->team = $team;

        return $this->emit('success', "Berhasil masuk ke tim $team->name");
    }

    /**
     * open buatTim form
     *
     * @return void
     */
    public function buatTim()
    {
        $this->buat_tim = true;
    }

    /**
     * open masukTim form
     *
     * @return void
     */
    public function masukTim()
    {
        $this->buat_tim = false;
    }

    /**
     * edit payments users
     *
     * @return void
     */
    public function editPayments($payments_id)
    {
        try {
            $this->validate([
                'payments' => 'image|max:2048'
            ], [
                'payments.image' => 'Bukti pembayaran harus bertipe gambar.',
                'payments.max' => 'Bukti pembayaran maksimal 2 MB.',
            ]);

            $url = $this->payments->store('payments', 'public');

            $payment = Payment::findOrFail($payments_id);

            $payment->url = $url;

            $payment->save();
            $this->reload();
            return $this->emit('success', "Berhasil mengubah bukti pembayaran");
        } catch (\Throwable $th) {
            return $this->emit('error', "Gagal mengubah bukti pembayaran");
        }
    }


    /**
     * add new payments for olimpiade tahap 2
     *
     * @return void
     */
    public function addPayments()
    {
        try {
            if ($this->team->payments()->count() >= 2) throw new \Exception("Payments Failed");

            $this->validate([
                'payments' => 'image|max:2048'
            ], [
                'payments.image' => 'Bukti pembayaran harus bertipe gambar.',
                'payments.max' => 'Bukti pembayaran maksimal 2 MB.',
            ]);

            $url = $this->payments->store('payments', 'public');

            Payment::create([
                'team_id' => $this->team->id,
                'url' => $url,
                'type' => config('variables.payments.olimpiade_2'),
            ]);

            $this->reload();

            return $this->emit('success', "Berhasil mengupload bukti pembayaran");
        } catch (\Exception $th) {
            return $this->emit('error', "Gagal mengupload bukti pembayaran");
        }
    }

    /**
     * confirmFinal
     *
     * konfirmasi tim untuk masuk babak final
     * lomba infografis dan olimpiade
     * 
     * @return void
     */
    public function confirmFinal()
    {
        try {
            switch ($this->lomba) {
                case 'infografis':
                    $this->team->givePermissionTo('infografis_final_peserta');
                    break;

                case 'olimpiade':
                    $this->team->givePermissionTo('olimpiade_final_peserta');
                    break;

                case 'osc':
                    $this->team->givePermissionTo('osc_final_peserta');
                    break;
            }
            
            $this->reload();
            return $this->emit('success', "Berhasil Melakukan Konfirmasi");
        } catch (\Exception $th) {
            return $this->emit('error', "Gagal Melakukan Konfirmasi");
        }
    }


    /**
     * confirmCancel
     *
     * konfirmasi batak ikut untuk tahap semifinal dan final olimpiade, dan
     * tahap final infografis
     *
     * @return void
     */
    public function confirmCancel()
    {
        try {
            $this->team->givePermissionTo('fail');
            $this->reload();
            return $this->emit('success', "Berhasil Melakukan Konfirmasi Tidak Lanjut");
        } catch (\Exception $th) {
            return $this->emit('error', "Gagal Melakukan Konfirmasi");
        }
    }

    /**
     * reload
     *
     * @return void
     */
    public function reload()
    {
        $this->team = $this->lomba == 'infografis'
            ? Auth::user()->teamInfografis()
            : Auth::user()->teamOlimpiade();
    }

    /**
     * mount
     *
     * @return void
     */
    public function mount()
    {
        $lomba_pendaftaran_end = Tanggal::where('kegiatan', 'Penutupan Pendaftaran Lomba')->pluck('time')->first();
        $this->isClosed = (new Carbon($lomba_pendaftaran_end))->isPast();
        dd($this->isClosed);
        $this->reload();
    }


    /**
     * render
     *
     * @return void
     */
    public function render()
    {
        return view('team.home');
    }
}
