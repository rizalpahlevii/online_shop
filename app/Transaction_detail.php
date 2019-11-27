<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction_detail extends Model
{
    protected $fillable = ['transaction_id','product_id','price','quantity','total'];
    public function product()
    {
        return $this->hasOne(Product::class, 'id');
    }
}
