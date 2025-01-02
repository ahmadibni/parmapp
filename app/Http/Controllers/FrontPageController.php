<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontPageController extends Controller
{
    public function index(){
        $categories = Category::all();
        $products = Product::with('category')->orderBy('id', 'desc')->take(4)->get();
        $user = Auth::user();

        return view('front.index', [
            'categories' => $categories,
            'products' => $products,
            'user' => $user
        ]);
    }

    public function details(Product $product){
        return view('front.details', [
            'product' => $product
        ]);
    }
}
