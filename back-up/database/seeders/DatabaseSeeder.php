<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /*$superadmin = User::factory()->create([
        'name' => 'Superadmin',
        'email' => 'superadmin@ibaleaders.com',
        'password' => bcrypt('password'),
        ]);*/

        // Create Admin user
        /*$admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@ibaleaders.com',
            'password' => bcrypt('password'),
        ]);*/

        $frontendUser = User::create([
            'name' => 'Frontend User',
            'email' => 'user2@ibaleaders.com',
            'password' => bcrypt('password'),
        ]);

        // Create roles
        //$superadmin_role = Role::create(['name' => 'superadmin']);
        //$admin_role = Role::create(['name' => 'admin']);
        $user_role = Role::firstOrCreate(['name' => 'user']);

        // Assign roles to users
        //$superadmin->assignRole($superadmin_role);
        //$admin->assignRole($admin_role);
        $frontendUser->assignRole($user_role);
        
        User::factory(10)->create()->each(function ($user) use ($user_role) {
            $user->assignRole($user_role);
        });

        }
}
