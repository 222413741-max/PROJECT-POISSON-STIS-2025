<?php

namespace App\Http\Livewire\Payments;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Payment;
use App\Notifications\PaymentsNotification;
use Illuminate\Support\Facades\Notification;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class Table extends DataTableComponent
{

    public bool $columnSelect = true;

    public string $defaultSortColumn = 'created_at';
    public string $defaultSortDirection = 'desc';

    public function columns(): array
    {
        return [
            Column::make('Pembayaran', 'type')
                ->searchable()
                ->sortable()
                ->excludeFromSelectable()
                ->format(function ($value) {
                    return getPaymentType($value);
                }),

            Column::make('Tim', 'team')
                ->excludeFromSelectable()
                ->format(function ($value, $column, $row) {
                    return view('components.column.payments-teams', ['row' => $row]);
                }), 

            Column::make('Tanggal Bayar', 'created_at')
                ->sortable()
                ->searchable(),

            Column::make('Midtrans Order ID', 'midtrans_order_id')
                ->sortable()
                ->searchable(),

            Column::make('Metode Pembayaran', 'payment_method')
                ->sortable()
                ->searchable(),

            // Column::make('Bukti', 'payment_url')
            //     ->excludeFromSelectable()
            //     ->format(function ($value, $column, $row) {
            //         return view('components.column.payments-image', ['row' => $row]);
            //     }),

            Column::make('Status Pembayaran', 'confirmed')
                ->sortable()
                ->searchable()
                ->format(function ($value, $column, $row) {
                    return view('components.column.payments-status', ['row' => $row]);
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
            'type' => Filter::make('Type')
                ->select([
                    '' => 'Semua',
                    config('variables.payments.olimpiade_1') => getPaymentType(config('variables.payments.olimpiade_1')),
                    config('variables.payments.olimpiade_2') => getPaymentType(config('variables.payments.olimpiade_2')),
                    config('variables.payments.infografis_1') => getPaymentType(config('variables.payments.infografis_1')),
                ]),

            'confirmed' => Filter::make('Status Konfirmasi')
                ->select([
                    '' => 'Semua',
                    'confirmed' => "Sudah Dikonfirmasi",
                    'not_confirmed' => "Belum Dikonfirmasi",
                ]),
        ];
    }


    public function query(): Builder
    {
        return Payment::query()
            ->when($this->getFilter('type'), fn ($query, $type) => $query->where('type', $type))
            ->when(
                $this->getFilter('confirmed'),
                fn ($query, $confirmed) =>
                $confirmed == 'confirmed'
                    ? $query->where('confirmed', 1)
                    : $query->where('confirmed', 0)
            );
    }

    /**
     * verify
     *
     * @param  mixed $payments_id
     * @return void
     */
    public function verify($payments_id)
    {
        $verify = Payment::verify($payments_id);

        if (!$verify) return $this->emit('error', 'Gagal Mengonfirmasi Pembayaran');

        // Send notification email
        $team = Payment::find($payments_id)->team;
        $user = $team->users()->first();

        Notification::send($user, new PaymentsNotification($team->name));

        return $this->emit('success', 'Berhasil Mengonfirmasi Pembayaran');
    }
}
