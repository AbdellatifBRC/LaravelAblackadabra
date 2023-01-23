<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\OrderSimple;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class OrderController extends Controller
{
    public function index(){
        //$orders = OrderSimple::with('products')->get();

        return view('admin.orders.index');
    }
    public function getAdminOrders(){
        $orders = OrderSimple::with('orderItems')->paginate(10);

        return response()->json([
            'status' => 200,
            'orders' => $orders
        ]);
    }
}
