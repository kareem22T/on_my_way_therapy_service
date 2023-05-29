<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Doctor;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function usersClientIndex()
    {
        $clients_data = Client::paginate(10);
        return view('admin.clients')->with(compact('clients_data'));
    }

    public function usersTherapistsIndex()
    {
        return view('admin.therapists');
    }
    public function sessionsIndex()
    {
        return view('admin.sessions');
    }
    public function usersTherapistsPreviewIndex()
    {
        return view('admin.therapists_prev');
    }

    public function approveTherapist(Request $request)
    {
        $therapist = Doctor::find($request->therapist_id);
        $therapist->approved = true;
        $therapist->save();

        if ($therapist)
            return response()->json([
                'status' => 200,
                'msg' => $therapist->first_name . ' account has been approved successfully'
            ]);
    }

    public function deleteTherapist(Request $request)
    {
        $therapist = Doctor::find($request->therapist_id);
        $therapist->diagnosis()->delete();
        $therapist->ClientAgeRange()->delete();
        $therapist->holidays()->delete();
        $therapist->chats()->delete();
        $therapist->appointments()->delete();
        $therapist->delete();

        if ($therapist)
            return response()->json([
                'status' => 200,
                'msg' => $therapist->first_name . ' account has been removed successfully'
            ]);
    }

    public function returnTherapistRequest($therapist_id)
    {
        $therapist_data = Doctor::where('approved', 0)->where('payment_registered', 1)->find($therapist_id);
        if ($therapist_data)
            return view('admin.request-prev')->with(compact('therapist_data'));
        else
            return redirect('/admin/therapists');
    }
}
