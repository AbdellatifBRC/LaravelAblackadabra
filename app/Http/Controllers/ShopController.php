<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Utilitie;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $cartTotal = \Cart::getTotal();
        $cartCount = \Cart::getContent()->count();
        $utilities = Utilitie::first();

        return view('frontend.shop.index', compact('cartTotal', 'cartCount','utilities'));
    }
    public function indexAr()
    {
        $cartTotal = \Cart::getTotal();
        $cartCount = \Cart::getContent()->count();
        $utilities = Utilitie::first();

        return view('Arfrontend.shop.index', compact('cartTotal', 'cartCount','utilities'));
    }

    public function getProducts(Request $request,$slug = null){

        $sorting = $request->sortingBy;

        switch ($sorting) {
            case 'popularity':
                $sortField = 'id';
                $sortType = 'desc';
                break;
            case 'low-high':
                $sortField = 'price';
                $sortType = 'asc';
                break;
            case 'high-low':
                $sortField = 'price';
                $sortType = 'desc';
                break;
            default:
                $sortField = 'id';
                $sortType = 'asc';
        }

        $products = Product::with('category');

        if(!is_null($slug)){
            $category = Category::whereSlug($slug)->firstOrFail();


            if (is_null($category->category_id)) {

                $categoriesIds = Category::whereCategoryId($category->id)->pluck('id')->toArray();
                $categoriesIds[] = $category->id;
                $products = $products->whereHas('category', function ($query) use ($categoriesIds) {
                    $query->whereIn('id', $categoriesIds);
                });

            } else {
                $products = $products->whereHas('category', function ($query) use ($slug) {
                    $query->where([
                        'slug' => $slug,
                    ]);
                });

            }
        }

        $products = $products->orderBy($sortField, $sortType)->get();

        return response()->json([
            'message' => 'Success hhh',
            'products' => $products
        ]);

    }

    public function tag(Request $request, $slug)
    {
        $cartTotal = \Cart::getTotal();
        $cartCount = \Cart::getContent()->count();
        $utilities= Utilitie::first();
        $sorting = $request->sortingBy;
        switch ($sorting) {
            case 'popularity':
                $sortField = 'id';
                $sortType = 'desc';
                break;
            case 'low-high':
                $sortField = 'price';
                $sortType = 'asc';
                break;
            case 'high-low':
                $sortField = 'price';
                $sortType = 'desc';
                break;
            default:
                $sortField = 'id';
                $sortType = 'asc';
        }

        $products = Product::with('tags');

        $products = $products->whereHas('tags', function ($query) use($slug) {
            $query->where([
                'slug' => $slug,
            ]);
        })
        ->orderBy($sortField, $sortType)
        ->paginate(6);

        return view('frontend.shop.index', compact('products','slug','cartCount','cartTotal','utilities'));
    }
    public function tagAr(Request $request, $slug)
    {
        $cartTotal = \Cart::getTotal();
        $cartCount = \Cart::getContent()->count();
        $sorting = $request->sortingBy;
        switch ($sorting) {
            case 'popularity':
                $sortField = 'id';
                $sortType = 'desc';
                break;
            case 'low-high':
                $sortField = 'price';
                $sortType = 'asc';
                break;
            case 'high-low':
                $sortField = 'price';
                $sortType = 'desc';
                break;
            default:
                $sortField = 'id';
                $sortType = 'asc';
        }

        $products = Product::with('tags');

        $products = $products->whereHas('tags', function ($query) use($slug) {
            $query->where([
                'slug' => $slug,
            ]);
        })
        ->orderBy($sortField, $sortType)
        ->paginate(6);

        return view('frontend.shop.index', compact('products','slug','cartCount','cartTotal'));
    }
}
