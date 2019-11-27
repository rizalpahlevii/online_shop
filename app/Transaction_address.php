<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction_address extends Model
{
    protected $fillable = ['transaction_id','province_code','province_name','city_code','city_name','detail','note'];
}
