<?php

namespace App\Models;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Permission;

class User extends Authenticatable
{
    use HasRoles,HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'id',
        'id_people',
        'name',
        'email',
        'username',
        'password',
        'estado',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Person():HasOne
    {
        return $this->hasOne(Person::class, 'id','id_people');
    }
    
}


