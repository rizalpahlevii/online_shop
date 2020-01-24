<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
    use Sluggable;
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    public function category()
    {
        return $this->belongsTo(Product_category::class, 'product_category_id');
    }
    public function transaction_detail()
    {
        return $this->hasMany(Transaction_detail::class, 'product_id');
    }
}
