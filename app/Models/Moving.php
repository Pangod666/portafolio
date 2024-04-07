<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moving extends Model
{
    use HasFactory;

    protected $fillable=[
        'id',
        'id_user',
        'id_product',
        'quantity',
        'moving',
        'fecha'
    ];

    public function producto(){
        return $this->belongsTo(Product::class, 'id_product','id');
    }

    public function usuario(){
        return $this->hasOne(User::class,'id','id_user');
    }
}
