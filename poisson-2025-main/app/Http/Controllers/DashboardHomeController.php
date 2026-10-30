<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;

class DashboardHomeController extends Controller
{
    public function index(Request $request)
    {
        // Cek ada parameter Midtrans
        if ($request->has('order_id') && $request->has('transaction_status')) {
            $orderId = $request->get('order_id');
            $transactionStatus = $request->get('transaction_status');

            $payment = Payment::where('midtrans_order_id', $orderId)->first();

            if ($payment) {
                $message = '';
                switch ($transactionStatus) {
                    case 'settlement':
                    case 'capture':
                        $message = 'success|Pembayaran berhasil! Tim Anda telah dikonfirmasi dan dapat mengikuti kompetisi.';
                        break;
                    case 'pending':
                        $message = 'info|Pembayaran belum selesai diproses. Silakan coba lagi untuk melanjutkan pendaftaran.';
                        break;
                    default:
                        $message = 'error|Pembayaran gagal atau dibatalkan. Silakan coba lagi untuk melanjutkan pendaftaran.';
                        break;
                }

                return redirect()->route('dashboard')->with('payment_notification', $message);
            }
        }

        return view('dashboard.home');
    }
}
