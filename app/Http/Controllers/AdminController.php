<?php

namespace App\Http\Controllers;

use App\Http\Middleware\AdminMiddleware;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(AdminMiddleware::class);
    }


    public function dashboard(){
        $total_users = User::count();
        $low_stocks = Product::where('quantity', '<', 5)->count();
        $total_orders = 50;
        $total_revenue = 50000;
        return view('admin.dashboard', compact('total_users','total_orders','total_revenue', 'low_stocks'));
    }



}
