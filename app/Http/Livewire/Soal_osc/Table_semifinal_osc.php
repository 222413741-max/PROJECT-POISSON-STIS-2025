<?php

namespace App\Http\Livewire\Soal_osc;

use App\Models\Soal_semifinal_osc;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class Table_semifinal_osc extends DataTableComponent
{

    public bool $columnSelect = true;

    public function columns(): array
    {
        return [
            Column::make('id')
                ->sortable()
                ->searchable()
                ->excludeFromSelectable(),

            Column::make('Nama', 'name')
                ->sortable() 
                ->searchable()
                ->excludeFromSelectable(),

            Column::make('Kode', 'code')
                ->sortable()
                ->searchable(),

            Column::make('Kata Sandi', 'password')
                ->sortable()
                ->searchable(),

            Column::make('Aksi')
                ->format(function ($value, $column, $row) {
                    return view('components.column.soal_semifinal_osc-action', ['row' => $row]);
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
        return Soal_semifinal_osc::query()->when($this->getFilter('type'), fn ($query, $type) => $query->where('type', $type));
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
            $soal = Soal_semifinal_osc::find($id);
            $soal->delete();

            if (File::exists(public_path('storage/' . $soal['path']))) {
                File::delete(public_path('storage/' . $soal['path']));
            }

            $this->emit('success', "Berhasil menghapus soal");
            $this->emitSelf('reloadSoal');
        } catch (\Exception $e) {
            $this->emit('error', 'Gagal menghapus soal');
        }
    }
}
