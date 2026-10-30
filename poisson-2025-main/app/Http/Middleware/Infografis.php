<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Infografis
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
        $team = Auth::user()->teamInfografis();
        if (!$team) return redirect()->back();

        switch ($tahap) {
            case 'penyisihan':
                $waktu_mulai = new \Carbon\Carbon(\App\Models\Tanggal::where('kegiatan', 'Penyisihan Infografis Mulai')->pluck('time')->first());
                // $date = new Carbon(config('variables.time.infografis_penyisihan_start'));
                if ($waktu_mulai->subHour()->isFuture()) return redirect()->back();

                if (!$team->hasPermissionTo('infografis_penyisihan_peserta')) return redirect()->back();
                break;

            case 'final':
                $waktu_mulai = new \Carbon\Carbon(\App\Models\Tanggal::where('kegiatan', 'Final Infografis Mulai')->pluck('time')->first());
                if ($waktu_mulai->subHour()->isFuture()) return redirect()->back();

                if (!$team->hasPermissionTo('infografis_final_peserta')) return redirect()->back();
                break;
            default:
                return redirect()->back();
        }

        return $next($request);
    }
}
