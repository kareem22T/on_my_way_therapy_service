<?php

namespace App\Http\Controllers\Client;

use App\Events\ChatEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\HostAppointmentRequest;
use App\Http\Traits\SendEmail;
use App\Models\Appointment;
use App\Models\Chat;
use App\Models\Diagnosi;
use App\Models\Doctor;
use App\Models\Msg;
use App\Models\Profession;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    use SendEmail;
    public function index($usernameOrSearch = null)
    {
        // check if this client filled out the service agreement or not to show the alert
        $cleint = Auth::guard('client')->user();
        $serviceAgreement = false;

        $apiUrl = 'https://api.jotform.com/form/231594061545557/submissions?apikey=96244a471e11324bcabbe43ab10db2df';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if ($response === false) {
            echo 'Error: ' . curl_error($ch);
        } else {
            $data = json_decode($response, true);

            foreach ($data['content'] as $content) {
                if ($content['status'] !== 'DELETED')
                    foreach ($content['answers'] as $answer) {
                        if (isset($answer['name']) && $answer['name'] == 'client_id') {
                            if ($answer['answer'] == $cleint->id) {
                                $serviceAgreement = true;
                            }
                        }
                    }
            }
        }
        curl_close($ch);
        // check if this client filled out the  risk assessments or not to show the alert
        $cleint = Auth::guard('client')->user();
        $riskAssessment = false;

        $apiUrl = 'https://api.jotform.com/form/231613271952554/submissions?apikey=96244a471e11324bcabbe43ab10db2df';

        $ch2 = curl_init();
        curl_setopt($ch2, CURLOPT_URL, $apiUrl);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch2);

        if ($response === false) {
            echo 'Error: ' . curl_error($ch2);
        } else {
            $data = json_decode($response, true);

            foreach ($data['content'] as $content) {
                if ($content['status'] !== 'DELETED')
                    foreach ($content['answers'] as $answer) {
                        if (isset($answer['name']) && $answer['name'] == 'client_id') {
                            if ($answer['answer'] == $cleint->id) {
                                $riskAssessment = true;
                            }
                        }
                    }
            }
        }
        curl_close($ch2);

        if (strpos($usernameOrSearch, 'therapist@') !== false && strpos($usernameOrSearch, '_') !== false) {

            $pos = strpos($usernameOrSearch, '_');
            $therapist_id = substr($usernameOrSearch, $pos + 1);
            $therapist = Doctor::find($therapist_id);
            return view('client.dashboard.home')->with(compact('therapist', 'serviceAgreement', 'riskAssessment'));
        } elseif (strpos($usernameOrSearch, 'search:') !== false) {

            $search = substr($usernameOrSearch, strpos($usernameOrSearch, ':') + 1);
            $profession_name = str_replace("%20", " ", $search);
            $profession = Profession::where('title', 'LIKE', "%{$profession_name}%")->first();
            $search_profession = [];

            if ($profession)
                $search_profession = Doctor::select('id', 'experience', 'photo', 'first_name', 'last_name', 'gender', 'dob')
                    ->where('working_hours_from', '!=', null)
                    ->where('working_hours_from', '!=', null)
                    ->where('profession_id', $profession->id)->where('approved', 1)->paginate(5);

            $diagnosis_name = str_replace("%20", " ", $search);
            $search_diagnosis = Doctor::where('working_hours_from', '!=', null)->whereHas('diagnosis', function ($query) use ($diagnosis_name) {
                $query->where('name', 'LIKE', "%{$diagnosis_name}%");
            })->paginate(5);

            $doctor_name = str_replace("%20", " ", $search);
            $doctor_first_name = explode(' ', trim($doctor_name))[0];
            $doctor = Doctor::where('working_hours_from', '!=', null)->where('first_name', 'LIKE', "%{$doctor_first_name}%")
                ->orWhere('last_name', 'LIKE', "%{$doctor_first_name}%")
                ->first();

            if ($doctor)
                return redirect('/client/therapist@' . $doctor->first_name . '_' . $doctor->id)->with(compact('serviceAgreement', 'riskAssessment'));

            $search_results = null;
            if (count($search_profession) > 0) {
                $search_results = $search_profession;
            } elseif (count($search_diagnosis) > 0) {
                $search_results = $search_diagnosis;
            } else {
                $search_results = [];
            }
            return view('client.dashboard.home')->with(compact('search_results', 'search', 'serviceAgreement', 'riskAssessment'));
        } else {
            return view('client.dashboard.home')->with(compact('serviceAgreement', 'riskAssessment'));
        }
    }

    public function indexAccount()
    {
        return view('client.dashboard.account');
    }

    public function indexChats($therapist_id = null)
    {
        $therapist_data = null;
        if ($therapist_id)
            $therapist_data = Doctor::find($therapist_id)
                ->only(['id', 'first_name', 'last_name', 'photo', 'email']);

        $chats = Auth::guard('client')->user()->chats;

        return view('client.dashboard.chat')->with(compact('therapist_data', 'chats'));
    }

    public function checkAssessmentsDone()
    {
        // check if this client filled out the service agreement or not to show the alert
        $cleint = Auth::guard('client')->user();
        $serviceAgreement = false;

        $apiUrl = 'https://api.jotform.com/form/231594061545557/submissions?apikey=96244a471e11324bcabbe43ab10db2df';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if ($response === false) {
            echo 'Error: ' . curl_error($ch);
        } else {
            $data = json_decode($response, true);

            foreach ($data['content'] as $content) {
                if ($content['status'] !== 'DELETED')
                    foreach ($content['answers'] as $answer) {
                        if (isset($answer['name']) && $answer['name'] == 'client_id') {
                            if ($answer['answer'] == $cleint->id) {
                                $serviceAgreement = true;
                            }
                        }
                    }
            }
        }
        curl_close($ch);
        // check if this client filled out the  risk assessments or not to show the alert
        $cleint = Auth::guard('client')->user();
        $riskAssessment = false;

        $apiUrl = 'https://api.jotform.com/form/231613271952554/submissions?apikey=96244a471e11324bcabbe43ab10db2df';

        $ch2 = curl_init();
        curl_setopt($ch2, CURLOPT_URL, $apiUrl);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch2);

        if ($response === false) {
            echo 'Error: ' . curl_error($ch2);
        } else {
            $data = json_decode($response, true);

            foreach ($data['content'] as $content) {
                if ($content['status'] !== 'DELETED')
                    foreach ($content['answers'] as $answer) {
                        if (isset($answer['name']) && $answer['name'] == 'client_id') {
                            if ($answer['answer'] == $cleint->id) {
                                $riskAssessment = true;
                            }
                        }
                    }
            }
        }
        curl_close($ch2);

        if ($serviceAgreement == true && $riskAssessment == true) {
            return response()->json([
                'status' => 200,
            ]);
        } else {
            return response()->json([
                'status' => 419,
            ]);
        }
    }

    public function insertAppointment(HostAppointmentRequest $request)
    {
        $appointment = Appointment::create([
            'doctor_id' => $request->doctor_id,
            'client_id' => Auth::guard('client')->user()->id,
            'visit_type' => $request->visit_type,
            'date' => $request->date,
            'start_time' => $request->date,
            'finish_time' => Carbon::parse($request->date)->addHours(1.5),
            'address' => $request->address,
            'address_lat' => $request->address_lat,
            'address_lng' => $request->address_lng,
        ]);

        if ($appointment) {
            $chat_exist = Chat::where([
                ['doctor_id', '=', $request->doctor_id],
                ['client_id', '=', Auth::guard('client')->user()->id],
            ])->first();

            if (!$chat_exist)
                $createChat = Chat::create([
                    'doctor_id' => $request->doctor_id,
                    'client_id' => Auth::guard('client')->user()->id,
                ]);
            else
                $createChat = $chat_exist;

            $insertMsg = Msg::create([
                'chat_id' => $createChat->id,
                'sender_guard' => 2,
                'msg_data' =>  'appointment-id:' . $appointment->id,
            ]);

            if ($insertMsg)
                event(new ChatEvent(
                    'appointment-id:' . $appointment->id,
                    $request->doctor_id . '_' . 1
                ));

            $this->sendEmail(
                $appointment->doctor->email,
                'New Appointment',
                'Hi "' . $appointment->doctor->first_name . ' ' . $appointment->doctor->last_name . '"<br>' . 'Congratulations you have a booking request on your profile <br> 
                Login <a href="https://onmywaytherapy.com.au/therapist/login">HERE</a> to see contact client or simply accept <br><br><b>Session details: </b><br>
                ' . ($appointment->visit_type == 0 ? 'Session type: Mobile visit<br>' : 'Session type: Online session <br>') .
                    'Client name: ' . $appointment->client->first_name . ' ' . $appointment->client->last_name . '<br>' .
                    ($appointment->visit_type == 0 ?
                        "Client address: " . $appointment->address . '<br>' : '') .
                    "Client gender: " . $appointment->client->gender . '<br>' .
                    "Client age: " .  Carbon::parse($appointment->client->dob)->age . ' years old<br><hr><br>'
                    . 'Contact us: <br>' .
                    '
                    <ul>
                        <li>
                            <a href="https://www.facebook.com/people/On-My-Way-Therapy/100092588026660/">
                                Facebook
                            </a>
                        </li>
                        <li>
                            <a href="https://www.linkedin.com/company/94288210/admin/">
                                Linkedin
                            </a>
                        </li>
                        <li>
                            <a href="https://www.instagram.com/on_my_way_therapy_australia/">
                                Instagram
                            </a>
                        </li>
                        <li>
                            <a href="https://www.youtube.com/@OnMyWayTherapy">
                                Youtube
                            </a>
                        </li>
                    </ul>
                    <hr>
                    <h3>Call: 1800666992</h3>
                    ',

            );

            return response()->json(
                [
                    'status' => 200,
                    'msg' => 'Your appointment is pendding wait for therapist to review it'
                ]
            );
        }
    }

    public function getSlotsApproved(Request $request)
    {
        $appointments =
            Appointment::select('date')
            ->where('status', true)
            ->whereDate('date', '=', Carbon::parse($request->date)->format('Y-m-d'))
            ->where('doctor_id', $request->doctor_id)
            ->get();

        return $appointments;
    }

    public function getSearchHints(Request $request)
    {
        $search_profession = Profession::select('title')
            ->where('title', 'LIKE', "%{$request->search}%")
            ->take(5)
            ->pluck('title')
            ->toArray();

        $search_diagnosis = Diagnosi::select('name')
            ->where('name', 'LIKE', "%{$request->search}%")
            ->take(5)
            ->pluck('name')
            ->toArray();

        $doctors = Doctor::select('first_name', 'last_name')
            ->where('working_hours_from', '!=', null)
            ->where('first_name', 'LIKE', "%{$request->search}%")
            ->orWhere('last_name', 'LIKE', "%{$request->search}%")
            ->take(5)->get();

        $search_doctor = [];

        foreach ($doctors as $doctor) {
            $search_doctor[] = $doctor->first_name . ' ' . $doctor->last_name;
        }


        $search_results = null;
        if (count($search_profession) > 0) {
            $search_results = $search_profession;
        } elseif (count($search_diagnosis) > 0) {
            $search_results = $search_diagnosis;
        } elseif (count($search_doctor) > 0) {
            $search_results = $search_doctor;
        } elseif (!$request->search) {
            $search_results = [];
        } else {
            $search_results = ['Records not matched.'];
        }

        return $search_results;
    }
}
