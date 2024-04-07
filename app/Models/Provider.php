<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    protected $fillable =[
        'id',
        'nit',
        'encargado',
        'nombre',
        'direccion',
        'telefono',
        'email',
        'estado'
    ];
    
    public $timestamps = false;

    public function productos(){
        return $this->hasMany(Product::class, 'id_proveedor','id');
    }
}
