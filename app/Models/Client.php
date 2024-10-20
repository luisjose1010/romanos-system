<?php

namespace App\Models;

use App\Models\BaseModel as Model;

class Client extends Model
{
    protected $fillable = ['name', 'idCard', 'phoneNumber', 'email'];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
