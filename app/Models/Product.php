<?php

namespace App\Models;

use App\Models\BaseModel as Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'price', 'multipleIngredients'];

    protected $casts = [
        'multiple_ingredients' => 'boolean',
    ];

    public function ingredients()
    {
        return $this->hasMany(Ingredient::class);
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class)->withPivot(['price']);
    }
}
