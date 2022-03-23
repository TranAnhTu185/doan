<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\User;
use App\Customer;
use App\Bill;

class HomeController extends Controller
{
    //Dashboard Page
    public function index()
    {
        $amount_p = Product::all()->count();
        $amount_u = User::all()->count();
        $amount_c = Customer::all()->count();
        $amount_b = Bill::all()->count();
        return view('admin.index')->with(['amount_p' => $amount_p, 'amount_u' => $amount_u, 'amount_c' => $amount_c, 'amount_b'=> $amount_b]);
    }

    //Login page
    public function loginpage()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            return redirect()->route('admin.home')->with('success', 'Đăng nhập thành công.');
        } else {
            return redirect()->route('admin.login')->with('error', 'Email hoặc mật khẩu chưa chính xác.');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login')->with('success', 'Đăng xuất thành công');
    }

}
