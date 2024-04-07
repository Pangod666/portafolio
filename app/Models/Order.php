<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    protected $fillable=[
        'id',
        'id_paciente',
        'id_user',
        'fecha'
    ];

    public $timestamps = false;

    public function productos(){
        return $this->belongsToMany(Product::class, 'orderProducts')->withPivot('cantidad');
    }

    public function usuario(){
        return $this->hasOne(User::class,'id','id_user');
    }

    public function paciente():HasOne
    {
        return $this->hasOne(Patient::class, 'id','id_paciente');
    }
}
