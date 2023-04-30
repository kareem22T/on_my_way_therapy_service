<?php

namespace App\Http\Controllers;

use App\Events\ChatEvent;
use App\Http\Traits\SendEmail;
use App\Models\Chat;
use App\Models\Doctor;
use App\Models\Msg;
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
}
