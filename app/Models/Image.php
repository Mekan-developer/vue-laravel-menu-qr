<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'food_id'
    ];
    public $timestamps = false;

}
