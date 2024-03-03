<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\GigachatService;
use Illuminate\Http\Request;
use MessageLogger;

class ProductController extends Controller
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
        $gigachat = GigachatService::getInstance();
        $logger = new MessageLogger();
        $gigachat->attach($logger);
        $description = $gigachat->sendMessage("Сгенерируй описание для товара c названием {$request->input('name')} 20 слов");
        return response()->json(['description' => $description]);
    }

    public function updateProduct(Request $request, $id){
        // Валидация данных из формы
        $request->validate([
            'name' => 'required',
            'content' => 'required',
            'price' => 'required|numeric',
            'image' => 'required'
        ]);

        // Найти товар по ID
        $product = Product::findOrFail($id);

        // Обновить данные товара
        $product->update([
            'name' => $request->name,
            'content' => $request->content,
            'price' => $request->price,
            'image' => $request->image,
        ]);

        // Перенаправить пользователя обратно с сообщением об успехе
        return redirect()->route('product.update.index',$product->id)->with('success', 'Товар успешно обновлен');
    }

    public function update($id){
        $product = Product::findOrFail($id);
        return view('product.update',compact('product'));
    }
}
