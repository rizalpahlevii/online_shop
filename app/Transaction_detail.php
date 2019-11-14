<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction_detail extends Model
{
    public function product()
    {
        return $this->hasOne(Product::class, 'id');
    }
}
