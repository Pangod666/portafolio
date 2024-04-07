<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Patient extends Model
{
    use HasFactory;

    protected $fillable=[
        'id',
        'id_people',
        'estado',
        'id_tutor',
        'id_especialidad'
    ];

    public function Person():HasOne
    {
        return $this->hasOne(Person::class, 'id','id_people');
    }

    public function especialidad():HasOne{
        return $this->hasOne(Especialidad::class, 'id','id_especialidad');
    }

    public function tutor(){
        return $this->belongsTo(Tutor::class, 'id_tutor','id');
    }

    public $timestamps = false;

}
