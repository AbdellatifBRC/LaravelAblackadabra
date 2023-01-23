<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderSimple;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        $date =  Carbon::now()->startOfMonth();
        $data = DB::table('order_simples')
        ->select('created_at','grand_total')
        ->where('created_at','>',$date)
        ->sum('grand_total');
       // dd($data);
        return view('admin.dashboard',['data' => $data]);
    }
}
