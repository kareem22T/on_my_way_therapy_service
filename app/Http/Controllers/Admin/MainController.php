<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\SendEmail;
use App\Models\Client;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    use SendEmail;

    public function usersClientIndex()
    {
        $clients_data = Client::orderBy('id', 'DESC')->paginate(10);
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
    public function returnTherapist($therapist_id)
    {
        $therapist_data = Doctor::where('approved', 1)->where('payment_registered', 1)->find($therapist_id);
        if ($therapist_data)
            return view('admin.therapist-prev')->with(compact('therapist_data'));
        else
            return redirect('/admin/therapists');
    }
    public function returnClient($id)
    {
        $client = Client::find($id);

        // check if this client filled out the  risk assessments or not to show the alert
        $cleint = Auth::guard('client')->user();

        $apiUrl = 'https://api.jotform.com/form/231613271952554/submissions?apikey=96244a471e11324bcabbe43ab10db2df';

        $ch2 = curl_init();
        curl_setopt($ch2, CURLOPT_URL, $apiUrl);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch2);

        if ($response === false) {
            echo 'Error: ' . curl_error($ch2);
        } else {
            $data = json_decode($response, true);

            foreach ($data['content'] as $content) {
                if ($content['status'] !== 'DELETED')
                    foreach ($content['answers'] as $answer) {
                        if (isset($answer['name']) && $answer['name'] == 'client_id') {
                            if ($answer['answer'] == $client->id) {
                                $answers = $content['answers'];
                            }
                        }
                    }
            }
        }
        curl_close($ch2);

        if ($client)
            return view('admin.client_prev')->with(compact('client', 'answers'));
        else
            return redirect('/admin/therapists');
    }
}
