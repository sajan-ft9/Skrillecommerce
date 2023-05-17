<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Middleware\AdminMiddleware;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(AdminMiddleware::class);
    }


    public function dashboard(){
        $total_users = User::count()-1;
        $low_stocks = Product::where('quantity', '<', 5)->count();
        $total_orders = Order::count();
        $total_revenue = Order::sum('total_price');
        return view('admin.dashboard', compact('total_users','total_orders','total_revenue', 'low_stocks'));
    }

    public function orders()
    {
        $orders = Order::all();
        return view('admin.products.orders', compact('orders'));
    }

    public function deliver(Order $order){
        $order->update([
                'deliver_status' => 1
            ]); 
        return redirect()->back()->with('success', 'Delivered Successfully');
    }



}
