<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;

class CouponController extends Controller
{
    public function apply(Request $request)
    {
        $coupon = Coupon::where('code', $request->coupon)->first();

        if (!$coupon) {
            return redirect()->route('index')->withErrors('Такого купона не существует');
        }


        $request->session()->put('coupon', [
            'code' => $coupon->code,
            #'discount' => $coupon->discount
        ]);

        return redirect()->route('index')->with('success_message', 'Купон применён');
    }
}
