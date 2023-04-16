<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    // get doctor registeration view .............................
    public function indexRegister()
    {
        return view('doctor.register');
    }
    // ....................................

    // get doctor login view .....................................
    public function indexLogin()
    {
        return view('doctor.login');
    }
    // ....................................

    // login as a doctor .........................................
    public function checkLogin(Request $request)
    {
        if (filter_var($request->input('emailorphone'), FILTER_VALIDATE_EMAIL)) {
            $credentials = ['email' => $request->input('emailorphone'), 'password' => $request->input('password')];
        } else {
            $credentials = ['phone' => $request->input('emailorphone'), 'password' => $request->input('password')];
        }

        if (Auth::guard('doctor')->attempt($credentials)) {
            return redirect()->intended('/doctor/test');
        }
        return back()->with(['errorLogin' => 'The username or password are incorrect']);
    }
    // .....................................

    // register and validate doctor information ................................
    public function register(DoctorRequest $request)
    {
        return $request;
    }
    // .....................................

    // check if there doctor logined ................................
    public function thereDoctor()
    {
        if (Auth::guard('doctor')->check()) {
            return 1;
        }

        return 0;
    }
    // .....................................
}
