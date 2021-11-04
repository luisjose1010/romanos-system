<?php

namespace App\Models;

use App\Models\BaseModel as Model;
use App\Models\Order;

class Sale extends Model
{
    protected $fillable = ['ivaRate'];
    protected $appends = ['totalPrice'];

    protected $casts = [
        'paid' => 'boolean',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function getTotalPriceAttribute()
    {
        $price = 0;

        foreach ($this->orders as $order) {
            $price += $order->price;
        }
        return $price;
    }
}
