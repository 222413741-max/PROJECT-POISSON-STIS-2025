<?php

namespace App\Exports;

use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class TeamsExport implements FromQuery, WithHeadings, WithMapping
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
        $payment = $team->payments->first();
        $payment_status = false;
        if ($payment) {
            $payment_status = $payment->confirmed;
        }
        $team_array = [
            ($team->type == 'olimpiade' ? "OLM{$team->id}" : ($team->type == 'osc' ? "OSC{$team->id}" : "INF{$team->id}")),
            $team->name,
            $team->type,
            $team->confirmed ? "terkonfirmasi" : "belum",
            Date::dateTimeToExcel($team->created_at),
            $payment_status ? 'sukses' : 'pending',
            $payment ? $payment->midtrans_order_id : ''
        ];

        $users = $team->users;
        $user_1 = $users->get(0);
        $user_2 = $users->get(1);
        $user_3 = $users->get(2);

        $user_array = $user_1 ? array_merge([
            $user_1->name,
            $user_1->college,
            $user_1->year_in,
            $user_1->email,
            $user_1->no_telp
        ]) : [];
        $user_array = $user_2 ? array_merge($user_array, [
            $user_2->name,
            $user_2->college,
            $user_2->year_in,
            $user_2->email,
            $user_2->no_telp
        ]) : $user_array;
        $user_array = $user_3 ? array_merge($user_array, [
            $user_3->name,
            $user_3->college,
            $user_3->year_in,
            $user_3->email,
            $user_3->no_telp
        ]) : $user_array;

        return array_merge($team_array, $user_array);
    }


    public function headings(): array
    {
        return [
            "nomor tim",
            "nama tim",
            "lomba",
            "status konfirmasi",
            "dibuat pada",
            "status pembayaran",
            "midtrans order id",
            "anggota 1",
            "universitas/sma",
            "tahun masuk",
            "email",
            "whatsapp",
            "anggota 2",
            "universitas/sma",
            "tahun masuk",
            "email",
            "whatsapp",
            "anggota 3",
            "universitas/sma",
            "tahun masuk",
            "email",
            "whatsapp"
        ];
    }
}
