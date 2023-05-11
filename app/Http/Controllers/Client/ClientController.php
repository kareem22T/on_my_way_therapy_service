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
        if (strpos($usernameOrSearch, 'therapist@') !== false && strpos($usernameOrSearch, '_') !== false) {
            $pos = strpos($usernameOrSearch, '_');
            $therapist_id = substr($usernameOrSearch, $pos + 1);
            $therapist = Doctor::find($therapist_id);
            return view('client.dashboard.home')->with(compact('therapist'));
        } elseif (strpos($usernameOrSearch, 'search:') !== false) {
            $search = substr($usernameOrSearch, strpos($usernameOrSearch, ':') + 1);
            $profession_name = str_replace("%20", " ", $search);
            $profession = Profession::where('title', 'LIKE', "%{$profession_name}%")->first();
            $search_profession = [];
            if ($profession)
                $search_profession = Doctor::select('id', 'experience', 'photo', 'first_name', 'last_name', 'gender', 'dob')
                    ->where('profession_id', $profession->id)->paginate(5);

            $diagnosis_name = str_replace("%20", " ", $search);
            $search_diagnosis = Doctor::whereHas('diagnosis', function ($query) use ($diagnosis_name) {
                $query->where('name', 'LIKE', "%{$diagnosis_name}%");
            })->paginate(5);

            $doctor_name = str_replace("%20", " ", $search);
            $doctor_first_name = explode(' ', trim($doctor_name))[0];
            $doctor = Doctor::where('first_name', 'LIKE', "%{$doctor_first_name}%")
                ->orWhere('last_name', 'LIKE', "%{$doctor_first_name}%")
                ->first();
            if ($doctor)
                return redirect('/client/therapist@' . $doctor->first_name . '_' . $doctor->id);

            $search_results = null;
            if (count($search_profession) > 0) {
                $search_results = $search_profession;
            } elseif (count($search_diagnosis) > 0) {
                $search_results = $search_diagnosis;
            } else {
                $search_results = [];
            }
            return view('client.dashboard.home')->with(compact('search_results', 'search'));
        } else {
            return view('client.dashboard.home');
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

    public function insertAppointment(HostAppointmentRequest $request)
    {
        $appointment = Appointment::create([
            'doctor_id' => $request->doctor_id,
            'client_id' => Auth::guard('client')->user()->id,
            'visit_type' => $request->visit_type,
            'date' => $request->date,
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
                'You have new appointment by: ' . $appointment->client->first_name . '<a href="/therapist/chats/' . $appointment->id . '"> View appointmet</a>'
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