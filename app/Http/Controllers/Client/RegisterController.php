<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Http\Traits\SendEmail;
use App\Http\Traits\UploadClientPhoto;
use App\Models\Client;
use App\Models\Diagnosi;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Pnlinh\InfobipSms\Facades\InfobipSms;

class RegisterController extends Controller
{
    use UploadClientPhoto;
    use SendEmail;
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

    // function to check information before sending verification codes
    public function checkInfo(ClientRequest $request)
    {
        return response()->json([
            'status' => 200,
            'msg' => 'Info are correct!',
        ]);
    }
    // ....................................

    // register and validate client information ................................
    public function register(ClientRequest $request)
    {
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
            'company_phone_number' => $request->input('company_phone_number') ? $request->input('company_phone_number') : null,
            'company_address' => $request->input('company_address') ? $request->input('company_address') : null,
            'relation_to_else_client_id' =>
            $request->input('relation_to_patient') ? $request->input('relation_to_patient') : null,
            'account_type' => $request->input('account_type'),
            'session_type' =>
            count($request->input('session_type')) > 1 ? 2 : $request->input('session_type')[0],
            'client_type' => $request->input('client_type'),
            'managment_type' => $request->input('client_type') == 1 ? $request->input('managment_type') : null,
            'manager_email' => $request->input('manager_email') ? $request->input('manager_email') : null,
            'card_number' => $request->input('card_number') ? $request->input('card_number') : null,
            'name_on_card' => $request->input('name_on_card') ? $request->input('name_on_card') : null,
            'expiration_date' => null,
            'security_code' => $request->input('security_code') ? $request->input('security_code') : null
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

        if ($request->services)
            foreach ($request->services as $service) {
                $client->professions()->syncWithoutDetaching($service);
            }

        if ($client) {
            $client->verified = true;
            $client->save();
            $managed_clients = true;
            if ($request->managed_clients)
                foreach ($request->managed_clients as $managed_client) :
                    $add_managed_client = Client::create([
                        'account_type' => 2,
                        'first_name' => ucwords(json_decode($managed_client)->first_name),
                        'last_name' => ucwords(json_decode($managed_client)->last_name),
                        'dob' => json_decode($managed_client)->dob,
                        'gender' => json_decode($managed_client)->gender,
                        'managment_type' => json_decode($managed_client)->client_type == 1 ? json_decode($managed_client)->managment_type : null,
                        'manager_email' => json_decode($managed_client)->manager_email ? json_decode($managed_client)->manager_email : null,
                        'card_number' => isset(json_decode($managed_client)->card_number) ? json_decode($managed_client)->card_number : null,
                        'name_on_card' => isset(json_decode($managed_client)->name_on_card) ? json_decode($managed_client)->name_on_card : null,
                        'security_code' => isset(json_decode($managed_client)->security_code) ? json_decode($managed_client)->security_code : null,
                        'verified' => 1,
                        'manager_id' => $client->id
                    ]);

                    if ($add_managed_client)
                        $managed_clients = true;
                    else
                        $managed_clients = false;
                endforeach;

            if ($managed_clients)
                return response()->json([
                    'status' => 200,
                    'msg' => 'your account has been registered successfully.',
                ]);
        }

        return 'field to register';
    }
    // .....................................

    // update client information ................................
    public function update(Request $request)
    {
        $validator = validator([
            'photo' => ['mimes:jpeg,png,gif,jpg'],
            'first_name' => ['alpha', 'regex:/^[^\s\d]+$/'],
            'last_name' => ['alpha', 'regex:/^[^\s\d]+$/'],
            'phone' => 'regex:/^[0-9]{7,}$/|unique:clients',
            'email' => 'email|unique:clients',
            'dob' => 'date_format:Y-m-d',
        ]);

        $profile_picture_name = null;
        if ($request->photo)
            $profile_picture_name =
                $this->saveClientImg($request->photo, 'imgs/client/uploads/client_profile');

        $client = Auth::guard('client')->user();

        if ($request->photo)
            $client->photo = $profile_picture_name ? $profile_picture_name : null;
        if ($request->first_name)
            $client->first_name = ucwords($request->input('first_name'));
        if ($request->last_name)
            $client->last_name = ucwords($request->input('last_name'));
        if ($request->phone) :
            $client->phone_key = $request->input('countryCode');
            $client->phone = $request->input('phone');
        endif;
        if ($request->dob)
            $client->dob = $request->input('dob');
        if ($request->email)
            $client->email = $request->input('email');

        if ($request->address) :
            $client->address = $request->input('address');
            $client->address_lat = $request->input('address_lat');
            $client->address_lng = $request->input('address_lng');
        endif;
        $client->save();

        if ($client) {
            return response()->json([
                'status' => 200,
                'msg' => 'your data has been updated successfuly.',
            ]);
        }

        return 'field to register';
    }
    // .....................................

    // verify phone number ..........................................
    public function sendVerfication(Request $request)
    {
        $phone_code = rand(100000, 999999);
        $email_code = rand(100000, 999999);
        $response =
            InfobipSms::send(
                "+" . $request->phone_key . $request->phone,
                'Your phone verification code is: ' . $phone_code
            );

        $email = $request->email;
        $msg_title = 'Verfication code';
        $msg_body = 'Your email verfication code is: <b>' . $email_code . '</b>';

        $this->sendEmail($email, $msg_title, $msg_body);

        return response()->json([
            'status' => 200,
            'phone_code' => $phone_code,
            'email_code' => $email_code
        ]);
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