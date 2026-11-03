<?php

namespace App\Http\Livewire\Users;

use App\Exports\UsersExport;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Notification;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;
use App\Notifications\UserVerificationNotification;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;

class Table extends DataTableComponent
{

    private $ROLE_PENDAFTAR = "users";
    private $ROLE_PESERTA = "peserta";
    private $ROLE_ADMIN = "admin";


    public bool $columnSelect = true;

    public string $defaultSortColumn = 'created_at';
    public string $defaultSortDirection = 'desc';

    public array $bulkActions = [
        'exportSelected' => 'Export Excel',
    ];

    /**
     * columns
     *
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make('id')
                ->sortable()
                ->searchable()
                ->format(function ($value) {
                    return "POI_{$value}";
                })
                ->excludeFromSelectable(),
            Column::make('Nama', 'name')
                ->sortable()
                ->searchable()
                ->format(function ($value, $column, $row) {
                    return view('components.column.users-name', ['row' => $row]);
                })
                ->excludeFromSelectable(),
            Column::make('E-mail', 'email')
                ->sortable()
                ->searchable(),
            Column::make('Universitas', 'college')
                ->sortable()
                ->searchable(),
            Column::make('Tahun Masuk', 'year_in')
                ->sortable()
                ->searchable(),
            Column::make('Link Twibbon', 'link_twibbon')
                ->sortable()
                ->searchable()
                ->format(function ($value) {
                    return '<a href="' . $value . '" target="_blank" class="text-blue-500 underline">' . $value . '</a>';
                })
                ->asHtml(),

            // custom column

            Column::make('Status')
                ->format(function ($value, $column, $row) {
                    return view('components.column.users-status-role', ['row' => $row]);
                }),

            Column::make('Kartu Tanda Mahasiswa', 'student_card_url')
                ->format(function ($value, $column, $row) {
                    return view('components.column.users-student-card', ['row' => $row]);
                }),

            Column::make('Logo Universitas/Sekolah', 'school_logo_url')
                ->format(function ($value, $column, $row) {
                    return view('components.column.users-school-logo', ['row' => $row]);
                }),

            Column::make('Aksi')
                ->format(function ($value, $column, $row) {
                    return view('components.column.users-action-verify', ['row' => $row]);
                }),

            Column::make('Detail')
                ->format(function ($value, $column, $row) {
                    return view('components.column.users-action-detail', ['row' => $row]);
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
            'role' => Filter::make('Tipe User')
                ->select([
                    '' => 'Semua',
                    $this->ROLE_PENDAFTAR => 'Pendaftar Baru',
                    $this->ROLE_PESERTA => 'Peserta',
                    $this->ROLE_ADMIN => 'Administrators',
                ]),
            'verification_status' => Filter::make('Status Verifikasi')
                ->select([
                    '' => 'Semua',
                    'verified' => 'Terverifikasi',
                    'unverified' => 'Tidak Terverifikasi',
                ]),
            'data_completeness' => Filter::make('Kelengkapan Data')
                ->select([
                    '' => 'Semua',
                    'complete' => 'Lengkap',
                    'incomplete' => 'Belum Lengkap',
                ])
        ];
    }

    /**
     * query
     *
     * @return Builder
     */
    public function query(): Builder
    {
        return User::query()
            ->when($this->getFilter('role'), fn($query, $role) => $query->role($role))
            ->when($this->getFilter('verification_status'), function ($query, $status) {
                if ($status === 'verified') {
                    $query->role($this->ROLE_PESERTA);
                } elseif ($status === 'unverified') {
                    $query->whereDoesntHave('roles', function ($roleQuery) {
                        $roleQuery->whereIn('name', [$this->ROLE_ADMIN, $this->ROLE_PESERTA]);
                    });
                }
            })
            ->when($this->getFilter('data_completeness'), function ($query, $completeness) {
                if ($completeness === 'complete') {
                    return $query->where(function ($q) {
                        $q->where('university_tipe', '<=', 2)
                            ->where('university_tipe', '>=', 0)
                            ->whereNotNull('college')
                            ->whereNotNull('no_telp')
                            ->whereNotNull('student_card')
                            ->whereNotNull('year_in')
                            ->whereNotNull('link_twibbon')
                            ->where('college', '!=', '')
                            ->where('no_telp', '!=', '')
                            ->where('student_card', '!=', '')
                            ->where('school_logo', '!=', '')
                            ->where('year_in', '!=', '')
                            ->where('link_twibbon', '!=', '');
                    });
                } elseif ($completeness === 'incomplete') {
                    return $query->where(function ($q) {
                        $q->where('university_tipe', '>', 2)
                            ->orWhere('university_tipe', '<', 0)
                            ->orWhereNull('college')
                            ->orWhereNull('no_telp')
                            ->orWhereNull('student_card')
                            ->orWhereNull('year_in')
                            ->orWhereNull('link_twibbon')
                            ->orWhere('college', '')
                            ->orWhere('no_telp', '')
                            ->orWhere('student_card', '')
                            ->orWhere('school_logo', '')
                            ->orWhere('year_in', '')
                            ->orWhere('link_twibbon', '');
                    });
                }
                return $query;
            });
    }


    // custom function to table

    public function exportSelected()
    {
        if ($this->selectedRowsQuery->count() > 0) {
            return (new UsersExport($this->selectedRowsQuery()))->download("users.xlsx");
        } else {
            $this->emit('error', "Pilih Row Terlebih Dahulu");
        }
    }

    /**
     * verify
     *
     * @return void
     */
    public function verify($id)
    {
        try {
            $user = User::find($id);

            $user->syncRoles($this->ROLE_PESERTA);

            Notification::send($user, new UserVerificationNotification());

            $this->emit('success', 'Berhasil memverifikasi peserta');
        } catch (\Exception $e) {
            $this->emit('error', $e->getMessage());
        }
    }

    /**
     * unverify
     *
     * @param  mixed $id
     * @return void
     */
    public function unverify($id)
    {
        try {
            $user = User::find($id);

            $user->syncRoles($this->ROLE_PENDAFTAR);

            $this->emit('success', 'Verifikasi peserta berhasil dihapus');
        } catch (\Exception $e) {
            $this->emit('error', $e->getMessage());
        }
    }
}
