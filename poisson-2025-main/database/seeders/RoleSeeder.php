<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            "name" => "users"
        ]);
        Role::create([
            "name" => "admin"
        ]);
        Role::create([
            "name" => "qj"
        ]);
        Role::create([
            "name" => "si"
        ]);
        Role::create([
            "name" => "so"
        ]);
        Role::create([
            "name" => "osc"
        ]);
        Role::create([
            "name" => "peserta"
        ]);
    }
}
