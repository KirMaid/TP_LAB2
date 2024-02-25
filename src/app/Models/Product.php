<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'content',
        'price',
        'image'
    ];

    public function coupons(){
        return $this->belongsToMany(Coupon::class);
    }

    public function getDiscountPrice(float $discountSize):float
    {
        return $this->price * (1-$discountSize);
    }

    public function delete()
    {
        //TODO Переделать
        DB::table('coupon_product')->where('product_id',  $this->id)->delete();
        return parent::delete();
    }
}
