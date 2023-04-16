<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
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
