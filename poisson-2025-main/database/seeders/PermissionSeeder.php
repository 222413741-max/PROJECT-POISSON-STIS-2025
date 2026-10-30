<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['guard_name' => 'teams','name' => 'olimpiade_penyisihan_peserta']);
        Permission::create(['guard_name' => 'teams','name' => 'olimpiade_penyisihan_lolos']);
        Permission::create(['guard_name' => 'teams','name' => 'olimpiade_semifinal_peserta']);
        Permission::create(['guard_name' => 'teams','name' => 'olimpiade_semifinal_lolos']);
        Permission::create(['guard_name' => 'teams','name' => 'olimpiade_final_peserta']);
        Permission::create(['guard_name' => 'teams','name' => 'infografis_penyisihan_peserta']);
        Permission::create(['guard_name' => 'teams','name' => 'infografis_penyisihan_lolos']);
        Permission::create(['guard_name' => 'teams','name' => 'infografis_final_peserta']);
        Permission::create(['guard_name' => 'teams','name' => 'osc_penyisihan_peserta']);
        Permission::create(['guard_name' => 'teams','name' => 'osc_penyisihan_lolos']);
        Permission::create(['guard_name' => 'teams','name' => 'osc_semifinal_peserta']);
        Permission::create(['guard_name' => 'teams','name' => 'osc_semifinal_lolos']);
        Permission::create(['guard_name' => 'teams','name' => 'osc_final_peserta']);
        Permission::create(['guard_name' => 'teams','name' => 'fail']);
    }
}
