<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class foodSize extends Model
{
    use HasFactory;
    protected $table = 'food_sizes';

    protected $fillable = ['name', 'food_id', 'price'];

    public $timestamps = false;

    public function getDiscountPrice()
    {
        $discount = $this->food->discount;

        if ($discount) {
            if ($this->food->discount_unit == 'percent') {
                return $this->price - (($discount * $this->price) / 100);
            }

            return $this->price - ($discount * 100);
        }
    }


}
