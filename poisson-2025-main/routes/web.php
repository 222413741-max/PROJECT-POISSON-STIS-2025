<?php

use App\Models\Team;
use App\Models\User;
use App\Models\Tanggal;
use App\Http\Controllers\Home;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
// use Illuminate\Support\Facades\Artisan;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$pembukaanPendaftaran = env('PEMBUKAAN_PENDAFTARAN');

Route::get('/', function () use ($pembukaanPendaftaran) {

    if (\Carbon\Carbon::now()->lessThan(\Carbon\Carbon::parse($pembukaanPendaftaran))) {
        return redirect('comingsoon');
    }
    return Inertia::render('App');
});

Route::get('/landingpage', function () use ($pembukaanPendaftaran) {

    if (\Carbon\Carbon::now()->lessThan(\Carbon\Carbon::parse($pembukaanPendaftaran))) {
        return redirect('comingsoon');
    }

    return Inertia::render('App');
});

Route::get('/comingsoon', function () {
    return Inertia::render('ComingSoon');
});

Route::get('/photobooth', function () {
    return view('photobooth.index');
})->name('photobooth');

// Route::get('/bersihkan-cache-sekarang-12345', function() {
//     try {
//         Artisan::call('optimize:clear');
//         return "<h1>SEMUA CACHE BERHASIL DIBERSIHKAN!</h1> <p>Silakan hapus kode ini dari routes/web.php sekarang.</p>";
//     } catch (\Exception $e) {
//         return "<h1>TERJADI ERROR:</h1> <pre>" . $e->getMessage() . "</pre>";
//     }
// });

