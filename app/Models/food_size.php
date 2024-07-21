<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class food_size extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'food_id', 'price'];

    protected $translatable = ['name'];
}
