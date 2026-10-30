<?php

namespace App\Http\Livewire\Home;

use App\Models\Payment;
use App\Models\Team;
use App\Models\Tanggal;
use App\Models\Pernyataan_osc;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Services\Midtrans\CreateSnapTokenService;
use App\Services\Midtrans\CancelTransactionService;

class Users extends Component
{
    use WithFileUploads;
    
    public $team;
    public $buat_tim = true;
    public $lomba = "infografis";

    // user input
    public $token;
    public $team_name;
    public $payments = "other_qris";
    public $isStarted;
    public $isClosed;
    public $midtrans_order_id;
    public $snapToken;

    // input user
    // $pernyataan : Menyimpang model pernyataan
    // $pernyataan_name : untuk @entangle di view
    public $pernyataan, $pernyataan_name;

    /**
     * createteam
     *  
     * @return void
     */
    public function createteam()
    {
        $this->validate([
            'team_name' => $this->lomba == 'infografis' ? '' : 'required',
            'payments' => 'required'
        ], [
            'team_name.required' => 'Nama tim wajib diisi.',
            'payments.required' => 'Metode pembayaran wajib diisi.',
        ]);

        if ($this->lomba == 'infografis') {
            $this->team_name = auth()->user()->name;
        }

        // $url = $this->payments->store('payments', 'public');

        $team = null;
        switch ($this->lomba) {
            case 'infografis':
                $team = Team::createInfografis($this->team_name);
                break;

            case 'olimpiade':
                $team = Team::createOlimpiade($this->team_name);
                break;

            case 'osc':
                $team = Team::createOSC($this->team_name);
                break;

            default:
                $team = Team::createInfografis($this->team_name);
                break;
        }

        $type = null;

        switch ($this->lomba) {
            case 'infografis':
                $type = config('variables.payments.infografis_1');
                break;

            case 'olimpiade':
                $type = config('variables.payments.olimpiade_1');
                break;

            case 'osc':
                $type = config('variables.payments.osc_1');
                break;

            default:
                $type = config('variables.payments.infografis_1');
                break;
        }

        $this->midtrans_order_id = time();

        if (auth()->user()->university_tipe == 2) {
            $payment = Payment::create([
                'team_id' => $team->id,
                'payment_method' => 'foreign',
                'type' => $type,
            ]);

            $payment->confirmed = 1;
            $payment->save();

            $team->confirmed = true;
            $team->save();
            $team->givePermissionTo('infografis_penyisihan_peserta');

            $this->token = $team->token;

            $assign = Auth::user()->assignTeams($this->token, $this->lomba);

            if (!$assign) return $this->emit('error', 'Gagal, cek lagi token anda');

            $this->team = $team;

            return $this->emit('success', 'Success');
        }

        $midtrans = new CreateSnapTokenService(
            $this->midtrans_order_id,
            $this->lomba,
            $this->payments
        );
        $snapToken = $midtrans->getSnapToken($this->payments);

        Payment::create([
            'team_id' => $team->id,
            'midtrans_order_id' => $this->midtrans_order_id,
            'midtrans_id' => $snapToken,
            'payment_method' => $this->payments,
            'type' => $type
        ]);

        $this->token = $team->token;

        $assign = Auth::user()->assignTeams($this->token, $this->lomba);

        if (!$assign) return $this->emit('error', 'Gagal, cek lagi token anda');

        $this->team = $team;

        if(env('MIDTRANS_TIPE') == 'production') {
            return redirect('https://app.midtrans.com/snap/v3/redirection/'. $snapToken);
        } else {
            return redirect('https://app.sandbox.midtrans.com/snap/v3/redirection/'. $snapToken);
        }

        // return $this->emit('success', 'Tim berhasil dibuat');
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

    /* Bagian Pernyataan */

    /**
     * resetAll
     *
     * @return void
     */
    private function resetAll()
    {
        $this->reset('pernyataan');
    }

    /**
     * add Pernyataan
     *
     * @return void
     */
    public function addPernyataan($team_id)
    {
        $this->validate([
            'pernyataan' => 'required|mimes:pdf|max:2048'
        ], [
            'pernyataan.required' => 'Kolom pernyataan wajib diisi.',
            'pernyataan.mimes' => 'pernyataan harus bertipe pdf.',
            'pernyataan.max' => 'Ukuran pernyataan maksimal 2 MB.',
        ]);

        try {
            $path = $this->pernyataan->store('pernyataan_osc', 'public');

            Pernyataan_osc::Create([
                'team_id' => $team_id,
                'path' => $path
            ]);

            // $this->emit('reloadPernyataan');
            
            return $this->emit('success', 'Berhasil menambahkan soal');
        } catch (\Exception $e) {
            $this->emit('error', $e->getMessage());
        }
    }

    public function updatePernyataan($team_id)
    {
        $this->validate([
            'pernyataan' => 'required|mimes:pdf|max:2048'
        ], [
            'pernyataan.required' => 'Kolom pernyataan wajib diisi.',
            'pernyataan.mimes' => 'Pernyataan harus bertipe PDF.',
            'pernyataan.max' => 'Ukuran pernyataan maksimal 2 MB.',
        ]);

        try {
            // Simpan file pernyataan baru
            $path = $this->pernyataan->store('pernyataan_osc', 'public');

            // Cari data yang ingin di-update berdasarkan team_id
            $pernyataan = Pernyataan_osc::where('team_id', $team_id)->first();

            if ($pernyataan) {
                // Hapus file lama jika ada
                if (File::exists(public_path('storage/' . $pernyataan->path))) {
                    File::delete(public_path('storage/' . $pernyataan->path));
                }

                // Update data dengan path baru
                $pernyataan->update([
                    'path' => $path
                ]);

                // Emit success message
                return $this->emit('success', 'Berhasil memperbarui pernyataan');
            } else {
                return $this->emit('error', 'Pernyataan tidak ditemukan');
            }
        } catch (\Exception $e) {
            $this->emit('error', $e->getMessage());
        }
    }

    public function deletePernyataan($team_id)
    {
        try {
            $pernyataan = Pernyataan_osc::where('team_id', $team_id)->first();
            $pernyataan->delete();

            if (File::exists(public_path('storage/' . $pernyataan['path']))) {
                File::delete(public_path('storage/' . $pernyataan['path']));
            }

            $this->reset('pernyataan', 'pernyataan_name');
            return $this->emit('success', "Berhasil menghapus pernyataan");
        } catch (\Exception $e) {
            $this->emit('error', 'Gagal menghapus soal');
        }
    }


    /***** Bagian payments *****/
    /**
     * edit payments users
     *
     * @return void
     */
    public function editPayments($payments_id)
    {
        $payment = Payment::findOrFail($payments_id);
        try {
            $midtrans = new CancelTransactionService($payment->midtrans_order_id);
            $cancel = $midtrans->cancelTransaction();
        } catch (\Throwable $th) {
            //throw $th;
        }

        $this->midtrans_order_id = time();
        $payment->created_at = time();
        $payment->save();

        $midtrans = new CreateSnapTokenService(
            $this->midtrans_order_id,
            $this->lomba,
            $this->payments,
            $payment->type
        );
        $snapToken = $midtrans->getSnapToken($this->payments);

        $payment->midtrans_id = $snapToken;
        $payment->midtrans_order_id = $this->midtrans_order_id;
        $payment->payment_method = $this->payments;
        $payment->save();

        if(env('MIDTRANS_TIPE') == 'production') {
            return redirect('https://app.midtrans.com/snap/v3/redirection/'. $snapToken);
        } else {
            return redirect('https://app.sandbox.midtrans.com/snap/v3/redirection/'. $snapToken);
        }
        try {
            $payment = Payment::findOrFail($payments_id);
            $cancel = Transaction::cancel($payment->midtrans_id);
            return dd($cancel);

            // $payment->url = $url;

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
                'payments.max' => 'Ukuran file bukti pembayaran maksimal 2 MB.'
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
        switch ($this->lomba) {
            case 'infografis':
                $this->team = Auth::user()->teamInfografis();
                break;

            case 'olimpiade':
                $this->team = Auth::user()->teamOlimpiade();
                break;

            case 'osc':
                $this->team = Auth::user()->teamOSC();
                break;
        }
        // $this->team = $this->lomba == 'infografis'
        //     ? Auth::user()->teamInfografis()
        //     : Auth::user()->teamOlimpiade();
    }

    /**
     * mount
     *
     * @return void
     */
    public function mount()
    {

        $lomba_pendaftaran_infografis_start = Tanggal::where('kegiatan', 'Pembukaan Pendaftaran Lomba Infografis')->pluck('time')->first();
        $lomba_pendaftaran_olimpiade_start = Tanggal::where('kegiatan', 'Pembukaan Pendaftaran Lomba Olimpiade')->pluck('time')->first();
        $lomba_pendaftaran_osc_start = Tanggal::where('kegiatan', 'Pembukaan Pendaftaran Lomba OSC')->pluck('time')->first();
        $this->isStarted = ($this->lomba == 'infografis'
            ? (new Carbon($lomba_pendaftaran_infografis_start))->isPast()
            : (
                $this->lomba == 'osc'
                ? (new Carbon($lomba_pendaftaran_osc_start))->isPast()
                : (new Carbon($lomba_pendaftaran_olimpiade_start))->isPast()
            )
        );

        $lomba_pendaftaran_infografis_end = Tanggal::where('kegiatan', 'Penutupan Pendaftaran Lomba Infografis')->pluck('time')->first();
        $lomba_pendaftaran_olimpiade_end = Tanggal::where('kegiatan', 'Penutupan Pendaftaran Lomba Olimpiade')->pluck('time')->first();
        $lomba_pendaftaran_osc_end = Tanggal::where('kegiatan', 'Penutupan Pendaftaran Lomba OSC')->pluck('time')->first();
        $this->isClosed = ($this->lomba == 'infografis'
            ? (new Carbon($lomba_pendaftaran_infografis_end))->isPast()
            : (
                $this->lomba == 'osc'
                ? (new Carbon($lomba_pendaftaran_osc_end))->isPast()
                : (new Carbon($lomba_pendaftaran_olimpiade_end))->isPast()
            )
        );
        $this->reload();
    }
 

    /**
     * render
     *
     * @return void
     */
    public function render()
    {
        return view('home.users');
    }
}
