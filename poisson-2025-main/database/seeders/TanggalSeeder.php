<?php

namespace Database\Seeders;

use App\Models\Tanggal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TanggalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tanggal::create([
            'kegiatan' => 'Pembukaan Pendaftaran Lomba Infografis',
            'time' => '2025-09-02 00:00:01'
        ]);

        Tanggal::create([
            'kegiatan' => 'Penutupan Pendaftaran Lomba Infografis',
            'time' => '2025-09-30 23:59:59'
        ]);

        Tanggal::create([
            'kegiatan' => 'Pembukaan Pendaftaran Lomba Olimpiade',
            'time' => '2025-09-02 00:00:01'
        ]); 

        Tanggal::create([
            'kegiatan' => 'Penutupan Pendaftaran Lomba Olimpiade',
            'time' => '2025-09-30 23:59:59'
        ]);

        Tanggal::create([
            'kegiatan' => 'Pembukaan Pendaftaran Lomba OSC',
            'time' => '2025-09-02 00:00:01'
        ]);

        Tanggal::create([
            'kegiatan' => 'Penutupan Pendaftaran Lomba OSC',
            'time' => '2025-09-30 23:59:59'
        ]);

        Tanggal::create([
            'kegiatan' => 'Penyisihan Infografis Mulai',
            'time' => '2025-09-02 00:00:01'
        ]);

        Tanggal::create([
            'kegiatan' => 'Penyisihan Infografis Berakhir',
            'time' => '2025-10-03 23:59:59'
        ]);

        Tanggal::create([
            'kegiatan' => 'Final Infografis Mulai',
            'time' => '2025-11-16 00:00:01'
        ]);

        Tanggal::create([
            'kegiatan' => 'Final Infografis Berakhir',
            'time' => '2025-11-16 18:00:00'
        ]);

        Tanggal::create([
            'kegiatan' => 'Penyisihan Olimpiade Mulai',
            'time' => '2025-10-10 10:00:00'
        ]);

        Tanggal::create([
            'kegiatan' => 'Penyisihan Olimpiade Berakhir',
            'time' => '2025-10-10 14:00:00'
        ]);

        Tanggal::create([
            'kegiatan' => 'Semifinal Olimpiade Mulai',
            'time' => '2025-11-01 10:00:00'
        ]);

        Tanggal::create([
            'kegiatan' => 'Semifinal Olimpiade Berakhir',
            'time' => '2025-11-08 23:59:59'
        ]);

        Tanggal::create([
            'kegiatan' => 'Final Olimpiade Mulai',
            'time' => '2025-11-28 11:00:00'
        ]);

        Tanggal::create([
            'kegiatan' => 'Final Olimpiade Berakhir',
            'time' => '2025-11-28 23:59:59'
        ]);

        Tanggal::create([
            'kegiatan' => 'Penyisihan OSC Mulai',
            'time' => '2025-10-11 10:20:00'
        ]);

        Tanggal::create([
            'kegiatan' => 'Penyisihan OSC Berakhir',
            'time' => '2025-10-15 10:45:00'
        ]);

        Tanggal::create([
            'kegiatan' => 'Semifinal OSC Mulai',
            'time' => '2025-11-02 07:30:00'
        ]);

        Tanggal::create([
            'kegiatan' => 'Semifinal OSC Berakhir',
            'time' => '2025-11-02 11:00:00'
        ]);

        Tanggal::create([
            'kegiatan' => 'Final OSC Mulai',
            'time' => '2025-11-28 07:00:00'
        ]);

        Tanggal::create([
            'kegiatan' => 'Final OSC Berakhir',
            'time' => '2025-11-28 16:00:00'
        ]);
    }
}
