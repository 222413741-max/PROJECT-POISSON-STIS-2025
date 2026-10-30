<?php

namespace App\Exports;

use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class UsersExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    private $selectedRowQuery;

    public function __construct(Builder $selectedRowQuery)
    {
        $this->selectedRowQuery = $selectedRowQuery;
    }


    public function query()
    {
        return $this->selectedRowQuery;
    }

    public function map($user): array
    {
        return [
            "POI_{$user->id}",
            $user->name,
            $user->email,
            $user->no_telp,
            $user->hasRole('admin') ? "admin" : ($user->hasRole('peserta') ? "peserta" : "pendaftar baru"),
            $user->college,
            $user->year_in,
            Date::dateTimeToExcel($user->created_at)
        ];
    }


    public function headings(): array
    {
        return ["id", "name", "email", "no telpon", "role", "universitas", "tahun masuk", "waktu daftar"];
    }
}
