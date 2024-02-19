<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;

class CatalogController extends Controller
{
    public function index() {
        $roots = Models\Category::where('parent_id', 0)->get();
        $goods = Models\Product::all();
        return view('catalog.index', compact('roots','goods'));
    }

    public function category($name) {
        $category = Models\Category::where('name', $name)->firstOrFail();
        $products = Models\Product::where('category_id', $category->id)->get();
        return view('catalog.category', compact('category', 'products'));
    }

    public function brand($name) {
        $brand = Models\Brand::where('name', $name)->firstOrFail();
        $products = Models\Product::where('brand_id', $brand->id)->get();
        return view('catalog.brand', compact('brand', 'products'));
    }

    public function product($name) {
        $product = Models\Product::select(
            'products.*',
            'categories.name as category_name',
            'brands.name as brand_name',
        )
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->where('products.name', $name)
            ->firstOrFail();
        return view('catalog.product', compact('product'));
    }

    //TODO Вынести в отдельный контроллер
    public function deleteProduct($id)
    {
        $product = Models\Product::find($id);
        if ($product) {
            $product->delete();
            return redirect()->back()->with('success', 'Продукт успешно удален');
        } else {
            return redirect()->back()->with('error', 'Продукт не найден');
        }
    }
}
