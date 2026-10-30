<?php

namespace App\Http\Livewire\Tanggal;

use App\Models\Tanggal;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class Table extends DataTableComponent
{
    public bool $columnSelect = true;

    public string $defaultSortColumn = 'id';
    public string $defaultSortDirection = 'asc';

    public function columns(): array
    {
        return [
            Column::make('kegiatan', 'kegiatan')
                ->searchable()
                ->sortable()
                ->excludeFromSelectable(),
            Column::make('waktu', 'time')
                ->sortable()
                ->searchable()
                ->excludeFromSelectable(),
        ];
    }

    public function query(): Builder
    {
        return Tanggal::query();
    }

}
