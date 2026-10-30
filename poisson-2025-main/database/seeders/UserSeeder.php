<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // BPH
        $user = User::create([
            'name' => 'Badan Pengurus Harian 1',
            'email' => 'bph1@poisson.stis',
            'password' => Hash::make('bph1poi2025'),
            'email_verified_at' => now(),
        ]);
        $user->assignRole('admin');
        $user->assignRole('qj');
        $user->assignRole('so');
        $user->assignRole('si');
        $user->assignRole('osc');

        $user = User::create([
            'name' => 'Badan Pengurus Harian 2',
            'email' => 'bph2@poisson.stis',
            'password' => Hash::make('bph2poi2025'),
            'email_verified_at' => now(),
        ]);
        $user->assignRole('admin');

        $user = User::create([
            'name' => 'Badan Pengurus Harian 3',
            'email' => 'bph3@poisson.stis',
            'password' => Hash::make('bph3poi2025'),
            'email_verified_at' => now(),
        ]);
        $user->assignRole('admin');

        // DIV - QJ
        $user = User::create([
            'name' => 'Divisi QJ',
            'email' => 'qj@poisson.stis',
            'password' => Hash::make('qjpoi2025'),
            'email_verified_at' => now(),
        ]);
        $user->assignRole('admin');
        $user->assignRole('qj');

        // DIV - INFOGRAFIS
        $user = User::create([
            'name' => 'Divisi Statistical Infographic',
            'email' => 'si@poisson.stis',
            'password' => Hash::make('sipoi2025'),
            'email_verified_at' => now(),
        ]);
        $user->assignRole('admin');
        $user->assignRole('si');

        // DIV - OLIMPIADE
        $user = User::create([
            'name' => 'Divisi Statistics Olympiad',
            'email' => 'so@poisson.stis',
            'password' => Hash::make('sopoi2025'),
            'email_verified_at' => now(),
        ]);
        $user->assignRole('admin');
        $user->assignRole('so');

        // DIV - OSC
        $user = User::create([
            'name' => 'Divisi Official Statistics Challenge',
            'email' => 'osc@poisson.stis',
            'password' => Hash::make('oscpoi2025'),
            'email_verified_at' => now(),
        ]);
        $user->assignRole('admin');
        $user->assignRole('osc');

        // DIV - TI
        $user = User::create([
            'name' => 'Divisi TI',
            'email' => 'ti@poisson.stis',
            'password' => Hash::make('tipoi2025'),
            'email_verified_at' => now(),
        ]);
        $user->assignRole('admin');
        $user->assignRole('qj');
        $user->assignRole('si');
        $user->assignRole('so');
        $user->assignRole('osc');

    }
}
