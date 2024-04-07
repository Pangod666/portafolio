<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable =[
        'id',
        'codigo',
        'nombre_generico',
        'nombre_comercial',
        'tipo_de_venta',
        'concentracion',
        'cantidad',
        'nivel_reorden',
        'forma_farmaceutica',
        'fecha_registro',
        'fecha_vencimiento',
        'precio_adquirido',
        'precio_venta',
        'refrigerado',
        'id_proveedor',
        'id_category'
    ];

    public function categoria(){
        return $this->belongsTo(Category::class, 'id_category','id');
    }

    public function ordenes(){
        return $this->belongsToMany(Order::class, 'orderProducts');
    }

    public function proveedor(){
        return $this->belongsTo(Provider::class, 'id_proveedor', 'id');
    }

    public $timestamps = false;

}
