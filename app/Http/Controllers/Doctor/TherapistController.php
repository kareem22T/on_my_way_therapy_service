<?php

namespace App\Http\Controllers\Doctor;

use App\Events\ChatEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\InsertTherapistTimes;
use App\Models\Appointment;
use App\Models\Client;
use App\Models\Day;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TherapistController extends Controller
{
    public function index()
    {
        return view('doctor.home');
    }

    public function indexPending()
    {
        return view('doctor.pending');
    }

    public function getClientProfileIndex($id)
    {
        $client = Client::find($id);

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
                            if ($answer['answer'] == $client->id) {
                                $answers = $content['answers'];
                            }
                        }
                    }
            }
        }
        curl_close($ch2);

        return view('doctor.dashboard.client_profile')->with(compact('client', 'answers'));
    }

    public function indexMyAccount()
    {
        $therapist = Auth::guard('doctor')->user()->only(['first_name', 'last_name', 'photo', 'profession']);
        return view('doctor.dashboard.account')->with(compact('therapist'));
    }

    public function indexProfile()
    {
        return view('doctor.dashboard.profile');
    }

    public function indexChats($client_id = null)
    {
        $client_data = null;
        if ($client_id)
            $client_data = Client::find($client_id)
                ->only(['id', 'first_name', 'last_name', 'photo', 'email']);

        $chats = Auth::guard('doctor')->user()->chats;

        return view('doctor.dashboard.chat')->with(compact('client_data', 'chats'));
    }

    public function indexCalendar()
    {
        $therapist_times = Auth::guard('doctor')->user()->only(['working_hours_from', 'working_hours_to', 'travel_range']);

        $events = [];

        $appointments = Appointment::where('doctor_id', Auth::guard('doctor')->user()->id)->where('journey', 1)->where('journey', '!=', 4)->with(['client', 'doctor'])->get();

        foreach ($appointments as $appointment) {
            $events[] = [
                'title' => 'session by: ' . $appointment->client->first_name,
                'start' => $appointment->start_time,
                'end' => $appointment->finish_time,
                'workingHours' => '00:00-12:00',
            ];
        }


        if (
            $therapist_times['working_hours_from'] !== null &&
            $therapist_times['working_hours_to'] !== null &&
            $therapist_times['travel_range'] !== null
        )
            return view('doctor.dashboard.calendar')->with(compact('therapist_times', 'events'));

        return view('doctor.dashboard.calendar')->with(compact('events'));
    }

    public function appointmentDetails($appointment_id = null)
    {
        $appointment = Appointment::where('id', $appointment_id)->where('doctor_id', Auth::guard('doctor')->user()->id)->first();

        if ($appointment_id)
            return view('doctor.dashboard.appointment')->with(compact('appointment'));

        return view('doctor.dashboard.appointment')->with(compact('appointment'));
    }

    public function saveWorkingTimes(InsertTherapistTimes $request)
    {
        $therapist = Auth::guard('doctor')->user();

        $therapist->travel_range = $request->distance;
        $therapist->working_hours_from = $request->from;
        $therapist->working_hours_to = $request->to;

        $therapist->save();

        if ($therapist)
            return response()->json(
                [
                    'status' => 200,
                    'msg' => 'You have set your time'
                ]
            );
    }
    public function editWorkingTimes(Request $request)
    {
        $therapist = Auth::guard('doctor')->user();

        if ($request->distance) :
            $validated = $request->validate([
                'distance' => 'required',
            ]);
            $therapist->travel_range = $request->distance;
        endif;

        if ($request->from && $request->to) :
            $validated = $request->validate([
                'from' => 'required',
                'to' => 'required|gte:from|different:from',
            ]);
            $therapist->working_hours_from = $request->from;
            $therapist->working_hours_to = $request->to;
        endif;

        $therapist->save();

        if ($therapist)
            return response()->json(
                [
                    'status' => 200,
                    'msg' => 'Your schedule has been updated!'
                ]
            );
    }
}
