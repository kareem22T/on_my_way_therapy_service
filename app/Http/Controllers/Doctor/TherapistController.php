<?php

namespace App\Http\Controllers\Doctor;

use App\Events\ChatEvent;
use App\Http\Controllers\Controller;
use App\Models\Client;
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


    // public function sendTest()
    // {
    //     $token = "eQebJHGpsfA:APA91bHdEf4BbWD2JiY1VgMXbu_gy-5bhpRXgj_0eVD3EMifxPjI-dX6Zsy51WDBPNeyZwy6BmHy4OgaiFKnfeGOcQXu0gdNzXRerQ6ogP0EqBKDfS5K3X3coEqIzzPo0NXC2SkcAchX";
    //     $from = "AAAAE2SDxRQ:APA91bG5bOT9quTADKu1aXMnfaDtKsyjBDv-ZFaFMXtDD5xD8zqqHS12UYJQ_H3OtZSeAhIBcB8JdvN_6ZQCE_xyFhCOj5yHeneH8O41CcdIdKVr7J9Pq_IN6x7oj7lw5MAOA_rF_Qpi";
    //     $msg = array(
    //         'body'  => "Testing Testing",
    //         'title' => "Hi, From Raj",
    //         'receiver' => 'erw',
    //         'icon'  => "https://image.flaticon.com/icons/png/512/270/270014.png",/*Default Icon*/
    //         'sound' => 'mySound'/*Default sound*/
    //     );

    //     $fields = array(
    //         'to'        => $token,
    //         'notification'  => $msg
    //     );

    //     $headers = array(
    //         'Authorization: key=' . $from,
    //         'Content-Type: application/json'
    //     );
    //     //#Send Reponse To FireBase Server 
    //     $ch = curl_init();
    //     curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    //     curl_setopt($ch, CURLOPT_POST, true);
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    //     $result = curl_exec($ch);
    //     dd($result);
    //     curl_close($ch);
    // }

    public function sendTest()
    {
        event(new ChatEvent('hello world', 1));
    }
}
