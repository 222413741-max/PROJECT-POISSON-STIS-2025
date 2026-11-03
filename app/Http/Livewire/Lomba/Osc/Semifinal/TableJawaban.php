<?php

namespace App\Http\Livewire\Lomba\Osc\Semifinal;

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
        'tahap' => 'semifinal',
        'status' => 'peserta',
    ];

    public function getPresignedUrl($path)
    {
        $aws = new \App\Http\Controllers\AWS();
        return $aws->getPresignedUrl($path);
    }

    public function columns(): array
    {
        $tahap = $this->getFilter('tahap') ?? "semifinal";

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
                $semifinalOsc = $row->semifinalOsc->where('tahap', $tahap)->first();
                return $semifinalOsc ? $semifinalOsc->soal->code : "";
            }),

            Column::make('Jawaban')
                ->excludeFromSelectable()
                ->format(function ($value, $column, $row) use ($tahap) {
                    $semifinalOsc = $row->semifinalOsc->where('tahap', $tahap)->first();
                    return view('components.column.olimpiade-download', ['olimpiade' => $semifinalOsc]);
                }),

            Column::make('Mulai')
                ->format(function ($value, $column, $row) use ($tahap) {
                    $semifinalOsc = $row->semifinalOsc->where('tahap', $tahap)->first();
                    if ($semifinalOsc) {
                        if ($tahap == 'final') return $semifinalOsc->created_at->format('d M Y H:i:s');
                        return $semifinalOsc->created_at->format('H:i:s');
                    }
                    return "";
                }),

            Column::make('Selesai')
                ->format(function ($value, $column, $row) use ($tahap) {
                    $semifinalOsc = $row->semifinalOsc->where('tahap', $tahap)->first();
                    if ($semifinalOsc && $semifinalOsc->uploaded_at) {
                        if ($tahap == 'final') return $semifinalOsc->uploaded_at->format('d M Y H:i:s');
                        return $semifinalOsc->uploaded_at->format('H:i:s');
                    }
                    return "";
                }),

            Column::make('Tahap Lomba')
                ->format(function ($value, $column, $row) use ($tahap) {
                    $semifinalOsc = $row->semifinalOsc->where('tahap', $tahap)->first();
                    return $semifinalOsc ? $semifinalOsc->tahap : "";
                }),

            Column::make('status')
                ->excludeFromSelectable()
                ->format(function ($value, $column, $row) use ($tahap) {
                    $semifinalOsc = $row->semifinalOsc->where('tahap', $tahap)->first();
                    $isOnTime = $this->isOnTime($semifinalOsc, $tahap);
                    return view('components.column.osc-status', ['semifinalOsc' => $semifinalOsc, 'isOnTime' => $isOnTime]);
                }),

            Column::make('Aksi')
                ->excludeFromSelectable()
                ->format(function ($value, $column, $row) use ($tahap) {
                    $semifinalOsc = $row->semifinalOsc->where('tahap', $tahap)->first();
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
        return Team::getOSC()
            ->with('semifinalOsc')
            ->when($this->getFilter('tahap'), function ($query, $tahap) {
                switch ($tahap) {
                    case 'semifinal':
                        return $query->permission('osc_semifinal_peserta');
                    case 'final':
                        return $query->permission('osc_final_peserta');
                    default:
                        return $query;
                }
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
    private function isOnTime($olimpiade = null, $tahap = "semifinal")
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
    public function assignLolos($team_id, $tahap = 'semifinal')
    {
        try {
            $team = Team::findOrFail($team_id);

            $tahap == "semifinal"
                ? $team->givePermissionTo("osc_semifinal_lolos")
                : '';

            return $this->emit('success', "Tim Lolos Tahap Semifinal, Lanjut ke Babak Final Yeah");
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
    public function cancelLolos($team_id, $tahap = 'semifinal')
    {
        try {
            $team = Team::findOrFail($team_id);

            $tahap == "semifinal"
                ? $team->revokePermissionTo(["osc_semifinal_lolos", "osc_final_peserta"])
                : '';

            return $this->emit('success', "Tim dibatalkan lolos semifinal");
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
