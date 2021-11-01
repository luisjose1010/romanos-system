<?php

namespace App\Models;

use App\Models\BaseModel as Model;
use App\Models\Order;

class Sale extends Model
{
    protected $fillable = ['ivaRate'];

    protected $casts = [
        'paid' => 'boolean',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
