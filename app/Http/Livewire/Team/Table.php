<?php

namespace App\Http\Livewire\Team;

use App\Exports\TeamsExport;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;
use App\Models\Team;

class Table extends DataTableComponent
{

    private $LOMBA_OLIMPIADE = 'olimpiade';
    private $LOMBA_INFOGRAFIS = 'infografis';
    private $LOMBA_OSC = 'osc';

    public bool $columnSelect = true;

    public string $defaultSortColumn = 'created_at';
    public string $defaultSortDirection = 'desc';

    public array $bulkActions = [
        'exportSelected' => 'Export Excel',
    ];

    public function columns(): array
    {
        return [
            Column::make('Nomor Tim', 'id')
                ->sortable()
                ->searchable()
                ->format(function ($value, $column, $row) {
                    return view('components.column.teams-id', ['row' => $row]);
                }),

            Column::make('Nama', 'name')
                ->sortable()
                ->searchable()
                ->excludeFromSelectable(),

            Column::make('Lomba', 'type')
                ->sortable()
                ->searchable()
                ->excludeFromSelectable(),

            Column::make('Status Konfirmasi')
                ->sortable()
                ->format(function ($value, $column, $row) {
                    return view('components.column.teams-confirmed', ['row' => $row]);
                }),

            Column::make('Tanggal Daftar', 'created_at')
                ->sortable()
                ->searchable(),

            Column::make('Detail')
                ->format(function ($value, $column, $row) {
                    return view('components.column.teams-detail', ['row' => $row]);
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
            'lomba' => Filter::make('Lomba')
                ->select([
                    '' => 'semua',
                    $this->LOMBA_INFOGRAFIS => $this->LOMBA_INFOGRAFIS,
                    $this->LOMBA_OLIMPIADE => $this->LOMBA_OLIMPIADE,
                    $this->LOMBA_OSC => $this->LOMBA_OSC,
                ]),
            'confirmed' => Filter::make('Status Konfirmasi')
                ->select([
                    '' => 'semua',
                    'confirmed' => "sudah dikonfirmasi",
                    'not_confirmed' => "belum dikonfirmasi",
                ]),
        ];
    }

    public function query(): Builder
    {
        return Team::query()
            ->when($this->getFilter('lomba'), fn ($query, $lomba) => $query->where('type', $lomba))
            ->when(
                $this->getFilter('confirmed'),
                fn ($query, $confirmed) =>
                $confirmed == 'confirmed'
                    ? $query->where('confirmed', 1)
                    : $query->where('confirmed', 0)
            );
    }

    // custom function

    public function exportSelected()
    {
        if ($this->selectedRowsQuery->count() > 0) {
            return (new TeamsExport($this->selectedRowsQuery()))->download("teams.xlsx");
        } else {
            $this->emit('error', "Pilih Row Terlebih Dahulu");
        }
    }
}
