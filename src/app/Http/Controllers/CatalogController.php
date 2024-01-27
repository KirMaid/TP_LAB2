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

    public function category($slug) {
        $category = Models\Category::where('slug', $slug)->firstOrFail();
        $products = Models\Product::where('category_id', $category->id)->get();
        return view('catalog.category', compact('category', 'products'));
    }

    public function brand($slug) {
        $brand = Models\Brand::where('slug', $slug)->firstOrFail();
        $products = Models\Product::where('brand_id', $brand->id)->get();
        return view('catalog.brand', compact('brand', 'products'));
    }

    public function product($slug) {
        $product = Models\Product::select(
            'products.*',
            'categories.name as category_name',
            'categories.slug as category_slug',
            'brands.name as brand_name',
            'brands.slug as brand_slug'
        )
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->where('products.slug', $slug)
            ->firstOrFail();
        return view('catalog.product', compact('product'));
    }
}
