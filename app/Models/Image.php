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

    public function getImage()
    {

        if (file_exists(public_path('/storage/web_images/foods/' . $this->image)) && !is_null($this->image)) {

            return asset('/storage/web_images/foods/' . $this->image);
        }
        return null;
    }

}
