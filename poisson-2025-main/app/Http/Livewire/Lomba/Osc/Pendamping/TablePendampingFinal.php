<?php

namespace App\Http\Livewire\Lomba\Osc\Pendamping;

use App\Models\PendampingOsc;
use App\Models\Team;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class TablePendampingFinal extends DataTableComponent
{
    public bool $columnSelect = true;

    public function columns(): array
    {
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

            Column::make('Nama Pendamping', 'pendampingOsc.nama_pendamping')
                ->sortable()
                ->searchable()
                ->format(function ($value, $column, $row) {
                    return $row->getPendampingOsc() ? $row->getPendampingOsc()->nama_pendamping : '-';
                }),

            Column::make('Status Pendamping', 'pendampingOsc.status_pendamping')
                ->sortable()
                ->searchable()
                ->format(function ($value, $column, $row) {
                    return $row->getPendampingOsc() ? $row->getPendampingOsc()->status_pendamping : '-';
                }),

            Column::make('Kontak WA', 'pendampingOsc.kontak_wa_pendamping')
                ->sortable()
                ->searchable()
                ->format(function ($value, $column, $row) {
                    return view('components.column.pendamping-osc-whatsapp', ['row' => $row]);
                }),

            Column::make('Foto Pendamping')
                ->format(function ($value, $column, $row) {
                    return view('components.column.pendamping-osc-foto', ['row' => $row]);
                }),

            Column::make('Status Upload', 'status')
                ->sortable()
                ->format(function ($value, $column, $row) {
                    return view('components.column.pendamping-osc-status', ['row' => $row]);
                }),
            Column::make('Aksi')
                ->format(function ($value, $column, $row) {
                    return view('components.column.pendamping-osc-action', ['row' => $row]);
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
            'status' => Filter::make('Status Upload')
                ->select([
                    '' => 'Semua',
                    'uploaded' => 'Sudah Upload',
                    'not_uploaded' => 'Belum Upload'
                ]),

            'status_pendamping' => Filter::make('Status Pendamping')
                ->select([
                    '' => 'Semua',
                    'Guru' => 'Guru',
                    'Orang Tua Peserta' => 'Orang Tua Peserta',
                    'Lainnya' => 'Lainnya'
                ]),

            'foto' => Filter::make('Status Foto')
                ->select([
                    '' => 'Semua',
                    'ada_foto' => 'Ada Foto',
                    'tidak_ada_foto' => 'Tidak Ada Foto'
                ]),
        ];
    }

    /**
     * Abstract override, searching from filter
     *
     * @return Builder
     */
    public function query(): Builder
    {
        return Team::getOSC()
            ->with('pendampingOsc')
            ->permission('osc_final_peserta') // Hanya tim yang lolos ke final
            ->when($this->getFilter('status'), function ($query, $status) {
                switch ($status) {
                    case 'uploaded':
                        return $query->whereHas('pendampingOsc');
                    case 'not_uploaded':
                        return $query->whereDoesntHave('pendampingOsc');
                    default:
                        return $query;
                }
            })
            ->when($this->getFilter('status_pendamping'), function ($query, $statusPendamping) {
                return $query->whereHas('pendampingOsc', function ($q) use ($statusPendamping) {
                    if ($statusPendamping === 'Lainnya') {
                        $q->whereNotIn('status_pendamping', ['Guru', 'Orang Tua Peserta']);
                    } else {
                        $q->where('status_pendamping', $statusPendamping);
                    }
                });
            })
            ->when($this->getFilter('foto'), function ($query, $foto) {
                switch ($foto) {
                    case 'ada_foto':
                        return $query->whereHas('pendampingOsc', function ($q) {
                            $q->whereNotNull('foto_pendamping');
                        });
                    case 'tidak_ada_foto':
                        return $query->whereHas('pendampingOsc', function ($q) {
                            $q->whereNull('foto_pendamping');
                        });
                    default:
                        return $query;
                }
            });
    }

    /**
     * delete
     *
     * menghapus data pendamping
     *
     * @param int $id
     * @return void
     */
    public function delete($id)
    {
        try {
            $pendamping = PendampingOsc::find($id);

            if (!$pendamping) {
                session()->flash('error', 'Data pendamping tidak ditemukan');
                return;
            }

            // Delete foto if exists
            if ($pendamping->foto_pendamping && File::exists(public_path('storage/' . $pendamping->foto_pendamping))) {
                File::delete(public_path('storage/' . $pendamping->foto_pendamping));
            }

            $pendamping->delete();

            session()->flash('success', "Berhasil menghapus data pendamping");

            // Refresh the table
            $this->resetPage();
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menghapus data pendamping: ' . $e->getMessage());
        }
    }
}
