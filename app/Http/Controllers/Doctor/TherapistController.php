<?php

namespace App\Http\Controllers\Doctor;

use App\Events\ChatEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\InsertTherapistTimes;
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

    public function indexMyAccount()
    {
        $therapist = Auth::guard('doctor')->user()->only(['first_name', 'last_name', 'photo', 'profession']);
        return view('doctor.dashboard.account')->with(compact('therapist'));
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
        $therapist_times = Auth::guard('doctor')->user()->only(['working_hours_from', 'working_hours_to', 'holidays', 'travel_range']);

        if (
            $therapist_times['working_hours_from'] !== null &&
            $therapist_times['working_hours_to'] !== null &&
            count($therapist_times['holidays']) > 0 &&
            $therapist_times['travel_range'] !== null
        )
            return view('doctor.dashboard.calendar')->with(compact('therapist_times'));

        return view('doctor.dashboard.calendar');
    }

    public function saveWorkingTimes(InsertTherapistTimes $request)
    {
        $therapist = Auth::guard('doctor')->user();

        $therapist->travel_range = $request->distance;
        $therapist->working_hours_from = $request->from;
        $therapist->working_hours_to = $request->to;

        foreach ($request->holidays_arr as $day) {
            $therapist->holidays()->syncWithoutDetaching(Day::find($day)->id);
        }

        $therapist->save();

        if ($therapist)
            return response()->json(
                [
                    'status' => 200,
                    'msg' => 'You have set your time'
                ]
            );
    }
}
