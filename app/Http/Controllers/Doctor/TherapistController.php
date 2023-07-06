<?php

namespace App\Http\Controllers\Doctor;

use App\Events\ChatEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\InsertTherapistTimes;
use App\Models\Appointment;
use App\Models\Client;
use App\Models\Day;
use App\Models\Doctor;
use App\Models\workingHour;
use Carbon\Carbon;
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
        $events = [];

        $appointments = Appointment::where('doctor_id', Auth::guard('doctor')->user()->id)->where('journey', 1)->where('journey', '!=', 4)->with(['client', 'doctor'])->get();

        if (!empty($appointments))
            foreach ($appointments as $appointment) {
                $events[] = [
                    'title' => 'session by: ' . $appointment->client->first_name,
                    'start' => $appointment->start_time,
                    'end' => $appointment->finish_time,
                ];
            }

        return view('doctor.dashboard.calendar')->with(compact('events'));
    }

    public function appointmentDetails($appointment_id = null)
    {
        $appointment = Appointment::where('id', $appointment_id)->where('doctor_id', Auth::guard('doctor')->user()->id)->first();

        if ($appointment_id)
            return view('doctor.dashboard.appointment')->with(compact('appointment'));

        return view('doctor.dashboard.appointment')->with(compact('appointment'));
    }
    public function getDateOfSpecificDay($dayAbbreviation)
    {
        $now = Carbon::now();
        $currentDay = $now->dayOfWeek;

        $daysOfWeek = [
            'Mon' => 1,
            'Tue' => 2,
            'Wed' => 3,
            'Thu' => 4,
            'Fri' => 5,
            'Sat' => 6,
            'Sun' => 0
        ];

        $targetDay = $daysOfWeek[$dayAbbreviation];

        if ($targetDay === $currentDay && $now == $now->startOfWeek()) {
            return $now;
        }

        $difference = ($targetDay - $currentDay + 7) % 7;
        $date = $now->addDays($difference);

        return $date;
    }
    public function setWorkingHours(Request $request)
    {
        $therapistId = Auth::guard('doctor')->user()->id; // Assuming you have authentication setup


        foreach ($request->working_hours_data as $index => $req) {
            $day = $req['day_name'];
            $starttime = $req['start_work'];
            $endtime = $req['end_work'];
            $recurring = $request->recurring ? true : false;


            $currentDayNumber = Carbon::now()->dayOfWeek;
            $today = Carbon::now('UTC');

            $date = $currentDayNumber == $index + 1 ? $today : ((($index + 1) - $currentDayNumber) < 0 ? $today->subDays((($index + 1) - $currentDayNumber) * -1) : $today->addDays(($index + 1) - $currentDayNumber));

            // store the working hours in the database
            workinghour::updateOrCreate(
                ['doctor_id' => $therapistId, 'day_of_week' => $day],
                ['start_time' => $starttime, 'end_time' => $endtime, 'recurring' => $recurring, 'date' => $date->format('Y-m-d')]
            );
        }

        return response()->json([
            'status' => 200,
            'msg'    => $recurring == false ? 'your working times has been set for this week.' : 'Your working times have been set for all weeks',
        ]);
    }

    public function getWorkingHours(Request $request)
    {
        $dayOfWeek = Carbon::parse($request->date)->format('D');

        $therapistId = $request->therapist_id;

        $workingHours = WorkingHour::where('doctor_id', $therapistId)
            ->whereDate('date', Carbon::parse($request->date)->format('Y-m-d'))
            ->orWhere('recurring', true)
            ->where('day_of_week', $dayOfWeek)
            ->first();

        return $workingHours;
    }
}