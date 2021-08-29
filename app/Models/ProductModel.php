<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    protected $table = 'product';

    public function ingredients()
    {
        return $this->hasMany(IngredientModel::class, "{$this->table}_id");
    }

    public function sizes()
    {
        return $this->hasMany(SizeModel::class, "{$this->table}_id");
    }
}
