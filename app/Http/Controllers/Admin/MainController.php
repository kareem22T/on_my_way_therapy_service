<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\SendEmail;
use App\Models\Client;
use App\Models\Doctor;
use Illuminate\Http\Request;

class MainController extends Controller
{
    use SendEmail;

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

        $this->sendEmail(
            $therapist->email,
            'Account accepted',
            'Hi "' . $therapist->first_name . ' ' . $therapist->last_name . '"<br>' . 'Congratulations your account has been approved <br> 
                Login <a href="https://onmywaytherapy.com.au/therapist/login">HERE</a> to set your schedual and start work <br><br><b>Session details: </b><br>' .
                'Contact us: <br>' .
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
