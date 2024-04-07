<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Tutor extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'id_people',
        'parentesco',
    ];

    public $timestamps = false;

    public function Person():HasOne
    {
        return $this->hasOne(Person::class, 'id','id_people');
    }
}
