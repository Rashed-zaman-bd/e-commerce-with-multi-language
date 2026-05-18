<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    protected $table = 'hero_images';

    protected $fillable = [
        'link',
        'image_dec',
        'image_mobile'
    ];


}
