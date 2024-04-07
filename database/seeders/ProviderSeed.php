<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Provider;

class ProviderSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Provider::create([
            'nit' => '00001',
            'nombre'=> 'INTI',
            'direccion' => 'Av. Llojeta',
            'telefono'=> '2222222',
            'email'=> 'inti.far@inti.com'
        ]);

        Provider::create([
            'nit' => '00002',
            'nombre'=> 'ASTRASANEKA',
            'direccion' => 'Av. 6 de Marzo',
            'telefono'=> '3333333',
            'email'=> 'deltafar@delta.com'
        ]);
    }
}
