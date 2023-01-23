<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Utilitie;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(Request $request, Product $product)
    {
        $cartTotal = \Cart::getTotal();
        $cartCount = \Cart::getContent()->count();
        $utilities = Utilitie::first();

        $related_products = Product::whereHas('category', function ($query) use ($product) {
            $query->whereId($product->category_id);
        })
            ->where('id', '<>', $product->id)
            ->inRandomOrder()
            ->take(4)
            ->get(['id', 'slug', 'name', 'price']);

        return view('frontend.product.show', compact('product', 'related_products', 'cartTotal', 'cartCount','utilities'));
    }
    public function showAr(Request $request, Product $product)
    {
        $cartTotal = \Cart::getTotal();
        $cartCount = \Cart::getContent()->count();
        $utilities = Utilitie::first();

        $related_products = Product::whereHas('category', function ($query) use ($product) {
            $query->whereId($product->category_id);
        })
            ->where('id', '<>', $product->id)
            ->inRandomOrder()
            ->take(4)
            ->get(['id', 'slug', 'name', 'price']);

        return view('Arfrontend.product.show', compact('product', 'related_products', 'cartTotal', 'cartCount','utilities'));
    }

    public function getProductDetail(Product $product){

        return response()->json([
            'status' => 200,
            'product' => $product,
        ]);

    }
}
