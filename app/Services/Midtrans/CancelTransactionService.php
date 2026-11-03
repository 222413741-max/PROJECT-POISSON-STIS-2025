<?php

namespace App\Services\Midtrans;

use Midtrans\Snap;

class CancelTransactionService extends Midtrans
{
    protected $midtrans_id;

    public function __construct($midtrans_id)
    {
        parent::__construct();

        $this->midtrans_id = $midtrans_id;
    }

    public function cancelTransaction()
    {
        return \Midtrans\Transaction::cancel($this->midtrans_id);
    }
}
