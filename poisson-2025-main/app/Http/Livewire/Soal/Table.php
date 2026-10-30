<?php

namespace App\Http\Livewire\Soal;

use App\Models\Soal;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class Table extends DataTableComponent
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

            Column::make('Tipe', 'type')
                ->sortable()
                ->searchable(),

            Column::make('Aksi')
                ->format(function ($value, $column, $row) {
                    return view('components.column.soal-action', ['row' => $row]);
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
            'type' => Filter::make('Soal Tahap')
                ->select([
                    '' => 'Any',
                    'penyisihan' => 'Penyisihan',
                    'semifinal' => 'Semifinal'
                ]),
        ];
    }

    public function query(): Builder
    {
        return Soal::query()->when($this->getFilter('type'), fn ($query, $type) => $query->where('type', $type));
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
            $soal = Soal::find($id);
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
