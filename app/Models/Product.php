<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Product extends Model
{
    protected $fillable = [
        'user_id',
        'brand_id',
        'category_id',
        'name',
        'slug',
        'price',
        'previous_price',
        'discount_percent',
        'trending',
        'free_delivery',
        'emi',
        'exchange',
        'weight',
        'unit',
        'stock',
        'image',
        'description'
    ];

    protected static function booted()
    {
        static::creating(function ($product){
            if(empty ($product->slug)){
                $baseSlug = Str::slug($product->name);
                $slug = $baseSlug;
                $counter = 1;

                while(static::where('slug', $slug)->exists()){
                    $slug = $baseSlug . '-' . $counter;
                    $counter++;
                }
                $product -> slug = $slug;
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
