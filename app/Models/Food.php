<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $table = 'foods';

    protected $fillable = [
        'name',
        'description',
        'category_id',
        'discount',
        'discount_unit',
        'order',
        'is_active'
    ];
    public $translatable = ['name'];


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function images()
    {
        return $this->hasMany(image::class, 'id', 'food_id');
    }
    public function sizes()
    {
        return $this->hasMany(FoodSize::class, 'id', 'food_id');
    }

    public function getImage()
    {
        if (file_exists(public_path('/storage/web_images/foods/' . $this->image)) && !is_null($this->image)) {
            return asset('/storage/web_images/foods/' . $this->image);
        }
        return null;
    }
}
