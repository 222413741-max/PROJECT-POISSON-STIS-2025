<?php

namespace App\Http\Livewire\Soal_osc;

use App\Models\Soal_osc;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class Table_osc extends DataTableComponent
{

    public bool $columnSelect = true;

    public function columns(): array
    {
        return [
            Column::make('id')
                ->sortable()
                ->searchable()
                ->excludeFromSelectable(),

            Column::make('Soal', 'question')
                ->sortable()
                ->searchable()
                ->format(function ($value, $column, $row) {
                    return $value ? view('components.column.html-render', ['html' => $value]) : '';
                }),

            Column::make('Opsi_a', 'option_a')
                ->sortable()
                ->searchable(),

            Column::make('Opsi_b', 'option_b')
                ->sortable()
                ->searchable(),

            Column::make('Opsi_c', 'option_c')
                ->sortable()
                ->searchable(),

            Column::make('Opsi_d', 'option_d')
                ->sortable()
                ->searchable(),

            Column::make('Opsi_key', 'option_key')
                ->sortable()
                ->searchable(),

            Column::make('Poin_benar', 'correct_point')
                ->sortable()
                ->searchable(),

            Column::make('Poin_salah', 'wrong_point')
                ->sortable()
                ->searchable(),

            Column::make('Poin_kosong', 'blank_point')
                ->sortable()
                ->searchable(),

            Column::make('Paket', 'package')
                ->sortable()
                ->searchable(),

            Column::make('Aksi')
                ->format(function ($value, $column, $row) {
                    return view('components.column.soal_osc-action', ['row' => $row]);
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
            'package' => Filter::make('Paket Soal')
                ->select([
                    '' => 'Any',
                    'A' => 'A',
                    'B' => 'B',
                    'C' => 'C'
                    // 'semifinal' => 'Semifinal'
                ]),
        ];
    }

    public function query(): Builder
    {
        return Soal_osc::query()->when($this->getFilter('package'), fn ($query, $package) => $query->where('package', $package));
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
            $soal = Soal_osc::find($id);
            $soal->delete();

            $this->emit('success', "Berhasil menghapus soal");
            $this->emitSelf('reloadSoal');
        } catch (\Exception $e) {
            $this->emit('error', 'Gagal menghapus soal');
        }
    }
}
