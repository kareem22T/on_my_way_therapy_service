<?php

namespace App\Http\Controllers\Doctor;

use App\Events\ChatEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\InsertTherapistTimes;
use App\Models\Client;
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
        return view('doctor.dashboard.calendar');
    }

    public function saveWorkingTimes(InsertTherapistTimes $request)
    {
        $therapist = Auth::guard('doctor')->user();

        $therapist->visits = $request->input('distance');
        $therapist->working_hours_from = $request->input('from');
        $therapist->working_hours_to = $request->input('to');
        $therapist->holidays = $request->input('holidays_arr');

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
