<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Especialidad;

class EspecialidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Especialidad::create([
            'nombre'=>'Cuidados Intensivos',
            'descripcion'=>''
        ]);

        Especialidad::create([
            'nombre'=>'Emergencias',
            'descripcion'=>''
        ]);

        Especialidad::create([
            'nombre'=>'Neurologia',
            'descripcion'=>''
        ]);
    }
}
