<?php

namespace App\Exports;

use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class JawabanOSCExport implements FromQuery, WithHeadings, WithMapping
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

    public function map($team): array
    {
        $slots = [];

        // maksimal 3 anggota
        for ($i = 0; $i < 3; $i++) {
            $user = $team->users[$i] ?? null;
            $slots[] = $user->name ?? '-';
            $slots[] = $user?->jawabanOsc?->total_points ?? '0';
        }

        return array_merge([
            "OSC_{$team->id}",
            $team->name,
        ], $slots);
    }

    public function headings(): array
    {
        return ["id", "nama tim", "nama anggota 1", "nilai anggota 1", "nama anggota 3", "nilai anggota 3", "nama anggota 3", "nilai anggota 3"];
    }
}
