<?php

namespace App\Http\Controllers;

use App\Events\ChatEvent;
use App\Events\NotificationEvent;
use App\Http\Traits\SendEmail;
use App\Models\Appointment;
use App\Models\Chat;
use App\Models\Client;
use App\Models\Doctor;
use App\Models\Msg;
use App\Models\Notification;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Google\Service\Calendar;

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

            $therapist = Doctor::find($request->input('doctor_id'));
            $client = Client::find($request->input('client_id'));

            if ($receiver_gurard == 1)
                $this->sendEmail(
                    $therapist->email,
                    'New Message',
                    'Hi "' . $therapist->first_name . ' ' . $therapist->last_name . '"<br>'
                        .
                        '
                        You have a message from "' . $client->first_name . ' ' . $client->last_name . '"
                        <br>
                        Login <a href="https://onmywaytherapy.com.au/therapist/login">HERE</a> to reply
                        <br>
                        "' . $insertMsg->msg_data . '"
                        '
                        . '<br>Contact us: <br>' .

                        '<ul>
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
                        <h3>Call: 1800 666 929</h3>
                        ',

                );
            else
                $this->sendEmail(
                    $client->email,
                    'New Message',
                    'Hi "' . $client->first_name . ' ' . $client->last_name . '"<br>'
                        .
                        '
                        You have a message from your therapist
                        <br>
                        Login <a href="https://onmywaytherapy.com.au/client/login">HERE</a> to reply
                        <br>
                        "' . $insertMsg->msg_data . '"
                        <br>
                        <hr>
                        If you require any assistance please contact us: <br>
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
                        <h3>Call: 1800 666 929</h3>
                        ',

                );

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

        if ($appointment->visit_type == 1) :
            $calendar = new Calendar([
                'credentials' => [
                    'web' => [
                        'client_id' => '532068462627-8v0td17onc5e0rv59j1re9q34pkcnah4.apps.googleusercontent.com',
                        'project_id' => 'on-my-way-therapy',
                        'auth_uri' => 'https://accounts.google.com/o/oauth2/auth',
                        'token_uri' => 'https://oauth2.googleapis.com/token',
                        'auth_provider_x509_cert_url' => 'https://www.googleapis.com/oauth2/v1/certs',
                        'client_secret' => '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',
                    ],
                ],
            ]);


            $event = new \Google\Service\Calendar\Event(array(
                'summary' => $appointment->doctor->profession->title . ' session with Dr.' . $appointment->doctor->first_name . ' ' . $appointment->doctor->last_name . 'for ' .
                    $appointment->client->first_name . ' ' . $appointment->client->last_name,
                'start' => array(
                    'dateTime' => Carbon::parse($appointment->date),
                    'timeZone' => 'UTC',
                ),
                'end' => array(
                    'dateTime' => Carbon::parse($appointment->date)->addHours(2),
                    'timeZone' => 'UTC',
                ),
            ));

            $event = $calendar->events->insert('primary', $event);

            $meetingLink = $event->getHtmlLink();
            $appointment->meeting_link = $meetingLink;
        endif;

        $appointment->save();

        $notification = Notification::create([
            'receiver_id' => $appointment->client_id,
            'receiver_guard_type' => 2,
            'content' => 'appointment-id:' . $appointment->id
        ]);

        $this->sendEmail(
            $appointment->client->email,
            'Session approved',
            'Hi "' . $appointment->client->first_name . ' ' . $appointment->client->last_name . '"<br>' .
                'Your session at ' .
                Carbon::createFromFormat('Y-m-d H:i:s', $appointment->date)->format('F j, g:i A')
                . ' has been approved by: Dr.' . $appointment->doctor->first_name .
                ($appointment->visit_type == 1 ? '<br><b>Here is the session link <a href="' . $appointment->meeting_link . '">Join here</a></b>' : '') .
                '<br> Login <a href="https://onmywaytherapy.com.au/client/login">Here</a> to contact the therapist and know more details'
                . '<hr>Contact us: <br>' .
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
                    <h3>Call: 1800 666 929</h3>
                    ',

        );

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

        $this->sendEmail(
            $appointment->client->email,
            'The session is approaching',
            'Hi "' . $appointment->client->first_name . ' ' . $appointment->client->last_name . '"<br>' . '
            <h3>Your therapist is starting to move and is now on his way to you.</h3><br>
            Login <a href="https://onmywaytherapy.com.au/client/login">HERE</a> to get in touch with your therapist <br>
            Contact us: <br>' .
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
                    <h3>Call: 1800 666 929</h3>
                    ',

        );

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
        $this->sendEmail(
            $appointment->client->email,
            'The session is about to start',
            'Hi "' . $appointment->client->first_name . ' ' . $appointment->client->last_name . '"<br>' . '
            <h3>Your therapist has arrived to your location.</h3>
            Login <a href="https://onmywaytherapy.com.au/client/login">HERE</a> to get in touch with your therapist <br>
            Contact us: <br>' .
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
                    <h3>Call: 1800 666 929</h3>
                    ',

        );

        if ($appointment)
            event(new ChatEvent(
                'new-notification',
                $appointment->client_id . '_' . 2
            ));
    }
    public function complete(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'duration' => 'required',
            'repeat' => 'required',
        ], [
            'duration.required' => 'Please confirm the session duration.',
            'repeat.required' => 'Please chose how you want repeat this session.',
        ]);

        $appointment = Appointment::find($request->id);
        $appointment->journey = 4;
        $appointment->duration = $request->duration;
        $appointment->save();

        switch ($request->repeat) {
            case 1:
                $insert = Appointment::create([
                    'doctor_id' => $appointment->doctor_id,
                    'client_id' => $appointment->client_id,
                    'visit_type' => $appointment->visit_type,
                    'date' => Carbon::parse($appointment->date)->addWeek(),
                    'start_time' => $appointment->date,
                    'finish_time' => Carbon::parse($appointment->date)->addWeek()->addHours(1.5),
                    'address' => $appointment->address,
                    'address_lat' => $appointment->address_lat,
                    'address_lng' => $appointment->address_lng,
                    'journey' => 1,
                    'status' => 1
                ]);
                if ($insert)
                    event(new ChatEvent(
                        'new-notification',
                        $appointment->client_id . '_' . 2
                    ));
                break;
            case 2:
                $insert = Appointment::create([
                    'doctor_id' => $appointment->doctor_id,
                    'client_id' => $appointment->client_id,
                    'visit_type' => $appointment->visit_type,
                    'date' => Carbon::parse($appointment->date)->addWeeks(2),
                    'start_time' => $appointment->date,
                    'finish_time' => Carbon::parse($appointment->date)->addWeeks(2)->addHours(1.5),
                    'address' => $appointment->address,
                    'address_lat' => $appointment->address_lat,
                    'address_lng' => $appointment->address_lng,
                    'journey' => 1,
                    'status' => 1
                ]);
                if ($insert)
                    event(new ChatEvent(
                        'new-notification',
                        $appointment->client_id . '_' . 2
                    ));
                break;

            default:
                break;
        }

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if ($appointment) :
            $this->sendEmail(
                $appointment->client->email,
                'Session confirmation',
                'Hi "' . $appointment->client->first_name . ' ' . $appointment->client->last_name . '"<br>' . '
                <h3>Has the session at ' . $appointment->date . ' with Dr.' . $appointment->doctor->first_name .
                    ' ' . $appointment->doctor->last_name . 'completed?</h3>
                Please confirm it is completed from here <a href="https://onmywaytherapy.com.au/client/session-confirmation/' . $appointment->id . '">HERE</a><br>
                Contact us: <br>' .
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
                        <h3>Call: 1800 666 929</h3>
                        ',

            );
            return response()->json([
                'status' => 200,
                'msg' => 'The session has been completed successfuly,<br> wait for the client to confirm it'
            ]);
        endif;
    }

    public function acceptAppointment(Request $request)
    {
        $appointment = Appointment::find($request->id);

        $appointment->status = true;
        if ($appointment->visit_type == 1) :
            $calendar = new Calendar([
                'credentials' => [
                    'web' => [
                        'client_id' => '532068462627-8v0td17onc5e0rv59j1re9q34pkcnah4.apps.googleusercontent.com',
                        'project_id' => 'on-my-way-therapy',
                        'auth_uri' => 'https://accounts.google.com/o/oauth2/auth',
                        'token_uri' => 'https://oauth2.googleapis.com/token',
                        'auth_provider_x509_cert_url' => 'https://www.googleapis.com/oauth2/v1/certs',
                        'client_secret' => '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',
                    ],
                ],
            ]);


            $event = new \Google\Service\Calendar\Event(array(
                'summary' => $appointment->doctor->profession->title . ' session with Dr.' . $appointment->doctor->first_name . ' ' . $appointment->doctor->last_name . 'for ' .
                    $appointment->client->first_name . ' ' . $appointment->client->last_name,
                'start' => array(
                    'dateTime' => Carbon::parse($appointment->date),
                    'timeZone' => 'UTC',
                ),
                'end' => array(
                    'dateTime' => Carbon::parse($appointment->date)->addHours(2),
                    'timeZone' => 'UTC',
                ),
            ));

            $event = $calendar->events->insert('primary', $event);

            $meetingLink = $event->getHtmlLink();
            $appointment->meeting_link = $meetingLink;
        endif;

        $appointment->save();

        $msg = Msg::find($request->msg_id);
        $msg->msg_data = '<p>' . $request->msg_content . '</p><span class=accepted> Accepted !</span>';
        $msg->save();

        if ($appointment && $msg) :
            $this->sendEmail(
                $appointment->client->email,
                'Session approved',
                'Hi "' . $appointment->client->first_name . ' ' . $appointment->client->last_name . '"<br>' .
                    'Your session at ' .
                    Carbon::createFromFormat('Y-m-d H:i:s', $appointment->date)->format('F j, g:i A')
                    . ' has been approved by: Dr.' . $appointment->doctor->first_name .
                    ($appointment->visit_type == 1 ? '<br><b>Here is the session link <a href="' . $appointment->meeting_link . '">Join here</a></b>' : '') .
                    '<br> Login <a href="https://onmywaytherapy.com.au/client/login">Here</a> to contact the therapist and know more details'
                    . '<hr>Contact us: <br>' .
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
                    <h3>Call: 1800 666 929</h3>
                    ',

            );
            return response()->json([
                'status' => 200,
                'msg' => $appointment->client->first_name . ' ' . $appointment->client->last_name . ' has accepted the new session date.'
            ]);
        endif;
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
        $appointment->wait = 0;
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

    public function cancelAppointment(Request $request)
    {
        $appointment = Appointment::find($request->id);
        $appointment->status = 3;

        $appointment->save();

        $this->sendEmail(
            $appointment->doctor->email,
            'Appointment Cancelation',
            'Hi "' . $appointment->doctor->first_name . ' ' . $appointment->doctor->last_name . '"<br>' .
                'Your client has cancelled the session <br> 
            Login <a href="https://onmywaytherapy.com.au/therapist/chats/' . $appointment->client->id . '">HERE</a> to see contact client <br><br><b>Session details: </b><br>
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
                <h3>Call: 1800 666 929</h3>
                ',

        );

        if ($appointment)
            return response()->json([
                'status' => 200,
                'msg' => $appointment->client->first_name . ' ' . $appointment->client->last_name . ' has canceld the session.'
            ]);
    }

    public function sessionConfirmationIndex($appointment_id)
    {
        $appointment = Appointment::find($appointment_id);
        return view('Client.dashboard.confirm-session')->with(compact('appointment'));
    }

    public function confirmSession(Request $request)
    {
        $appointment = Appointment::find($request->input('appointment_id'));
        $appointment->journey = 5;
        $appointment->save();

        if ($appointment) :
            $this->sendEmail(
                "info@onmywaytherapy.com.au",
                'a Session have Completed',
                '
                <b>Session details</b> <br>
                Date:' . Carbon::parse($appointment->date)->format('M d') . ' ' . Carbon::parse($appointment->date)->format('h:i a') . '
                Client name: ' . $appointment->client->first_name . ' ' . $appointment->client->last_name . '<br>' .
                    'Therapist name: ' . $appointment->doctor->first_name . ' ' . $appointment->doctor->last_name . '<br>' .
                    ($appointment->visit_type == 0 ?
                        "Client address: " . $appointment->address . '<br>' : '') .
                    "Client gender: " . $appointment->client->gender . '<br>' .
                    "Client age: " .  Carbon::parse($appointment->client->dob)->age . ' years old<br><hr><br>
                    <b>Invoice</b>: <br>
                    Costs the client: ' .
                    (((int) $appointment->duration) / 60) *
                    ($appointment->doctor->profession->id == 6 ? 214.41 : 193.99)
                    . ' + ' . $request->input('client_cost') . ' Travel cost<br>
                    Therapist profit: ' .
                    (((int) $appointment->duration) / 60) *
                    (139)
                    . ' + '
                    . $request->input('therapist_profit') . ' Travel cost<br>
                    Session duration: ' . $appointment->duration . '<br>
                    ' . ($appointment->duration != $request->input('duration') ? "<br> Note: The client confirmed the session as " . $request->input('duration') . " min while the therapist confirmed as " . $appointment->duration . " whitch is not the same" : '')
            );

            return response()->json([
                'status' => 200,
                'msg' => 'thanks for confirm session!'
            ]);
        endif;
    }
}
