<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterPatient extends Model
{
    use HasFactory;

    protected $fillable =[
        'id',
        'id_user',
        'id_patient',
        'id_especialidad',
        'action',
        'fecha'
    ];

    public function usuario(){
        return $this->hasOne(User::class,'id','id_user');
    }

    public function especialidad(){
        return $this->hasOne(Especialidad::class,'id','id_especialidad');
    }
}
