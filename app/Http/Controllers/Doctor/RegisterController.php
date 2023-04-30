<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorRequest;
use App\Http\Requests\TherapistInforamtionRequest;
use App\Http\Requests\TherapistPaymentRequest;
use App\Http\Requests\TherapistVerficationRequest;
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
    public function indexVerify()
    {
        return view('doctor.verify');
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
            'password' => Hash::make('123456789'),
        ]);

        if ($doctor) {
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
    public function sendVerfication()
    {
        $phone_code = rand(100000, 999999);
        $email_code = rand(100000, 999999);
        $response =
            InfobipSms::send(
                "+" . Auth::guard('doctor')->user()->phone_key . Auth::guard('doctor')->user()->phone,
                'Your phone verification code is: ' . $phone_code
            );

        $email = Auth::guard('doctor')->user()->email;
        $msg_title = 'Verfication code';
        $msg_body = 'Your email verfication code is: <b>' . $email_code . '</b>';

        $this->sendEmail($email, $msg_title, $msg_body);

        return response()->json([
            'status' => 200,
            'phone_code' => Hash::make($phone_code),
            'email_code' => Hash::make($email_code)
        ]);
    }
    // .....................................

    // verify email, phone and adding new password
    public function verify(TherapistVerficationRequest $request)
    {
        $therapist = Auth::guard('doctor')->user();
        $therapist->password = Hash::make($request->password);
        $therapist->verified = true;
        $therapist->save();

        if ($therapist) {
            return response()->json(
                [
                    'status' => 200,
                    'msg' => 'your account has been verified successfully'
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

        $WWCC_name = $this->saveCertificate($request->WWCC, 'imgs/doctor/uploads/therapist_certificates', 'WWCC');
        $insert->WWCC_path = $WWCC_name;

        $AHPRA_name = $this->saveCertificate($request->AHPRA, 'imgs/doctor/uploads/therapist_certificates', 'AHPRA');
        $insert->AHPRA_path = $AHPRA_name;

        $NDIS_name = $this->saveCertificate($request->NDIS, 'imgs/doctor/uploads/therapist_certificates', 'NDIS');
        $insert->NDIS_path = $NDIS_name;

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

            return response()->json([
                'status' => 200,
                'msg' => 'your payment information has been registed successfully'
            ]);
        }
    }
    // .....................................

    // logout from doctor account
    public function logout()
    {
        Auth::guard('doctor')->logout();
        return redirect('/');
    }
}