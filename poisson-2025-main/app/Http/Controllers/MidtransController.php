<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MidtransController extends Controller
{
    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash(
            'sha512',
            $request->order_id .
                $request->status_code .
                $request->gross_amount .
                $serverKey
        );

        if ($hashed == $request->signature_key) {
            if (
                $request->transaction_status == 'capture' ||
                $request->transaction_status == 'settlement'
            ) {
                $payment = \App\Models\Payment::where('midtrans_order_id', $request->order_id)->first();
                $payment->confirmed = 1;
                $payment->save();

                $team = $payment->team;
                // if ($team->type == 'infografis') {
                //     if ($payment->type == config('variables.payments.infografis_1')) {
                //         $team->confirmed = true;
                //         $team->save();
                //         $team->givePermissionTo('infografis_penyisihan_peserta');
                //     }
                // } else if($team->type == 'olimpiade') {
                //     if ($payment->type == config('variables.payments.olimpiade_2')) {
                //         $team->givePermissionTo('olimpiade_semifinal_peserta');
                //     }
                // }
                switch ($payment->type) {
                    case config('variables.payments.olimpiade_1'):
                        $team->confirmed = true;
                        $team->save();
                        $team->givePermissionTo('olimpiade_penyisihan_peserta');
                        break;
                    case config('variables.payments.olimpiade_2'):
                        $team->givePermissionTo('olimpiade_semifinal_peserta');
                        break;
                    case config('variables.payments.infografis_1'):
                        $team->confirmed = true;
                        $team->save();
                        $team->givePermissionTo('infografis_penyisihan_peserta');
                        break;
                    case config('variables.payments.osc_1'):
                        $team->confirmed = true;
                        $team->save();
                        $team->givePermissionTo('osc_penyisihan_peserta');
                        break;
                    default:
                        return false; 
                }

            } elseif (
                $request->transaction_status == 'deny' ||
                $request->transaction_status == 'cancel' ||
                $request->transaction_status == 'expire'
            ) {
                $payment = \App\Models\Payment::where('midtrans_order_id', $request->order_id)->first();
                $payment->confirmed = 0;
                $payment->save();
            }
        }
    }
}
