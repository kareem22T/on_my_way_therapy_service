<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Http\Traits\UploadClientPhoto;
use App\Models\Client;
use App\Models\Diagnosi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    use UploadClientPhoto;
    // get client registeration view .............................
    public function indexRegister()
    {
        return view('client.register');
    }
    // ....................................

    // get client login view .....................................
    public function indexLogin()
    {
        return view('client.login');
    }
    // ....................................

    // register and validate client information ................................
    public function register(ClientRequest $request)
    {
        $request->validate([
            'manager_email' => (($request->input('plan_managment') == 0) && ($request->input('client_type') == 1)) ? 'required' : ''
        ]);
        $profile_picture_name = null;
        if ($request->photo)
            $profile_picture_name =
                $this->saveClientImg($request->photo, 'imgs/client/uploads/client_profile');

        $client = Client::create([
            'account_type' => $request->input('account_type'),
            'photo' => $profile_picture_name ? $profile_picture_name : null,
            'first_name' => ucwords($request->input('first_name')),
            'last_name' => ucwords($request->input('last_name')),
            'phone_key' => $request->input('countryCode'),
            'phone' => $request->input('phone'),
            'dob' => $request->input('dob'),
            'gender' => $request->input('gender'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'address_lat' => $request->input('address_lat'),
            'address_lng' => $request->input('address_lng'),
            'password' => Hash::make($request->input('password')),
            'company_name' => $request->input('company_name') ? $request->input('company_name') : null,
            'company_email' => $request->input('company_email') ? $request->input('company_email') : null,
            'relation_to_patient' =>
            $request->input('relation_to_patient') ? $request->input('relation_to_patient') : 'self',
            'account_type' => $request->input('account_type'),
            'session_type' =>
            count($request->input('session_type')) > 1 ? 2 : $request->input('session_type')[0],
            'client_type' => $request->input('client_type'),
            'card_number' => $request->input('card_number'),
            'therapist_gender' => $request->input('therapist_gender'),
            'managment_type' => $request->input('client_type') == 1 ? $request->input('plan_managment') : null,
            'manager_email' => $request->input('client_type') == 0 ? $request->input('manager_email') : null,
        ]);

        if ($request->diagnosis)
            foreach ($request->diagnosis as $dia) {
                Diagnosi::create([
                    'name' => $dia,
                ]);
            }
        if ($request->diagnosis)
            foreach ($request->diagnosis as $dia) {
                $client->diagnosis()->syncWithoutDetaching(Diagnosi::where('name', $dia)->first()->id);
            }

        if ($client) {
            return response()->json([
                'status' => 200,
                'msg' => 'your account has been registered successfully.',
            ]);
        }

        return 'field to register';
    }
    // .....................................

    // login as a client .........................................
    public function checkLogin(Request $request)
    {
        if (filter_var($request->input('emailorphone'), FILTER_VALIDATE_EMAIL)) {
            $credentials = ['email' => $request->input('emailorphone'), 'password' => $request->input('password')];
        } else {
            $credentials = ['phone' => $request->input('emailorphone'), 'password' => $request->input('password')];
        }

        if (Auth::guard('client')->attempt($credentials)) {
            return redirect()->intended('/');
        }
        return back()->with(['errorLogin' => 'Your email/phone number or password are incorrect']);
    }
    // .....................................

    // logout from client account
    public function logout()
    {
        Auth::guard('client')->logout();
        return redirect('/');
    }
}
