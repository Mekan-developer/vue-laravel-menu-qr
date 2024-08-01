<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasFactory, HasTranslations; 

    protected $fillable = ['name', 'image', 'parent_id', 'is_active', 'order'];
    protected $casts = [
        'is_active' => 'boolean',
    ];

    public $translatable = ['name'];

    public function children()
    {
        return $this->hasMany(Category::class,'parent_id','id');
    }
    public function foods()
    {
        return $this->hasMany(Food::class,'category_id','id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class,'parent_id','id');
    }

    public function getImage()
    {

        if (file_exists(public_path('/storage/web_images/categories/' . $this->image)) && !is_null($this->image)) {

            return asset('/storage/web_images/categories/' . $this->image);
        }
        return null;
    }



}
