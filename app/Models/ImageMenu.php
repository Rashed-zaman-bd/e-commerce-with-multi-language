<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageMenu extends Model
{

   protected $table = 'image_menus';

    protected $fillable = [
        'title_en',
        'title_bn',
        'image'
    ];

    // Accessor: automatically returns correct language title
    public function getTitleAttribute(): string
    {
        $locale = app()->getLocale();
        return $this->{"title_{$locale}"} ?: $this->title_bn;
    }
}
