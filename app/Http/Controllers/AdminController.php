<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function home()
    {
        return view('admin.layout.index');
    }

    public function sign_in()
    {
        return view('admin.sign_in');
    }
    public function sign_out()
    {
        Auth::logout();
        return redirect('/')->with('success','Đăng xuất thành công');
    }

    public function Post_sign_in(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required'
            ],
            [
                'email.required' => 'Please enter your email!',
                'password.required' => 'Please enter your password!'
            ]
        );

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials)) {
            $url = $request->input('url', '/admin');
            return redirect($url)->with('success', 'Đăng nhập thành công!');
        } else {
            return redirect('admin/sign_in')->with('warning', 'Đăng nhập thất bại!');
        }
    }
}
