<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admins;
use App\Http\Controllers\ProductController;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        $admin = Admins::where('email', $credentials['email'])->first();

        if ($admin && $admin->password === $credentials['password']) {
            
            
            return view('products.dashboard');
        } else {
            return redirect()->route('admin.login')->with('error', 'Invalid login credentials');
        }
    }
    public function dashboard(){
    return view('products/dashboard');
    }
   



}