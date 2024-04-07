<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class Model_has_roles extends Model
{
    use HasFactory;

    protected $fillable =[
        'role_id',
        'model_type',
        'model_id',
    ];

    public $timestamps = false;

    public function User():HasOne{
        return $this->hasOne(User::class, 'id','model_id');
    }

    public function Role():HasOne{
        return $this->hasOne(Role::class, 'id','role_id');
    }
}
