<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store_courier extends Model
{
    protected $fillable = ['store_id', 'courier_id', 'status'];
}
