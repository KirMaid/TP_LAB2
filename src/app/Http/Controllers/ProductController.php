<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\GigachatService;
use Illuminate\Http\Request;

class ProductController
{
    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        $product = new Product($request->all());
        $product->save();
        return redirect()->route('product.index');
    }

    public function generateDesc(Request $request)
    {
        $gigachat = new GigachatService();
        $description = $gigachat->sendMessage('Сгенерируй описание для товара 20 слов');
        return response()->json(['description' => $description]);
    }
}
