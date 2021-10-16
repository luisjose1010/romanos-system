<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $hidden = ['pivot'];
    protected $appends = ['price'];

    public function getPriceAttribute()
    {
        return $this->pivot->price;
    }
}
