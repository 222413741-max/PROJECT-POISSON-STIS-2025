<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUjianSelesai
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Cari data jawaban milik user yang sedang login
        $jawaban = \App\Models\Jawaban_osc::where('user_id', auth()->id())->first();

        // Jika data jawaban ada DAN statusnya sudah selesai (misal, status '2')
        if ($jawaban && $jawaban->status == '2') {
            // Langsung alihkan ke halaman hasil, JANGAN biarkan masuk.
            // GANTI 'lomba.osc.penyisihan.finish' dengan nama rute hasil Anda.
            return redirect()->route('lomba.osc.penyisihan.finish');
        }

        // Jika belum selesai, baru izinkan pengguna melanjutkan ke halaman ujian.
        return $next($request);
    }
}
