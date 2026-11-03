<?php

namespace App\Services\Midtrans;

use Midtrans\Snap;
use Illuminate\Support\Facades\Log;

class CreateSnapTokenService extends Midtrans
{
    protected $order_id;
    protected $lomba;
    protected $metode;
    protected $type;

    public function __construct($order_id, $lomba, $metode, $type = null)
    {
        parent::__construct();

        $this->order_id = $order_id;
        $this->lomba = $lomba;
        $this->metode = $metode;
        $this->type = $type;

    }

    public function getSnapToken()
    {
        $gross_amount = 0;
        switch ($this->lomba) {
            case 'infografis':
                // Cek tanggal jika 16 - 20 September 2025 maka harga 40.000
                $currentDate = date('Y-m-d');
                if ($currentDate >= '2025-09-16' && $currentDate <= '2025-09-20') {
                    $gross_amount += 40000; 
                    break;
                }

                // Jika selain itu harga 50.000
                $gross_amount += 50000; 
                break;
            case 'olimpiade':
                $gross_amount += $this->type == 'OLMPD_2' ? 120000 : 30000;
                break;
            case 'osc':
                $gross_amount += 30000;
                break;
        }
        $gross_amount += ($this->metode == 'other_qris' ? 0 : 4500);

        $params = [
            'transaction_details' => [
                'order_id' => $this->order_id,
                'gross_amount' => $gross_amount,
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
                'phone' => '081234567890',
            ],
            'enabled_payments' => array($this->metode),
        ];

        // LOG request payload
        Log::info('Midtrans Request:', $params);

        $snapToken = Snap::getSnapToken($params);

        // LOG response token
        Log::info('Midtrans Response:', ['snapToken' => $snapToken]);

        return $snapToken;
    }
}
