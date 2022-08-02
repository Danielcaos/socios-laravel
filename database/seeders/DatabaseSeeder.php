<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'admin']);
        // Se crea el usuario con los datos del registro
        $user = User::create([
            'name' => "gabriel",
            "email" => "gabriel@gmail.com",
            'documento' => 1004804515,
            'password' => Hash::make(12345)
        ]);

        // Le asignamos el rol de Cliente
        $user->assignRole('admin');
        // \App\Models\User::factory(10)->create();
    }
}
