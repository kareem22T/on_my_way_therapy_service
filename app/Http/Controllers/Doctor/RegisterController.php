<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorRequest;
use App\Http\Requests\TherapistInforamtionRequest;
use App\Http\Requests\TherapistPasswordRequest;
use App\Http\Requests\TherapistPaymentRequest;
use App\Http\Traits\InsertDoctorCertificatesTrait;
use App\Http\Traits\SendEmail;
use App\Http\Traits\UploadTherapistPhoto;
use App\Models\Client_age_range;
use App\Models\Diagnosi;
use App\Models\Doctor;
use App\Models\Profession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Pnlinh\InfobipSms\Facades\InfobipSms;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class RegisterController extends Controller
{
    use InsertDoctorCertificatesTrait;
    use UploadTherapistPhoto;
    use SendEmail;

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

    // get doctor verify view .....................................
    public function indexPasswordSet()
    {
        return view('doctor.password');
    }
    // ....................................

    // get doctor information view .....................................
    public function indexInformation()
    {
        $professions = Profession::all();
        $Client_age_range = Client_age_range::all();
        return view('doctor.information')->with(compact('professions', 'Client_age_range'));
    }
    // ....................................

    // get doctor information view .....................................
    public function indexPayment()
    {
        return view('doctor.payment');
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
            return redirect()->intended('/');
        }
        return back()->with(['errorLogin' => 'Your email/phone number or password are incorrect']);
    }
    // .....................................

    // function to check information before sending verification codes
    public function checkRegistrationInfo(DoctorRequest $request)
    {
        return response()->json([
            'status' => 200,
            'msg' => 'Info are correct!',
        ]);
    }
    // ....................................

    // register and validate doctor information ................................
    public function register(DoctorRequest $request)
    {
        $profile_picture_name =
            $this->saveTherapistImg($request->photo, 'imgs/doctor/uploads/therapist_profile');

        $doctor = Doctor::create([
            'photo' => $profile_picture_name,
            'first_name' => ucwords($request->input('first_name')),
            'last_name' => ucwords($request->input('last_name')),
            'phone_key' => $request->input('countryCode'),
            'phone' => $request->input('phone'),
            'gender' => $request->gender,
            'dob' => $request->input('dob'),
            'gender' => $request->input('gender'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'address_lat' => $request->input('address_lat'),
            'address_lng' => $request->input('address_lng'),
            'password' => Hash::make('123456789'),
        ]);

        if ($doctor) {
            $doctor->verified = true;
            $doctor->save();
            return response()->json([
                'status' => 200,
                'msg' => 'your account has been registered please complete the registration process'
            ]);
        }

        return 'field to register';
    }
    // .....................................

    // check if there doctor logined ................................
    public function thereTherapist()
    {
        if (Auth::guard('doctor')->check()) {
            return 1;
        }

        return 0;
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

    // verify email, phone and adding new password
    public function setPassword(TherapistPasswordRequest $request)
    {
        $therapist = Auth::guard('doctor')->user();
        $therapist->password = Hash::make($request->password);
        $therapist->password_set = true;
        $therapist->save();

        if ($therapist) {
            return response()->json(
                [
                    'status' => 200,
                    'msg' => 'your password has been set successfully'
                ]
            );
        }
    }
    // .....................................

    // insert therapist information
    public function insertInformation(TherapistInforamtionRequest $request)
    {
        $insert = Auth::guard('doctor')->user();
        $insert->profession_id = $request->input('profession');
        $insert->client_gender = $request->input('client_gender');
        $insert->experience = $request->input('experience');

        foreach ($request->diagnosis as $dia) {
            Diagnosi::create([
                'name' => $dia,
            ]);
        }
        foreach ($request->diagnosis as $dia) {
            $insert->diagnosis()->syncWithoutDetaching(Diagnosi::where('name', $dia)->first()->id);
        }

        $insert->WWCC_number = $request->WWCC;

        if ($request->AHPRA) {
            $insert->AHPRA_number = $request->AHPRA;
        } else if ($request->SPA) {
            $insert->SPA_number = $request->SPA;
        } else if ($request->practitioner_number) {
            $insert->practitioner_number = $request->practitioner_number;
        };

        $insert->NDIS_number = $request->NDIS;

        $insert->about_me = $request->input('about_me');

        foreach ($request->client_age_range as $range) {
            $insert->ClientAgeRange()->syncWithoutDetaching($range);
        }

        $insert->travel_range = $request->input('travel_rang');
        $insert->visits = count($request->input('visits_type')) > 1 ? 2 : $request->input('visits_type')[0];

        $insert->save();

        if ($insert) {
            $insert->information_registerd = true;
            $insert->save();

            return response()->json([
                'status' => 200,
                'msg' => 'your information has been registed successfully'
            ]);
        }
    }
    // .....................................

    // insert therapist payment information
    public function insertPayment(TherapistPaymentRequest $request)
    {
        $insert = Auth::guard('doctor')->user();
        $insert->name_payment = $request->input('name');
        $insert->BSB_payment = $request->input('BSB');
        $insert->account_payment = $request->input('bank_account');
        $insert->ABN_payment = $request->input('ABN');
        $insert->agreed_on_policy = $request->input('agree');
        $insert->save();

        if ($insert) {
            $insert->payment_registered = true;
            $insert->save();

            $email = 'info@onmywaytherapy.com.au';
            $msg_title = 'New therapist';
            $msg_body = 'New therapist has been registered see its data <a href="http://www.onmywaytherapy.com.au/therapist/' . $insert->id . '">Here</a>';

            $this->sendEmail($email, $msg_title, $msg_body);

            return response()->json([
                'status' => 200,
                'msg' => 'your payment information has been registed successfully'
            ]);
        }
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
                $this->saveClientImg($request->photo, 'imgs/doctor/uploads/therapist_profile');

        $therapist = Auth::guard('doctor')->user();

        if ($request->photo)
            $therapist->photo = $profile_picture_name ? $profile_picture_name : null;
        if ($request->first_name)
            $therapist->first_name = ucwords($request->input('first_name'));
        if ($request->last_name)
            $therapist->last_name = ucwords($request->input('last_name'));
        if ($request->phone) :
            $therapist->phone_key = $request->input('countryCode');
            $therapist->phone = $request->input('phone');
        endif;
        if ($request->dob)
            $therapist->dob = $request->input('dob');
        if ($request->email)
            $therapist->email = $request->input('email');

        if ($request->address) :
            $therapist->address = $request->input('address');
            $therapist->address_lat = $request->input('address_lat');
            $therapist->address_lng = $request->input('address_lng');
        endif;
        $therapist->save();

        if ($therapist) {
            return response()->json([
                'status' => 200,
                'msg' => 'your data has been updated successfuly.',
            ]);
        }

        return 'field to register';
    }
    // .....................................

    public function changePassIndex() {
        return view('doctor.write_email_to_change_pass');
    }

    public function showChangePassForm(Request $request) {
        $validator = validator([
            'email' => ['required', 'email'],
        ], [
            'email.required' => 'Please enter your email'
        ]);

        $email_code = rand(100000, 999999);

        $email = $request->email;
        $msg_title = 'Verfication code';
        $msg_body = 'Your email verfication code is: <b>' . $email_code . '</b>';

        return $this->sendEmail($email, $msg_title, $msg_body);

        // return view('doctor.change_password');
    }

    // logout from doctor account
    public function logout()
    {
        Auth::guard('doctor')->logout();
        return redirect('/');
    }
}
