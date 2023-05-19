<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function usersClientIndex()
    {
        return view('admin.clients');
    }

    public function usersTherapistsIndex()
    {
        return view('admin.therapists');
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
}
