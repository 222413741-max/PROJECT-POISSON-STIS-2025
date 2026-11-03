<?php

namespace App\Http\Livewire\Lomba\Osc;

use App\Exports\JawabanOSCExport;
use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class TableJawaban extends DataTableComponent
{

    public bool $columnSelect = true;

    public array $filters = [
        'tahap' => 'penyisihan',
        'status' => 'peserta',
    ];

    public array $bulkActions = [
        'exportSelected' => 'Export Excel',
    ];

    public function columns(): array
    {
        $tahap = $this->getFilter('tahap') ?? "penyisihan";

        return [
            Column::make('Nomor Tim', 'id')
                ->sortable()
                ->searchable()
                ->excludeFromSelectable()
                ->format(function ($value, $column, $row) {
                    return view('components.column.lomba-teams-id', ['row' => $row]);
                }),

            Column::make('Anggota 1')
                ->excludeFromSelectable()
                ->format(function ($value, $column, $row) use ($tahap) {
                    return view('components.column.lomba-teams-anggota', ['user' => $row->users[0] ?? null]);
                }),

            Column::make('Anggota 2')
                ->excludeFromSelectable()
                ->format(function ($value, $column, $row) use ($tahap) {
                    return view('components.column.lomba-teams-anggota', ['user' => $row->users[1] ?? null]);
                }),

            Column::make('Anggota 3')
                ->excludeFromSelectable()
                ->format(function ($value, $column, $row) use ($tahap) {
                    return view('components.column.lomba-teams-anggota', ['user' => $row->users[2] ?? null]);
                }),

            Column::make('Aksi')
                ->excludeFromSelectable()
                ->format(function ($value, $column, $row) use ($tahap) {
                    // $olimpiade = $row->olimpiade->where('tahap', $tahap)->first();
                    return view('components.column.osc-action', ['row' => $row, 'tahap' => $tahap]);
                }),
        ];
    }

    /**
     * filters
     *
     * @return array
     */
    public function filters(): array
    {
        return [
            'tahap' => Filter::make('Tahap Lomba')
                ->select([
                    "penyisihan" => 'Penyisihan',
                    "semifinal" => 'Semifinal',
                    "final" => 'final',
                ]),
            'status' => Filter::make('Tahap Lomba')
                ->select([
                    "peserta" => 'Peserta',
                    "lolos" => 'Lolos',
                ]),
        ];
    }

    public function query(): Builder
    {
        return Team::getOsc()
            ->where('confirmed', 1)
            ->withSum(['users as total_points' => function($query) {
                $query->join('jawaban_osc', 'users.id', '=', 'jawaban_osc.user_id')
                    ->select(\DB::raw('SUM(jawaban_osc.total_points)'));
            }], 'total_points')
            ->orderByDesc('total_points');
    }


    // custom function
    public function exportSelected()
    {
        if ($this->selectedRowsQuery->count() > 0) {
            return (new JawabanOSCExport($this->selectedRowsQuery()))->download("jawaban penyisihan osc.xlsx");
        } else {
            $this->emit('error', "Pilih Row Terlebih Dahulu");
        }
    }

    /**
     * isOnTime
     *
     * @param  mixed $olimpiade
     * @param  mixed $tahap
     * @return void
     */
    private function isOnTime($olimpiade = null, $tahap = "penyisihan")
    {
        if (!$olimpiade) return false;
        if ($tahap == 'final') return true;

        $uploadedAt = $olimpiade ? $olimpiade->uploaded_at : null;

        if (!$uploadedAt) return false;

        $startTime = new Carbon($olimpiade->created_at);
        $endTime =  $startTime->addHours(2);

        return $endTime->diffInMinutes($uploadedAt, false) <= 10;
    }

    /**
     * assignFinal
     *
     * masukkan tim ke tahap selanjutnya 
     *
     * @param  mixed $team_id
     * @return void
     */
    public function assignLolos($team_id, $tahap = 'penyisihan')
    {
        try {
            $team = Team::findOrFail($team_id);
            
            $team->givePermissionTo("osc_penyisihan_lolos");

            return $this->emit('success', "Tim Lolos Tahap Penyisihan, Lanjut Untuk Proses Pernyataan");
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

            return $this->emit('success', "Berhasil Menggugurkan");
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
    public function cancelLolos($team_id, $tahap = 'penyisihan')
    {
        try {
            $team = Team::findOrFail($team_id);

            $team->revokePermissionTo('osc_penyisihan_lolos');

            return $this->emit('success', "Tim dibatalkan lolos penyisihan");
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

            return $this->emit('success', "Berhasil menggagalkan pembatalan");
        } catch (\Exception $e) {
            return $this->emit('error', "Gagal");
        }
    }
}
