<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }


    public function register(Request $request){
        $formFields = $request->validate([
            'name' => ['required','min:3','max:50'],
            'email' => ['required', 'email','unique:users,email'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);
        $formFields['password'] = Hash::make($request->password);

        User::create($formFields);
        return redirect('/login')->with('success', 'Registration successful');
    }

    
    public function showLoginForm()
    {
        return view('auth.login');
    }
    

    public function login(Request $request){
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8']
        ]);
        $formFields = $request->only('email', 'password');

        if(Auth::attempt($formFields)){
            $request->session()->regenerate();
            
            if(Auth::user()->role =='admin'){
                return redirect('/admin/dashboard');
            }else{
                return redirect('/dashboard');
            }
        }else{
            return back()->withErrors([
                'email' => 'Credentials do not match our records'
            ]);
        }
    }

    public function logout(){
        Auth::logout();
        return  redirect('/');
    }

}
