<?php

namespace App\Models;

use App\Models\BaseModel as Model;
use App\Models\Product;
use App\Models\Size;
use App\Models\Ingredient;

class Order extends Model
{
    protected $fillable = ['quantity'];

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
}
