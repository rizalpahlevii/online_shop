<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store_courier extends Model
{
    protected $fillable = ['store_id', 'courier_id', 'status'];
    public function store()
    {
        return $this->hasOne(Store::class, 'id', 'store_id');
    }
    public function courier()
    {
        return $this->hasOne(Courier::class, 'id', 'courier_id');
    }
}
