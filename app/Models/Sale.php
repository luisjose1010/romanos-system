<?php

namespace App\Models;

use App\Models\BaseModel as Model;
use App\Models\Order;
use App\Models\Client;

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

    public function client()
    {
        return $this->belongsTo(Client::class);
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
