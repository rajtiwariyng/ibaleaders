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
        // Create roles
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'superadmin']);
        Role::firstOrCreate(['name' => 'user']);
        Role::firstOrCreate(['name' => 'Data Entry Operator']);
        Role::firstOrCreate(['name' => 'Customer Support Teams']);
    }
}
