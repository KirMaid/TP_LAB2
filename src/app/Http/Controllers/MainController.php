<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;

class MainController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $authUser = auth()->user();
        $isBirthday = $authUser && $authUser->isBirthday();
        $products = Models\Product::whereDoesntHave('coupons')->get();
        if ($isBirthday){
            $products = $products->map(function ($product) {
                $product->oldPrice = $product->price;
                $product->price = $product->getDiscountPrice(0.1);
                return $product;
            });
        }
        return view('main',compact('products','isBirthday'));
    }

    public function applyCoupon(){
    }
}
