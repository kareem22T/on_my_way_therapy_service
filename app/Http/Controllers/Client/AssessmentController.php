<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    public function serviceAgreementIndex()
    {
        return view('client.service_agreement');
    }
    public function riskAssessmentIndex()
    {
        return view('client.risk_assessment_template');
    }
}
