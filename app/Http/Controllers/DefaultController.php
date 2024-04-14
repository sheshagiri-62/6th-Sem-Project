<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Order;
class DefaultController extends Controller
{
    // Get all products by category
    public function GetProducts(Request $request){
        $category_id = $request->category_id;
        $allProduct = Product::where('category_id',$category_id)->get();

        return response()->json($allProduct);
    }


    public function index(){
        $total_orders = Order::count();
        $total_amount = Order::where('order_status','complete')->sum('total');
        $complete_orders = Order::where('order_status','complete')->count();
        $pending_orders = Order::where('order_status','pending')->count();
        return view('dashboard.index',compact('total_amount','total_orders','complete_orders','pending_orders'));
    }
}
