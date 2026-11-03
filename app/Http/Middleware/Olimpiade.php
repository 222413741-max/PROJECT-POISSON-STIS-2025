<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Olimpiade
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, String $tahap)
    {
        $team = Auth::user()->teamOlimpiade();
        if (!$team) return redirect()->back();

        switch ($tahap) {
            case 'penyisihan':
                // Open 1 Hour before
                $waktu_mulai = new \Carbon\Carbon(\App\Models\Tanggal::where('kegiatan', 'Penyisihan Olimpiade Mulai')->pluck('time')->first());

                if ($waktu_mulai->subHour()->isFuture()) return redirect()->back();

                if (!$team->hasPermissionTo('olimpiade_penyisihan_peserta')) return redirect()->back();
                break;

            case 'semifinal':
                $waktu_mulai = new \Carbon\Carbon(\App\Models\Tanggal::where('kegiatan', 'Semifinal Olimpiade Mulai')->pluck('time')->first());

                if ($waktu_mulai->subHour()->isFuture()) return redirect()->back();

                if (!$team->hasPermissionTo('olimpiade_semifinal_peserta')) return redirect()->back();
                break;

            case 'final':
                if (!$team->hasPermissionTo('olimpiade_final_peserta')) return redirect()->back();
                break;
            default:
                return redirect()->back();
        }

        return $next($request);
    }
}
