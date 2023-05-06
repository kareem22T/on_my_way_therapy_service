<?php

namespace App\Http\Controllers\Client;

use App\Events\ChatEvent;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Chat;
use App\Models\Doctor;
use App\Models\Msg;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index($username = null)
    {
        $therapist = null;
        if ($username != null) :
            $get_therapist_id = substr($username, strrpos($username, "_") + 1);
            $therapist = Doctor::find($get_therapist_id);
        endif;

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
            'client_id' => Auth::guard('client')->user()->id,
            'visit_type' => $request->visit_type,
            'date' => $request->date
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
}
