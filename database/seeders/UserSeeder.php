<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'id_people'=>'1',
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'username'=>'admin',
            'password'=> '$2y$10$7pkgXMEo87gRUTFpiawIUuiavqUy90Sbm1Vd54Bl0R7W2F3YWockO',
            'estado'=>'activo'
        ])->assignRole('admin');

        User::create([
            'id_people'=>'2',
            'name' => 'jefa enfermeras',
            'email' => 'jef@ajef.com',
            'username'=>'jef',
            'password'=> '$2y$10$7pkgXMEo87gRUTFpiawIUuiavqUy90Sbm1Vd54Bl0R7W2F3YWockO',
            'estado'=>'activo'
        ])->assignRole('Jefe de Enfermeria');
    }
}
