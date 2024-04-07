<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Especialidad extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nombre',
        'descripcion'
    ];

    public $timestamps = false;

    public function pacientes(){
        return $this->hasMany(Patient::class, 'id_especialidad','id');
    }
    
}
