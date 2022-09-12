<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'nombres' => 'admin',
            'apellidos' => 'admin',
            'email' => 'admin@admin.com',
            'tipo_identificacion'=>'cedula',
            'numero_identificacion'=>'123456789',
            'email_verified_at' => now(),
            'password' => Hash::make('Sist1234'), // password
            'remember_token' => Str::random(10),
            'tipo_usuario' => 'Usuario Interno'

        ]);
        $user->assignRole('Super Admin');

    }
}
