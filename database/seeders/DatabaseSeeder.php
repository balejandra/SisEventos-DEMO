<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            seederPermissions::class,
            seederRoles::class,
            RoleHasPermissionSeeder::class,
            AdminUserSeeder::class,
            UserExtSeeder::class,
            MenuUserSeeder::class,
            EquiposSeeder::class,
        ]);
    }
}
