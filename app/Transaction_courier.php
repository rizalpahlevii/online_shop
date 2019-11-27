<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction_courier extends Model
{
    protected $fillable = ['transaction_id','courier','description','etd','value'];
}
