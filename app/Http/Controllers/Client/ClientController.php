<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index()
    {
        return view('client.dashboard.home');
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
}
