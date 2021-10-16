<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function ingredients()
    {
        return $this->hasMany(Ingredient::class);
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class)->withPivot(['price']);
    }
}
