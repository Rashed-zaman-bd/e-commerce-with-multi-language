<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'brand_id',
        'category_name'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
