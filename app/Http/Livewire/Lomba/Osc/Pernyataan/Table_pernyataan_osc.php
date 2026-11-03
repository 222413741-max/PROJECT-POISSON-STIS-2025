<?php

namespace App\Http\Livewire\Lomba\Osc\Pernyataan;
// TODO : Taro di folder livewire/lomba/OSC
use App\Models\Pernyataan_osc;
use App\Models\Team;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column; 
use Rappasoft\LaravelLivewireTables\Views\Filter;

class Table_pernyataan_osc extends DataTableComponent
{

    public bool $columnSelect = true;

    public function columns(): array
    {
        return [
            Column::make('Nomor Tim', 'id')
                ->sortable()
                ->searchable()
                ->excludeFromSelectable()
                ->format(function ($value, $column, $row) {
                    return view('components.column.lomba-teams-id', ['row' => $row]);
                }),

            Column::make('Nama Tim', 'name')
                ->sortable()
                ->excludeFromSelectable()
                ->searchable(),


            Column::make('Status', 'status')
                ->sortable()
                ->format(function ($value, $column, $row) {
                    return view('components.column.pernyataan_osc-status', ['row' => $row]);
                }),

            Column::make('Aksi')
                ->format(function ($value, $column, $row) {
                    return view('components.column.pernyataan_osc-action', ['row' => $row]);
                }),

        ];
    }

    /**
     * filters
     *
     * @return array
     */
    // public function filters(): array
    // {
    //     return [
    //         'type' => Filter::make('Soal Tahap')
    //             ->select([
    //                 '' => 'Any',
    //                 // 'penyisihan' => 'Penyisihan',
    //                 'semifinal' => 'Semifinal'
    //             ]),
    //     ];
    // }

    /**
     * Abstract override, searching from filter
     *
     * @return array
     */
    public function query(): Builder
    {
        // return Team::getOSC()
        //     ->with('pernyataanOsc')
        //     ->when($this->getFilter('tahap'), function ($query, $tahap) {
        //         switch ($tahap) {
        //             case 'semifinal':
        //                 return $query->permission('osc_semifinal_peserta');
        //             case 'final':
        //                 return $query->permission('osc_final_peserta');
        //             default:
        //                 return $query->permission('osc_penyisihan_lolos');
        //         }
        //     });
        return Team::getOSC()
            ->with('pernyataanOsc')
            ->permission('osc_penyisihan_lolos');
    }

    // custom method

    /**
     * delete
     *
     * menghapus soal
     *
     * @return void
     */
    public function delete($id)
    {
        try {
            $soal = Pernyataan_osc::find($id);
            $soal->delete();

            if (File::exists(public_path('storage/' . $soal['path']))) {
                File::delete(public_path('storage/' . $soal['path']));
            }

            $this->emit('success', "Berhasil menghapus pernyataan");
            $this->emitSelf('reloadPernyataan');
        } catch (\Exception $e) {
            $this->emit('error', 'Gagal menghapus pernyataan');
        }
    }

    /**
     * assignFinal
     *
     * masukkan tim ke tahap selanjutnya
     *
     * @param  mixed $team_id
     * @return void
     */
    public function assignLolos($team_id, $tahap = 'pernyataan')
    {
        try {
            $team = Team::findOrFail($team_id);

            $team->givePermissionTo("osc_semifinal_peserta");

            return $this->emit('success', "Tim Lolos Tahap Pernyataan, Lanjut ke Tahap Semifinal");
        } catch (\Exception $e) {
            return $this->emit('error', "Gagal Meloloskan Tim");
        }
    }

    /**
     * assignFail
     *
     * masukkan tim ke yang tidak lolos
     *
     * @param  mixed $team_id
     * @return void
     */
    public function assignFail($team_id)
    {
        try {
            $team = Team::findOrFail($team_id);

            $team->givePermissionTo('fail');

            return $this->emit('success', "Berhasil Menggugurkan Tim");
        } catch (\Exception $e) {
            return $this->emit('error', "Gagal");
        }
    }

    /**
     * cancelLolos
     *
     * rollback, kalo misalnya ada yang salah pencet
     *
     * @param  mixed $team_id
     * @param  mixed $tahap
     * @return void
     */
    public function cancelLolos($team_id, $tahap = 'pernyataan')
    {
        try {
            $team = Team::findOrFail($team_id);

            $team->revokePermissionTo('osc_semifinal_peserta');

            return $this->emit('success', "Tim dibatalkan lolos pernyataan");
        } catch (\Exception $e) {
            return $this->emit('error', "Gagal");
        }
    }

    /**
     * cancelFail
     *
     * @param  mixed $team_id
     * @return void
     */
    public function cancelFail($team_id)
    {
        try {
            $team = Team::findOrFail($team_id);

            $team->revokePermissionTo('fail');

            return $this->emit('success', "Berhasil");
        } catch (\Exception $e) {
            return $this->emit('error', "Gagal");
        }
    }
}
