<?php

namespace App\Models;

use App\Models\BaseModel as Model;
use App\Models\Product;
use App\Models\Size;
use App\Models\Ingredient;

class Order extends Model
{
    protected $fillable = ['quantity'];
    protected $appends = ['unitPrice', 'price'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class);
    }

    public function getUnitPriceAttribute()
    {
        $price = 0;

        if (isset($this->product->price)) {
            $price += $this->product->price;
        }

        if (isset($this->size->price)) {
            $price += $this->size->price;
        }

        if (isset($this->ingredients)) {
            foreach ($this->ingredients as $ingredient) {
                $price += $ingredient->price;
            }
        }

        return $price;
    }

    public function getPriceAttribute()
    {
        return $this->unitPrice * $this->quantity;
    }
}
