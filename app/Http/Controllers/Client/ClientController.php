<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index($therapist_username)
    {
        $get_therapist_id = substr($therapist_username, strrpos($therapist_username, "_") + 1);
        $therapist = Doctor::find($get_therapist_id);
        return view('client.dashboard.home')->with(compact('therapist'));
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

    public function insertAppointment(Request $request)
    {
        $appointment = Appointment::create([
            'doctor_id' => $request->doctor_id,
            'date' => $request->date
        ]);

        if ($appointment)
            return response()->json(
                [
                    'status' => 200,
                    'msg' => 'Your appointment is pendding wait for therapist to review it'
                ]
            );
    }

    public function getSlotsApproved(Request $request)
    {
        return $appointments = Appointment::select('date')->whereDate('date', '=', Carbon::parse($request->date)->format('Y-m-d'))->where('doctor_id', $request->doctor_id)->where('status', true)->get();
    }
}
