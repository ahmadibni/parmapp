<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontPageController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::with('category')->orderBy('id', 'desc')->take(4)->get();

        return view('front.index', [
            'categories' => $categories,
            'products' => $products,
        ]);
    }

    public function details(Product $product)
    {
        return view('front.details', [
            'product' => $product
        ]);
    }

    public function category(Category $category)
    {
        $products = $category->products()->with('category')->get();
        return view('front.category', [
            'products' => $products,
            'category' => $category
        ]);
    }

    public function search(Request $request)
    {
        $productName = $request->input('keyword');
        $products = Product::where('name', 'LIKE', '%' . $productName . '%')->get();
        return view('front.search', [
            'products' => $products
        ]);
    }
}