// Route::get('/coba', function () {
//     return Inertia::render('Coba');
// });

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    $pembukaanPendaftaran = env('PEMBUKAAN_PENDAFTARAN');

    // Route::get('/dashboard', function () {
    //     return view('dashboard.home');
    // })->name('dashboard');

    Route::get('/dashboard', [App\Http\Controllers\DashboardHomeController::class, 'index'])->name('dashboard');

    Route::post('/clear-payment-notification', function () {
        session()->forget('payment_notification');
        return response()->json(['status' => 'success']);
    });

    Route::get('/pengumuman', function () {
        return view('dashboard.pengumuman');
    })->name('pengumuman');

    // Peserta role
    Route::middleware('role:peserta')->prefix('lomba')->group(function () {

        Route::get('/', function () {
            return view('dashboard.lomba.index');
        })->name('lomba');

        // Infografis
        Route::prefix('infografis')->group(function () {

            // Penyisihan
            Route::get('/penyisihan', function () {
                return view('dashboard.lomba.infografis.penyisihan');
            })->middleware('infografis:penyisihan')->name('lomba.infografis.penyisihan');

            // Final
            Route::get('/final', function () {
                return view('dashboard.lomba.infografis.final');
            })->middleware('infografis:final')->name('lomba.infografis.final');
        });

        // Olimpiade
        Route::prefix('olimpiade')->group(function () {

            // Penyisihan
            Route::get('/penyisihan', function () {
                return view('dashboard.lomba.olimpiade.penyisihan');
            })->middleware('olimpiade:penyisihan')->name('lomba.olimpiade.penyisihan');

            // Semifinal
            Route::get('/semifinal', function () {
                return view('dashboard.lomba.olimpiade.semifinal');
            })->middleware('olimpiade:semifinal')->name('lomba.olimpiade.semifinal');

            // Final
            Route::get('/final', function () {
                return view('dashboard.lomba.olimpiade.final');
            })->middleware('olimpiade:final')->name('lomba.olimpiade.final');
        });

        //OSC
        Route::prefix('osc')->group(function () {
            // Penyisihan
            Route::get('/penyisihan/overview', function () {
                return view('dashboard.lomba.osc.overview');
            })->middleware(['osc:penyisihan'])->name('lomba.osc.penyisihan.overview');

            Route::get('/penyisihan/finish', function () {
                return view('dashboard.lomba.osc.finish');
            })->middleware('osc:finish')->name('lomba.osc.penyisihan.finish');

            Route::get('/penyisihan/{no}', function ($no) {
                return view('dashboard.lomba.osc.penyisihan', ['no' => $no]);
            })->middleware(['osc:penyisihan', 'ujian.selesai'])->name('lomba.osc.penyisihan');

            // Semifinal
            Route::get('/semifinal', function () {
                return view('dashboard.lomba.osc.semifinal');
            })->middleware('osc:semifinal')->name('lomba.osc.semifinal');

            // Final
            Route::get('/final', function () {
                return view('dashboard.lomba.osc.final');
            })->middleware('osc:final')->name('lomba.osc.final');
        });
    });

    // Semnas
    Route::middleware('role:peserta')->prefix('semnas')->group(function () {

        Route::get('/', function () {
            return view('dashboard.semnas.index');
        })->name('semnas');
    });

    // DN
    Route::middleware('role:peserta')->prefix('dn')->group(function () {

        Route::get('/', function () {
            return view('dashboard.dn.index');
        })->name('dn');
    });

    // Admin role
    Route::middleware('role:admin')->group(function () {
        // User management
        Route::get('/users', function () {
            return view('dashboard.users.index');
        })->name('users');

        Route::get('users/{id}', function ($id) {
            return view('dashboard.users.details', ['user' => User::findOrFail($id)]);
        })->whereNumber('id')->name('users_details');

        //Tanggal management
        Route::get('/tanggal', function () {
            return view('dashboard.tanggal.table');
        })->name('tanggal');

        // Teams Management
        Route::get('/teams', function () {
            return view('dashboard.teams.index');
        })->name('teams');

        Route::get('teams/{id}', function ($id) {
            return view('dashboard.teams.details', ['team' => Team::findOrFail($id)]);
        })->whereNumber('id')->name('teams_details');

        // Pembayaran
        Route::get('/pembayaran', function () {
            return view('dashboard.pembayaran');
        })->name('pembayaran');

        // Olimpiade
        Route::prefix('olimpiade')->group(function () {
            // Soal
            Route::middleware('role:qj')->group(function () {
                Route::get('/soal', function () {
                    return view('dashboard.olimpiade.soal');
                })->name('olimpiade.soal');
            });

            // jawaban
            Route::middleware('role:so')->group(function () {
                Route::get('/jawaban', function () {
                    return view('dashboard.olimpiade.jawaban');
                })->name('olimpiade.jawaban');
            });
        });

        // Infografis
        Route::prefix('infografis')->group(function () {
            // pengumpulan
            Route::get('/pengumpulan', function () {
                return view('dashboard.infografis.pengumpulan');
            })->name('infografis.pengumpulan');
        });

        // Osc
        // Penyisihan
        Route::prefix('osc')->group(function () {
            // Soal
            Route::middleware('role:qj')->group(function () {
                Route::get('/soal', function () {
                    return view('dashboard.osc.soal_osc');
                })->name('osc.soal_osc');
                Route::get('/soal/create', function () {
                    return view('dashboard.osc.create');
                })->name('osc.create');
                Route::get('/soal/edit/{soal_osc}', function ($soal_osc) {
                    return view('dashboard.osc.edit', ['soal_osc' => $soal_osc]);
                })->name('osc.edit');
            });

            // jawaban
            Route::get('/jawaban', function () {
                return view('dashboard.osc.jawaban_osc');
            })->name('osc.jawaban_osc');
        });
        // Semifinal
        Route::prefix('osc')->group(function () {
            Route::middleware('role:qj')->group(function () {
                // Soal
                Route::get('/soal_semifinal', function () {
                    return view('dashboard.osc.soal_semifinal_osc');
                })->name('osc.soal_semifinal_osc');
            });

            // jawaban
            Route::get('/jawaban_semifinal', function () {
                return view('dashboard.osc.jawaban_semifinal_osc');
            })->name('osc.jawaban_semifinal_osc');

            Route::get('/pernyataan', function () {
                return view('dashboard.osc.pernyataan_osc');
            })->name('osc.pernyataan_osc');

            // Pendamping final
            Route::get('/pendamping_final', function () {
                return view('dashboard.osc.pendamping_final_osc');
            })->name('osc.pendamping_final_osc');
        });
    });
});
