<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class RiskAssessmentVisitors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $cleint = Auth::guard('client')->user();

        $apiUrl = 'https://api.jotform.com/form/231613271952554/submissions?apikey=96244a471e11324bcabbe43ab10db2df';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if ($response === false) {
            echo 'Error: ' . curl_error($ch);
        } else {
            $data = json_decode($response, true);

            foreach ($data['content'] as $content) {
                if ($content['status'] !== 'DELETED')
                    foreach ($content['answers'] as $answer) {
                        if (isset($answer['name']) && $answer['name'] == 'client_id') {
                            if ($answer['answer'] == $cleint->id) {
                                return redirect('/');
                            }
                        }
                    }
            }
        }

        curl_close($ch);


        return $next($request);
    }
}
