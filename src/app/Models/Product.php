<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'content',
        'price',
        'slug',
        'image'
    ];

    public function coupons(){
        return $this->belongsToMany(Coupon::class);
    }

    public function getDiscountPrice(float $discountSize):float
    {
        return $this->price * (1-$discountSize);
    }
}
