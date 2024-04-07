<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $fillable =[
        'id',
        'ci',
        'extension',
        'nombre',
        'ap_paterno',
        'ap_materno',
        'fechanacimiento',
        'genero',
        'celular',
        'direccion',
        'ocupacion',
        'estado_civil',
        'correo',
        'nit',
        'telefono_emergencia'
    ];

    public function existPaterno(){
        return !is_null($this->ap_paterno);
    }

    public function generateUser(){
        if ($this->existPaterno()) {
            $username = $this->nombre[0] . $this->ap_paterno[0] . $this->ap_materno[0] . $this->ci;
            return $username;
        }else{
            $username = $this->nombre[0] . $this->ap_materno[0] . $this->ap_materno[1] . $this->ci;
            return $username;
        }
    }
}
