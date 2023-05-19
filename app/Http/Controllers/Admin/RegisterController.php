<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function indexLogin()
    {
        $admins = Admin::all();
        if ($admins->count() == 0)
            Admin::create([
                'username' => 'admin',
                'password' => Hash::make('admin'),
                'name' => 'admin'
            ]);

        return view('admin.login');
    }

    // login as a client .........................................
    public function checkLogin(Request $request)
    {
        $credentials = ['username' => $request->input('username'), 'password' => $request->input('password')];

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->intended('/admin');
        }
        return back()->with(['errorLogin' => 'Your username or password are incorrect']);
    }
    // .....................................
    // logout from client account
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/');
    }
}