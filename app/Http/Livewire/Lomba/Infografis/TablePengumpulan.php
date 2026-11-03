<?php

namespace App\Http\Livewire\Lomba\Infografis;

use App\Models\Team;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class TablePengumpulan extends DataTableComponent
{

    public bool $columnSelect = true;

    public function getPresignedUrl($path)
    {
        $aws = new \App\Http\Controllers\AWS();
        return $aws->getPresignedUrl($path);
    }

    public function columns(): array
    {
        return [
            Column::make('Nomor Tim', 'id')
                ->sortable()
                ->searchable()
                ->format(function ($value, $column, $row) {
                    return view('components.column.lomba-teams-so', ['row' => $row->users[0]]);
                }),

            Column::make('Nama Tim', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Judul', 'infografis.name')
                ->searchable()
                ->format(function ($value) {
                    return Str::limit($value, 50);
                }),

            Column::make('Dibuat', 'infografis.created_at'),

            Column::make('Unduh', 'download')
                ->format(function ($value, $column, $row) {
                    $infografisUrl = $this->getPresignedUrl(ltrim(parse_url($row->infografis->infografis, PHP_URL_PATH), '/'));
                    $pptUrl = $row->infografis->ppt ? $this->getPresignedUrl(ltrim(parse_url($row->infografis->ppt, PHP_URL_PATH), '/')) : null;
                    return view('components.column.infografis-download', [
                        'infografisUrl' => $infografisUrl,
                        'pptUrl' => $pptUrl,
                        'row' => $row
                    ]);
                }),

            Column::make('Aksi')
                ->format(function ($value, $column, $row) {
                    return view('components.column.infografis-action', ['row' => $row]);
                })

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
            'status' => Filter::make('Status TIM')
                ->select([
                    '' => 'Any',
                    "infografis_penyisihan_peserta" => 'Peserta Penyisihan',
                    "infografis_penyisihan_lolos" => 'Lolos Penyisihan',
                    "infografis_final_peserta" => 'Peserta Final',
                    "fail" => 'Gagal / Tidak Lanjut',
                ]),
        ];
    }


    public function query(): Builder
    {
        return Team::getInfografis()->has('infografis')
            ->when($this->getFilter('status'), fn ($query, $permission) => $query->permission($permission));
    }


    // custom function

    /**
     * assignLolos
     *
     * masukkan ke lolos penyisihan, which is tambah permission aja.
     *
     * @param  mixed $team_id
     * @return void
     */
    public function assignLolos($team_id)
    {
        try {
            $team = Team::findOrFail($team_id);
            $team->givePermissionTo('infografis_penyisihan_lolos');
            return $this->emit('success', 'Berhasil Meloloskan Tim');
        } catch (\Exception $e) {
            return $this->emit('error', 'Gagal, silahkan coba lagi');
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
            return $this->emit('success', "Berhasil");
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
    public function cancelLolos($team_id)
    {
        try {
            $team = Team::findOrFail($team_id);
            $team->revokePermissionTo('infografis_penyisihan_lolos');
            return $this->emit('success', "Tim dibatalkan lolos");
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
