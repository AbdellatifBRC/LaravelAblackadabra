<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Utilitie;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get(['id','name', 'price','slug']);

        $cartTotal = \Cart::getTotal();
        $cartCount = \Cart::getContent()->count();
        $utilities = Utilitie::first();

        return view('frontend.homepage', compact('products', 'cartTotal', 'cartCount','utilities'));
    }
    public function indexAr()
    {
        $products = Product::with('category')->get(['id','name', 'price','slug']);

        $cartTotal = \Cart::getTotal();
        $cartCount = \Cart::getContent()->count();
        $utilities = Utilitie::first();

        return view('Arfrontend.homepage', compact('products', 'cartTotal', 'cartCount','utilities'));
    }

    public function getProducts(){
        $products = Product::with('category')->get(['id','name', 'price','slug']);

        return response()->json([
            'status' => 200,
            'products' => $products
        ]);
    }
}
