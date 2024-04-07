<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Person;
class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Person::create([
            'ci' => '0000000',
            'nombre' => 'David',
            'ap_paterno' => 'quisbert',
            'ap_materno' => 'quisbert',
            'fechanacimiento' => '1997-12-12',
            'celular'=> '00000000',
            'direccion' => 'Av. Admin',
            'correo'=> 'HomeroSimpson@gmail.com'
        ]);

        Person::create([
            'ci' => '0000001',
            'nombre' => 'Adirana',
            'ap_paterno' => 'romero',
            'ap_materno' => 'Tomas',
            'fechanacimiento' => '1997-12-12',
            'celular'=> '00000001',
            'direccion' => 'Av. los olivos',
            'correo'=> 'TimmyJefferson@gmail.com'
        ]);


        Person::create([
            'ci' => '0000003',
            'nombre' => 'Juana',
            'ap_paterno' => 'De Arco',
            'ap_materno' => 'Quintana',
            'fechanacimiento' => '1997-12-12',
            'celular'=> '00000001',
            'direccion' => 'Av. Jef',
            'correo'=> 'JuanaDeArco@gmail.com'
        ]);


        Person::create([
            'ci' => '0000004',
            'nombre' => 'Pedro',
            'ap_paterno' => 'Fernandez',
            'ap_materno' => 'Torrico',
            'fechanacimiento' => '1997-12-12',
            'celular'=> '00000001',
            'direccion' => 'Av. Jef',
            'correo'=> 'PedroTorrico@gmail.com'
        ]);


        Person::create([
            'ci' => '0000005',
            'nombre' => 'Lisa',
            'ap_paterno' => 'Simpson',
            'ap_materno' => 'Bouvier',
            'fechanacimiento' => '1997-12-12',
            'celular'=> '00000001',
            'direccion' => 'Av. Jef',
            'correo'=> 'LisaSimpson@gmail.com'
        ]);


        Person::create([
            'ci' => '0000006',
            'nombre' => 'Connor',
            'ap_paterno' => 'McGregor',
            'ap_materno' => 'Mamani',
            'fechanacimiento' => '1997-12-12',
            'celular'=> '00000001',
            'direccion' => 'Av. Jef',
            'correo'=> 'ConnorMcGregor@gmail.com'
        ]);


        Person::create([
            'ci' => '0000007',
            'nombre' => 'Ben',
            'ap_paterno' => 'Afleck',
            'ap_materno' => 'Garcia',
            'fechanacimiento' => '1997-12-12',
            'celular'=> '00000001',
            'direccion' => 'Av. Jef',
            'correo'=> 'BenAfleck@gmail.com'
        ]);
    }
}
