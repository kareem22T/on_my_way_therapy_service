<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function getAppointment()
    {
        $events = [];

        $appointments = Appointment::with(['client', 'doctor'])->get();

        foreach ($appointments as $appointment) {
            $events[] = [
                'title' => 'session by: ' . $appointment->client->first_name . ' ' . $appointment->client->last_name,
                'start' => $appointment->start_time,
                'end' => $appointment->finish_time,
            ];
        }

        return view('fullCalendar', compact('events'));
    }
    public function index()
    {
        return view("site.home");
    }

    public function helpClientIndex()
    {
        return view("site.help_client");
    }

    public function helpTherapyIndex()
    {
        return view("site.help_therapy");
    }
}