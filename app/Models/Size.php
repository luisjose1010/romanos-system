<?php

namespace App\Models;

use App\Models\BaseModel as Model;

class Size extends Model
{
    protected $hidden = ['pivot'];
    protected $appends = ['price'];

    public function getPriceAttribute()
    {
        return $this->pivot->price;
    }
}