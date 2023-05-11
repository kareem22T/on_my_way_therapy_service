<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function getNotifications()
    {
        return $notifications = Notification::where('receiver_id', Auth::guard('client')->user()->id)->where('receiver_guard_type', Auth::guard('doctor')->check() ? 1 : 2)->get();
    }

    public function getAppointmentData(Request $request)
    {
        $appointment = Appointment::with([Auth::guard('doctor')->check() ? 'client' : 'doctor' => function ($q) {
            $q->select('id', 'photo', 'first_name', 'last_name', 'gender', 'dob', 'address');
        }])->where('journey', '>', 0)->find($request->appointmetn_id);

        return $appointment;
    }

    public function getUnseenNotification()
    {
        $unSeen = Notification::where('receiver_id', Auth::guard('client')->user()->id)->where('seen', 0)->get();

        return $unSeen->count();
    }

    public function seenNotifiction()
    {
        $unSeen = Notification::where('receiver_id', Auth::guard('client')->user()->id)->where('seen', 0)->get();
        foreach ($unSeen as $noti) {
            $noti->seen = true;
        }
        $noti->save();
    }
}
