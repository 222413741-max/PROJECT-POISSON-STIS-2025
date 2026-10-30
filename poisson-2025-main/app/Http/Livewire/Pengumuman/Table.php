<?php

namespace App\Http\Livewire\Pengumuman;

use App\Models\Pengumuman;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class Table extends DataTableComponent
{

    public bool $columnSelect = true;

    public string $defaultSortColumn = 'created_at';
    public string $defaultSortDirection = 'desc';

    public function columns(): array
    {
        return [
            Column::make(__('table.pengumuman'), 'name')
                ->searchable()
                ->sortable(),

            Column::make(__('table.tanggal'), 'created_at')
                ->sortable()
                ->searchable(),

            Column::make(__('table.deskripsi'), 'description')
                ->sortable()
                ->searchable()
                ->format(function ($value) {
                    return Str::limit($value, 20);
                }),

            Column::make(__('table.aksi'))
                ->format(function ($value, $column, $row) {
                    return view('components.column.pengumuman-action', ['row' => $row]);
                }),
        ];
    }

    public function query(): Builder
    {
        return Pengumuman::query();
    }

    // custom function

    /**
     * delete
     *
     * menghapus penumuman
     *
     * @return void
     */
    public function delete($id)
    {
        try {
            $soal = Pengumuman::find($id);
            $soal->delete();

            $this->emit('success', __("message.Berhasil menghapus pengumuman"));
        } catch (\Exception $e) {
            $this->emit('error', __('message.Gagal menghapus pengumuman'));
        }
    }
}
