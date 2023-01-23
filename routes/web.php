<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//ablackadabra route
Route::get('/',function(){
    return view('ablackadabra.home');
});
Route::get('register/users',[App\Http\Controllers\Auth\RegisterController::class,'autoComplete'])->name('register.autocomplete');
Route::group(['middleware'=> 'auth'],function(){
    Route::get('/ablackadabra/account',function(){
    return view('ablackadabra.account');
});
});


//home pages route
// Route::get('/', [\App\Http\Controllers\HomeController::class, 'indexAr'])->name('homepage');
// Route::get('/shop/{slug?}', [\App\Http\Controllers\ShopController::class, 'indexAr'])->name('shop.index');
// Route::get('/shop/tag/{slug?}', [\App\Http\Controllers\ShopController::class, 'tagAr'])->name('shop.tag');
// Route::get('/product/{product:slug}', [\App\Http\Controllers\ProductController::class, 'showAr'])->name('product.show');
// Route::get('/contact',[\App\Http\Controllers\Admin\MessageController::class,'indexAr'])->name('contact');
// Route::post('/contact/store',[\App\Http\Controllers\Admin\MessageController::class,'store'])->name('contact.store');

// Route::prefix('en-us')->group(function(){
//     Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('en.homepage');
//     Route::get('/shop/{slug?}', [\App\Http\Controllers\ShopController::class, 'index'])->name('en.shop.index');
//     Route::get('/shop/tag/{slug?}', [\App\Http\Controllers\ShopController::class, 'tag'])->name('en.shop.tag');
//     Route::get('/product/{product:slug}', [\App\Http\Controllers\ProductController::class, 'show'])->name('en.product.show');
//     Route::get('/contact',[\App\Http\Controllers\Admin\MessageController::class,'index'])->name('en.contact');
//     Route::post('/contact/store',[\App\Http\Controllers\Admin\MessageController::class,'store'])->name('en.contact.store');
// });

// react route
Route::get('products/{slug?}', [\App\Http\Controllers\ShopController::class, 'getProducts']);
Route::get('products', [\App\Http\Controllers\HomeController::class, 'getProducts']);
Route::get('product-detail/{product:slug}', [\App\Http\Controllers\ProductController::class, 'getProductDetail']);
Route::post('carts', [\App\Http\Controllers\CartController::class, 'store']);
Route::get('carts', [\App\Http\Controllers\CartController::class, 'showCart']);
// ongkir
Route::get('api/provinces', [\App\Http\Controllers\OngkirController::class, 'getProvinces']);
Route::get('api/cities', [\App\Http\Controllers\OngkirController::class, 'cities']);
Route::get('api/shipping-cost', [\App\Http\Controllers\OngkirController::class, 'shippingCost']);
Route::post('api/set-shipping', [\App\Http\Controllers\OngkirController::class, 'setShipping']);
Route::post('api/checkout', [\App\Http\Controllers\OrderController::class, 'checkout']);
Route::post('api/order', [\App\Http\Controllers\OrderController::class, 'order']);
// Route::get('/order/index', function(){
//     return view('frontend.order.order');
// });
Route::post('/store',[\App\Http\Controllers\OrderController::class, 'order']);
//get admin data for React
Route::get('/api/products', [\App\Http\Controllers\Admin\ProductController::class,'getAdminProducts'])->name('getAdminProducts');
Route::get('/api/categories', [\App\Http\Controllers\Admin\CategoryController::class, 'getAdminCategories'])->name('getadmincategories');
Route::get('/api/tags', [\App\Http\Controllers\Admin\TagController::class, 'getAdminTags'])->name('getadmintags');
Route::get('/api/orders', [\App\Http\Controllers\Admin\OrderController::class, 'getAdminOrders'])->name('getadminorders');
Route::get('/api/messages',[\App\Http\Controllers\Admin\MessageController::class, 'getAdminMessages']);
Route::post('/api/messages/{action}',[\App\Http\Controllers\Admin\MessageController::class, 'handleAction']);
Route::get('/api/utilities', [\App\Http\Controllers\Admin\UtilitiesController::class,'show']);
Route::post('/api/utilities/update', [\App\Http\Controllers\Admin\UtilitiesController::class,'store']);
// get user login
Route::get('api/users', [\App\Http\Controllers\UserController::class, 'index']);
// ==========


Route::group(['middleware' => 'auth'], function() {

    Route::get('/order/checkout', [\App\Http\Controllers\OrderController::class, 'arprocess'])->name('checkout.process');
    Route::get('/en-us/order/checkout', [\App\Http\Controllers\OrderController::class, 'process'])->name('en.checkout.process');
    Route::resource('/cart', \App\Http\Controllers\CartController::class)->except(['store', 'show']);

    Route::group(['middleware' => ['isAdmin'],'prefix' => 'admin', 'as' => 'admin.'], function() {
        Route::get('dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

        // categories
        Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
        Route::post('categories/images', [\App\Http\Controllers\Admin\CategoryController::class,'storeImage'])->name('categories.storeImage');

        // tags
        Route::resource('tags', \App\Http\Controllers\Admin\TagController::class);

        // products
        Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
        Route::post('products/images', [\App\Http\Controllers\Admin\ProductController::class,'storeImage'])->name('products.storeImage');
        Route::post('products/{id}/destroy', [\App\Http\Controllers\Admin\ProductController::class,'destroy']);

        //Orders
        Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class);

        //E-vitrine
        Route::get('/e-vitrine', [\App\Http\Controllers\Admin\UtilitiesController::class,'index'])->name('vitrine.index');

        //Messages
        Route::get('/messages', [App\Http\Controllers\Admin\MessageController::class , 'indexAdmin'])->name('messages.index');
    });
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
