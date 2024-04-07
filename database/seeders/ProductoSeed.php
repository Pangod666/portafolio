<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductoSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'codigo'=>'AMI1',
            'nombre_generico'=>'',
            'nombre_comercial'=>strtoupper('AMIKACINA'),
            'concentracion'=>strtoupper('500mg'),
            'forma_farmaceutica'=>strtoupper('INYECTABLE'),
            'tipo_de_venta'=>strtoupper('PUBLICO'),
            'fecha_registro'=>'12/06/2023',
            'fecha_vencimiento'=>'12/06/2027',
            'precio_adquirido'=>5,
            'precio_venta'=>5.6550,
            'cantidad'=>12,
            'id_proveedor'=>1,
            'id_category'=>1
        ]);

        Product::create([
            'codigo'=>'ANA2',
            'nombre_generico'=>'',
            'nombre_comercial'=>strtoupper('PARACETAMOL'),
            'concentracion'=>strtoupper('100ml'),
            'forma_farmaceutica'=>strtoupper('FRASCO INFUSOR'),
            'tipo_de_venta'=>strtoupper('PUBLICO'),
            'fecha_registro'=>'12/06/2023',
            'fecha_vencimiento'=>'12/06/2027',
            'precio_adquirido'=>30,
            'precio_venta'=>36,
            'cantidad'=>6,
            'id_proveedor'=>1,
            'id_category'=>2
        ]);

        Product::create([
            'codigo'=>'ANE3',
            'nombre_generico'=>'',
            'nombre_comercial'=>strtoupper('FENTANYL'),
            'concentracion'=>strtoupper('10ML'),
            'forma_farmaceutica'=>strtoupper('INYECTABLE'),
            'tipo_de_venta'=>strtoupper('BAJO RECETA'),
            'fecha_registro'=>'12/06/2023',
            'fecha_vencimiento'=>'12/06/2027',
            'precio_adquirido'=>20,
            'precio_venta'=>22,
            'cantidad'=>12,
            'id_proveedor'=>2,
            'id_category'=>3
        ]);

        Product::create([
            'codigo'=>'ANT4',
            'nombre_generico'=>'',
            'nombre_comercial'=>strtoupper('ATROPINA'),
            'concentracion'=>strtoupper('1mg'),
            'forma_farmaceutica'=>strtoupper('INYECTABLE'),
            'tipo_de_venta'=>strtoupper('PUBLICO'),
            'fecha_registro'=>'12/06/2023',
            'fecha_vencimiento'=>'12/06/2027',
            'precio_adquirido'=>2.77,
            'precio_venta'=>4.50,
            'cantidad'=>2,
            'id_proveedor'=>2,
            'id_category'=>4
        ]);

        Product::create([
            'codigo'=>'DIU5',
            'nombre_generico'=>'',
            'nombre_comercial'=>strtoupper('EDEMIN'),
            'concentracion'=>'',
            'forma_farmaceutica'=>strtoupper('COMPRIMIDO'),
            'tipo_de_venta'=>strtoupper('BAJO RECETA'),
            'fecha_registro'=>'12/06/2023',
            'fecha_vencimiento'=>'12/06/2027',
            'precio_adquirido'=>1.44,
            'precio_venta'=>2.50,
            'cantidad'=>6,
            'id_proveedor'=>2,
            'id_category'=>5
        ]);

        Product::create([
            'codigo'=>'ELE6',
            'nombre_generico'=>'',
            'nombre_comercial'=>strtoupper('BICARBONATO DE SODIO'),
            'concentracion'=>strtoupper('20ml'),
            'forma_farmaceutica'=>strtoupper('COMPRIMIDO'),
            'tipo_de_venta'=>strtoupper('PUBLICO'),
            'fecha_registro'=>'12/06/2023',
            'fecha_vencimiento'=>'12/06/2027',
            'precio_adquirido'=>4.50,
            'precio_venta'=>5,
            'cantidad'=>15,
            'id_proveedor'=>1,
            'id_category'=>6
        ]);

        Product::create([
            'codigo'=>'ELE7',
            'nombre_generico'=>'',
            'nombre_comercial'=>strtoupper('CLORURO DE POTASIO'),
            'concentracion'=>strtoupper(''),
            'forma_farmaceutica'=>strtoupper('INYECTABLE'),
            'tipo_de_venta'=>strtoupper('PUBLICO'),
            'fecha_registro'=>'12/06/2023',
            'fecha_vencimiento'=>'12/06/2027',
            'precio_adquirido'=>4,
            'precio_venta'=>6,
            'cantidad'=>3,
            'id_proveedor'=>2,
            'id_category'=>6
        ]);
    }
}
