<?php

namespace App\Http\Livewire\Lomba\Olimpiade;

use Carbon\Carbon;
use App\Models\Team;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class TableJawaban extends DataTableComponent
{

    public bool $columnSelect = true;

    public array $filters = [
        'tahap' => 'penyisihan',
        'status' => 'peserta',
    ];

    public function getPresignedUrl($path)
    {
        $aws = new \App\Http\Controllers\AWS();
        return $aws->getPresignedUrl($path);
    }

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

            Column::make('Nama Tim', 'name')
                ->sortable()
                ->excludeFromSelectable()
                ->searchable(),

            Column::make('Kode')
            ->format(function ($value, $column, $row) use ($tahap) {
                $olimpiade = $row->olimpiade->where('tahap', $tahap)->first();
                return $olimpiade ? $olimpiade->soal->code : "";
            }),

            Column::make('Jawaban')
                ->excludeFromSelectable()
                ->format(function ($value, $column, $row) use ($tahap) {
                    $olimpiade = $row->olimpiade->where('tahap', $tahap)->first();
                    return view('components.column.olimpiade-download', ['olimpiade' => $olimpiade]);
                }),

            Column::make('Mulai')
                ->format(function ($value, $column, $row) use ($tahap) {
                    $olimpiade = $row->olimpiade->where('tahap', $tahap)->first();
                    if ($olimpiade) {
                        if ($tahap == 'final') return $olimpiade->created_at->format('d M Y H:i:s');
                        return $olimpiade->created_at->format('H:i:s');
                    }
                    return "";
                }),

            Column::make('Selesai')
                ->format(function ($value, $column, $row) use ($tahap) {
                    $olimpiade = $row->olimpiade->where('tahap', $tahap)->first();
                    if ($olimpiade && $olimpiade->uploaded_at) {
                        if ($tahap == 'final') return $olimpiade->uploaded_at->format('d M Y H:i:s');
                        return $olimpiade->uploaded_at->format('H:i:s');
                    }
                    return "";
                }),

            Column::make('Tahap Lomba')
                ->format(function ($value, $column, $row) use ($tahap) {
                    $olimpiade = $row->olimpiade->where('tahap', $tahap)->first();
                    return $olimpiade ? $olimpiade->tahap : "";
                }),

            Column::make('status')
                ->excludeFromSelectable()
                ->format(function ($value, $column, $row) use ($tahap) {
                    $olimpiade = $row->olimpiade->where('tahap', $tahap)->first();
                    $isOnTime = $this->isOnTime($olimpiade, $tahap);
                    return view('components.column.olimpiade-status', ['olimpiade' => $olimpiade, 'isOnTime' => $isOnTime]);
                }),

            Column::make('Aksi')
                ->excludeFromSelectable()
                ->format(function ($value, $column, $row) use ($tahap) {
                    $olimpiade = $row->olimpiade->where('tahap', $tahap)->first();
                    return view('components.column.olimpiade-action', ['row' => $row, 'tahap' => $tahap, 'olimpiade' => $olimpiade]);
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
        return Team::getOlimpiade()
            ->with('olimpiade')
            ->when($this->getFilter('tahap'), function ($query, $tahap) {
                switch ($tahap) {
                    case 'penyisihan':
                        return $query->permission('olimpiade_penyisihan_peserta');
                    case 'semifinal':
                        return $query->permission('olimpiade_semifinal_peserta');
                    case 'final':
                        return $query->permission('olimpiade_final_peserta');
                    default:
                        return $query;
                }
            })
            ->when($this->getFilter('status'), function ($query, $status) {
                $tahap = $this->getFilter('tahap') ?? "penyisihan";
                if ($tahap == "penyisihan" && $status == 'lolos') {
                    return $query->permission('olimpiade_penyisihan_lolos');
                }
                if ($tahap == "semifinal" && $status == "lolos") {
                    return $query->permission('olimpiade_semifinal_lolos');
                }
                return $query;
            });
    }


    // custom function

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

        return $endTime->diffInMinutes($uploadedAt, false) <= 9;
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

            $tahap == "penyisihan"
                ? $team->givePermissionTo("olimpiade_penyisihan_lolos")
                : $team->givePermissionTo("olimpiade_semifinal_lolos");

            if ($tahap == 'penyisihan') {
                Payment::create([
                    'team_id' => $team_id,
                    'type' => config('variables.payments.olimpiade_2'),
                ]);
            }

            return $this->emit('success', "Tim Lolos Tahap {$tahap}");
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
    public function cancelLolos($team_id, $tahap = 'penyisihan')
    {
        try {
            $team = Team::findOrFail($team_id);

            $tahap == "penyisihan"
                ? $team->revokePermissionTo("olimpiade_penyisihan_lolos")
                : $team->revokePermissionTo("olimpiade_semifinal_lolos");

            return $this->emit('success', "Tim dibatalkan lolos {$tahap}");
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
