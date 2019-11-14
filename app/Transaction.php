<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
    public function member()
    {
        return $this->belongsTo(User::class, 'member_id');
    }
    public function courier()
    {
        return $this->belongsTo(Courier::class, 'courier_id');
    }
    public function invoice()
    {
        return $this->hasOne(Invoice::class, 'transaction_id', 'id');
    }
    public function transactionAddress()
    {
        return $this->hasOne(Transaction_address::class, 'transaction_id', 'id');
    }
    public function transactionDetail()
    {
        return $this->hasMany(Transaction_detail::class, 'transaction_id', 'id');
    }
}
