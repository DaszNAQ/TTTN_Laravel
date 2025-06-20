<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('client.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required',
            'address' => 'required|string|max:255',
            'password' => 'required|min:6',
        ]);

        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address'  => $request->address,
            'password' => Hash::make($request->password),
        ]);

        Session::put('customer', $customer);
        return redirect('/')->with('success', 'Đăng ký thành công!');
    }

    public function showLogin()
    {
        return view('client.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $customer = Customer::where('email', $request->email)->first();
        if ($customer && Hash::check($request->password, $customer->password)) {
            Session::put('customer', $customer);
            return redirect('/')->with('success', 'Đăng nhập thành công!');
        }

        return redirect()->back()->with('error', 'Email hoặc mật khẩu sai!');
    }

    public function logout()
    {
        Session::forget('customer');
        return redirect('/')->with('success', 'Đã đăng xuất!');
    }


public function showChangePassword()
{
    if (!Session::has('customer')) {
        return redirect()->route('customer.login')->with('error', 'Vui lòng đăng nhập.');
    }

    return view('client.change_password');
}

public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:6|confirmed',
    ]);

    $customer = Customer::find(Session::get('customer')->id);

    if (!Hash::check($request->current_password, $customer->password)) {
        return back()->with('error', 'Mật khẩu hiện tại không đúng.');
    }

    $customer->password = Hash::make($request->new_password);
    $customer->save();

    // Cập nhật lại session customer
    Session::put('customer', $customer);

    return back()->with('success', 'Đổi mật khẩu thành công!');
}
}
