<?php

namespace App\Models;

use App\Models\BaseModel as Model;
use App\Models\Role;

class User extends Model
{
    protected $fillable = ['username', 'name', 'email', 'idCard'];
    protected $hidden = ['password'];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
