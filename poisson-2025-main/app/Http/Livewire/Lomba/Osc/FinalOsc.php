<?php

namespace App\Http\Livewire\Lomba\Osc;

use Carbon\Carbon;
use App\Models\Team;
use App\Models\Tanggal;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\PendampingOsc;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FinalOsc extends Component
{
    use WithFileUploads;

    // Data pendamping
    public $nama_pendamping;
    public $status_pendamping = '';
    public $status_lainnya = ''; // Field untuk input manual
    public $kontak_wa_pendamping;
    public $foto_pendamping;

    public $data;
    public $team;
    public $isDisabled;

    // Temporary file holder for upload
    public $temp_foto;

    // Modal confirmation
    public $showConfirmModal = false;

    protected $rules = [
        'nama_pendamping' => 'required|string|max:255',
        'status_pendamping' => 'required|string|in:Guru,Orang Tua Peserta,Lainnya',
        'status_lainnya' => 'required_if:status_pendamping,Lainnya|string|max:255',
        'kontak_wa_pendamping' => 'required|string|max:20',
        'temp_foto' => 'nullable|image|max:2048', // 2MB max
    ];

    protected $messages = [
        'nama_pendamping.required' => 'Nama pendamping wajib diisi',
        'status_pendamping.required' => 'Status pendamping wajib dipilih',
        'status_pendamping.in' => 'Status pendamping harus salah satu dari: Guru, Orang Tua Peserta, Lainnya',
        'status_lainnya.required_if' => 'Status lainnya wajib diisi jika memilih "Lainnya"',
        'kontak_wa_pendamping.required' => 'Kontak WhatsApp wajib diisi',
        'temp_foto.image' => 'File harus berupa gambar',
        'temp_foto.max' => 'Ukuran file maksimal 2MB',
    ];

    /**
     * confirmSave
     * 
     * Show confirmation modal before saving
     *
     * @return void
     */
    public function confirmSave()
    {
        // Validate first before showing modal
        $this->validate();
        $this->showConfirmModal = true;
    }

    /**
     * cancelSave
     * 
     * Cancel the save process
     *
     * @return void
     */
    public function cancelSave()
    {
        $this->showConfirmModal = false;
    }

    /**
     * createNew
     *
     * @return PendampingOsc
     */
    public function createNew()
    {
        // Check if team already has pendamping
        if ($this->team->pendampingOsc) {
            return $this->team->pendampingOsc;
        }

        return PendampingOsc::create([
            'team_id' => $this->team->id,
            'nama_pendamping' => $this->nama_pendamping,
            'status_pendamping' => $this->status_pendamping === 'Lainnya' ? $this->status_lainnya : $this->status_pendamping,
            'kontak_wa_pendamping' => $this->kontak_wa_pendamping,
            'foto_pendamping' => $this->uploadFoto(),
        ]);
    }

    /**
     * uploadFoto
     *
     * @return string|null
     */
    private function uploadFoto()
    {
        if (!$this->temp_foto) {
            return null;
        }

        $filename = 'pendamping_' . $this->team->id . '_' . time() . '.' . $this->temp_foto->getClientOriginalExtension();
        $path = $this->temp_foto->storeAs('pendamping_osc', $filename, 'public');

        return $path;
    }

    /**
     * save
     *
     * @return void
     */
    public function save()
    {
        // Close modal first
        $this->showConfirmModal = false;

        try {
            $data = $this->data;

            if (!$data) {
                $data = $this->createNew();
            } else {
                // Delete old photo if new photo uploaded
                if ($this->temp_foto && $data->foto_pendamping) {
                    Storage::disk('public')->delete($data->foto_pendamping);
                }

                $data->update([
                    'nama_pendamping' => $this->nama_pendamping,
                    'status_pendamping' => $this->status_pendamping === 'Lainnya' ? $this->status_lainnya : $this->status_pendamping,
                    'kontak_wa_pendamping' => $this->kontak_wa_pendamping,
                    'foto_pendamping' => $this->temp_foto ? $this->uploadFoto() : $data->foto_pendamping,
                ]);
            }

            $this->data = $data;
            $this->temp_foto = null;
            $this->reload();

            return $this->emit('success', 'Data pendamping berhasil disimpan');
        } catch (\Exception $e) {
            return $this->emit('error', "Terjadi kesalahan: " . $e->getMessage());
        }
    }

    /**
     * reload
     *
     * @return void
     */
    public function reload()
    {
        if (!$this->data) return;

        $this->nama_pendamping = $this->data->nama_pendamping;
        // Logic untuk mendeteksi apakah status custom atau predefined
        if (in_array($this->data->status_pendamping, ['Guru', 'Orang Tua Peserta'])) {
            $this->status_pendamping = $this->data->status_pendamping;
            $this->status_lainnya = '';
        } else {
            $this->status_pendamping = 'Lainnya';
            $this->status_lainnya = $this->data->status_pendamping;
        }
        $this->kontak_wa_pendamping = $this->data->kontak_wa_pendamping;
        $this->foto_pendamping = $this->data->foto_pendamping;
    }

    /**
     * mount
     *
     * @return void
     */
    public function mount()
    {
        // Get team from any member of the team
        $this->team = Auth::user()->teamOsc();

        if (!$this->team) {
            // Handle case where user doesn't have OSC team
            abort(404, 'Team OSC tidak ditemukan');
        }

        // Get pendamping data based on TEAM, not user
        $this->data = $this->team->pendampingOsc;

        $osc_final_start = Tanggal::where('kegiatan', 'Final OSC Mulai')->pluck('time')->first();
        $start = new Carbon($osc_final_start);
        $this->isDisabled = $start->isPast(); // Disabled ketika final sudah dimulai

        $this->reload();
    }

    /**
     * getFotoUrl
     *
     * @return string|null
     */
    public function getFotoUrl()
    {
        if (!$this->foto_pendamping) return null;

        return asset('storage/' . $this->foto_pendamping);
    }

    public function render()
    {
        return view('lomba.osc.final');
    }
}
