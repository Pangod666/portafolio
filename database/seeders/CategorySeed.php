<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'nombre'=>'AMINOGLUCOSIDOS',
            'descripcion'=>'PRODUCTOS AMINOGLUCOSIDOS'
        ]);

        Category::create([
            'nombre'=>'ANALGESICOS',
            'descripcion'=>'PRODUCTOS ANALGESICOS'
        ]);

        Category::create([
            'nombre'=>'ANTIESPASMODICOS',
            'descripcion'=>'PRODUCTOS ANTIESPASMODICOS'
        ]);

        Category::create([
            'nombre'=>'ELECTROTERAPIAS',
            'descripcion'=>'PRODUCTOS ELECTROTERAPIAS'
        ]);

        Category::create([
            'nombre'=>'ENERGETICOS',
            'descripcion'=>'PRODUCTOS ENERGETICOS'
        ]);

        Category::create([
            'nombre'=>'INSUMOS VARIOS',
            'descripcion'=>'PRODUCTOS DE INSUMOS VARIADOS'
        ]);

        Category::create([
            'nombre'=>'INSUMOS EQUIPOS',
            'descripcion'=>'PRODUCTOS DE INSUMOS MEDICOS'
        ]);
    }
}
