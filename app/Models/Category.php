<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable =[
        'id',
        'nombre',
        'descripcion',
        'estado'
    ];

    public function productos(){
        return $this->hasMany(Product::class,'id_category','id');
    }

    public $timestamps = false;
}
