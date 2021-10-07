<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    protected $table = 'product';

    protected $fillable = ['name', 'multiple_ingredients'];

    public function ingredient()
    {
        return $this->hasMany(IngredientModel::class, "{$this->table}_id");
    }

    public function size()
    {
        return $this->hasMany(SizeModel::class, "{$this->table}_id");
    }
}
