<?php

namespace App\Http\Controllers;

use App\Http\Middleware\UserMiddleware;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(UserMiddleware::class);
    }

    public function dashboard(){
        $user = auth()->user();
        return view('user.dashboard', compact('user'));
    }
}
