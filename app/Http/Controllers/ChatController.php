<?php

namespace App\Http\Controllers;

use App\Events\ChatEvent;
use App\Events\NotificationEvent;
use App\Http\Traits\SendEmail;
use App\Models\Appointment;
use App\Models\Chat;
use App\Models\Doctor;
use App\Models\Msg;
use App\Models\Notification;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    use SendEmail;

    public function send(Request $request)
    {
        // return $request;
        $chat_exist = Chat::where([
            ['doctor_id', '=', $request->input('doctor_id')],
            ['client_id', '=', $request->input('client_id')],
        ])->first();

        if (!$chat_exist)
            $createChat = Chat::create([
                'doctor_id' => $request->input('doctor_id'),
                'client_id' => $request->input('client_id'),
            ]);
        else
            $createChat = $chat_exist;

        $insertMsg = Msg::create([
            'chat_id' => $createChat->id,
            'sender_guard' => Auth::guard('doctor')->check() ? 1 : 2,
            'msg_data' => $request->input('msg'),
            'created_at' => $request->input('created_at'),
        ]);

        $receiver_id = $insertMsg->sender_guard == 1 ? $createChat->client_id : $createChat->doctor_id;
        $receiver_gurard = $insertMsg->sender_guard == 1 ? 2 : 1;

        if ($insertMsg) {
            event(new ChatEvent(
                $insertMsg->msg_data,
                $receiver_id . '_' . $receiver_gurard
            ));

            // if ($insertMsg->sender_guard == 2) {
            //     $email = Doctor::find($createChat->doctor_id)->get()->email;
            //     $msg_title = 'Message notification';
            //     $msg_body = 'you have received a message';

            //     $this->sendEmail($email, $msg_title, $msg_body);
            // }
            return response()->json([
                'status' => 200,
                'message' => 'your message has been sent successfully',
            ]);
        }
    }

    public function msgSeen(Request $request)
    {
        $chat = Chat::where([
            ['doctor_id', '=', $request->input('doctor_id')],
            ['client_id', '=', $request->input('client_id')],
        ])->first();

        $sender_guard = Auth::guard('doctor')->check() ? 2 : 1;

        if (!$chat->msgs->where('sender_guard', $sender_guard)->last()->seen) {
            foreach ($chat->msgs->where('seen', 0) as $msg) {
                if ($msg->sender_guard == $sender_guard) {
                    $msg->seen = true;
                    $msg->save();
                }
            }

            $receiver_id = $sender_guard == 1 ? $chat->client_id : $chat->doctor_id;
            $receiver_gurard = Auth::guard('doctor')->check() ? 2 : 1;

            event(new ChatEvent(
                'seen',
                $receiver_id . '_' . $receiver_gurard
            ));
        }
    }

    public function getUnseenAll()
    {
        $guard_type = Auth::guard('client')->check() ? 2 : 1;
        $unSeen = 0;
        foreach (Auth::guard('client')->check() ?
            Auth::guard('client')->user()->chats :
            Auth::guard('doctor')->user()->chats as $chat) :
            $unSeen += $chat->msgs->where('seen', 0)->where('sender_guard', '!=', $guard_type)->count();
        endforeach;

        return $unSeen;
    }

    public function getUseenPerChat(Request $request)
    {
        // return $request;
        $unseen = Chat::find($request->chat_id)->msgs->where('sender_guard', '=', (int) $request->sender_guard)->where('seen', 0)->count();
        return $unseen;
    }

    public function getAppointmentData(Request $request)
    {
        $appointment = Appointment::with(['client' => function ($q) {
            $q->select('id', 'photo', 'first_name', 'last_name', 'gender', 'dob', 'address');
        }])->find($request->appointmetn_id);

        return $appointment;
    }

    public function approveAppointment(Request $request)
    {
        $appointment = Appointment::find($request->id);

        $appointment->status = true;
        $appointment->journey = true;

        $appointment->save();

        $notification = Notification::create([
            'receiver_id' => $appointment->client_id,
            'receiver_guard_type' => 2,
            'content' => 'appointment-id:' . $appointment->id
        ]);
        if ($notification)
            event(new ChatEvent(
                'new-notification',
                $appointment->client_id . '_' . 2
            ));

        if ($appointment)
            return response()->json([
                'status' => 200,
                'msg' => 'Your session at ' .
                    Carbon::createFromFormat('Y-m-d H:i:s', $appointment->date)->format('F j, g:i A')
                    . ' has been approved by: Dr.' . $appointment->doctor->first_name
            ]);
    }

    public function startMove(Request $request)
    {
        $appointment = Appointment::find($request->id);
        $appointment->journey = 2;
        $appointment->save();

        if ($appointment)
            event(new ChatEvent(
                'new-notification',
                $appointment->client_id . '_' . 2
            ));
    }

    public function arrived(Request $request)
    {
        $appointment = Appointment::find($request->id);
        $appointment->journey = 3;
        $appointment->save();

        if ($appointment)
            event(new ChatEvent(
                'new-notification',
                $appointment->client_id . '_' . 2
            ));
    }
    public function complete(Request $request)
    {
        $appointment = Appointment::find($request->id);
        $appointment->journey = 4;
        $appointment->save();
    }

    public function acceptAppointment(Request $request)
    {
        $appointment = Appointment::find($request->id);

        $appointment->status = true;

        $appointment->save();

        $msg = Msg::find($request->msg_id);
        $msg->msg_data = '<p>' . $request->msg_content . '</p><span class=accepted> Accepted !</span>';
        $msg->save();

        if ($appointment && $msg)
            return response()->json([
                'status' => 200,
                'msg' => $appointment->client->first_name . ' ' . $appointment->client->last_name . ' has accepted the new session date.'
            ]);
    }

    public function editAppointmentTime(Request $request)
    {
        // return $request;
        $chat = Chat::where([
            ['doctor_id', '=', $request->doctor_id],
            ['client_id', '=', $request->client_id],
        ])->first();

        $appointment = Appointment::find($request->id);
        $appointment->date = $request->new_date;
        $appointment->status = 2;
        $appointment->save();

        if ($appointment) :

            $insertMsg = Msg::create([
                'chat_id' => $chat->id,
                'sender_guard' => 1,
                'msg_data' => 'send',
            ]);

            $msg =
                '<p>Your appointment time has been changed to ' .
                Carbon::parse($request->new_date)->format('F j, g:i a') . '</p>' .
                '<div class="btns"><button appointment_id="' . $appointment->id . '" msg_id="' . $insertMsg->id . '" class="accept_change">Accept Date</button>' .
                '<button appointment_id="' . $appointment->id . '"  msg_id="' . $insertMsg->id . '" class="cancel_change">Cancel</button></div>';

            $insertMsg->msg_data = $msg;
            $insertMsg->save();

            if ($insertMsg)
                event(new ChatEvent(
                    $insertMsg->msg_data,
                    $request->client_id . '_' . 2
                ));

            return response()->json([
                'status' => 200,
                'msg' => $msg,
                'notification' => 'Wait for client confirmation on the new date!'
            ]);
        endif;
    }
}
