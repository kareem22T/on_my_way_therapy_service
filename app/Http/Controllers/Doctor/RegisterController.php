<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorRequest;
use App\Http\Requests\TherapistInforamtionRequest;
use App\Http\Requests\TherapistVerficationRequest;
use App\Http\Traits\InsertDoctorCertificatesTrait;
use App\Models\Client_age_range;
use App\Models\Diagnosi;
use App\Models\Doctor;
use App\Models\Profession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Pnlinh\InfobipSms\Facades\InfobipSms;
use Illuminate\Support\Str;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class RegisterController extends Controller
{
    use InsertDoctorCertificatesTrait;
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
        return back()->with(['errorLogin' => 'The username or password are incorrect']);
    }
    // .....................................

    // register and validate doctor information ................................
    public function register(DoctorRequest $request)
    {
        $doctor = Doctor::create([
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
            return 'your account has been registered please complete the registration process';
        }

        return 'field to login';
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

        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'kotbekareem74@gmail.com';                     //SMTP username
            $mail->Password   = 'sggusadbiiimeqih';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;
            //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('kotbekareem74@gmail.com', 'YK-web');
            $mail->addAddress(Auth::guard('doctor')->user()->email);     //Add a recipient

            //Content
            $mail->isHTML(true);
            $mail->Subject = 'Verfication code';
            $mail->Body    = 'Your email verfication code is: <b>' . $email_code . '</b>';
            $mail->SMTPDebug = 2;
            ob_start();
            $mail->send();
            $responsePayload = ob_get_clean();
            $mail->SMTPDebug = 0;
        } catch (Exception $e) {
            return [
                'status' => 500
            ];
        }
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

        $WWCC_name = $this->saveImg($request->WWCC, 'imgs/doctor/uploads/therapist_certificates', 'WWCC');
        $insert->WWCC_path = $WWCC_name;

        $AHPRA_name = $this->saveImg($request->AHPRA, 'imgs/doctor/uploads/therapist_certificates', 'AHPRA');
        $insert->AHPRA_path = $AHPRA_name;

        $NDIS_name = $this->saveImg($request->NDIS, 'imgs/doctor/uploads/therapist_certificates', 'NDIS');
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

    // logout from doctor account
    public function logout()
    {
        Auth::guard('doctor')->logout();
        return redirect('/');
    }
}
