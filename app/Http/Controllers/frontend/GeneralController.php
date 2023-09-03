<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function about()
    {
        return view('homepage.about');
    }

    public function howItWorks()
    {
        return view('homepage.how-it-works');
    }

    public function packages()
    {
        return view('homepage.packages');
    }

    public function incentives()
    {
        return view('homepage.incentives');
    }

    public function contact()
    {
        return view('homepage.contact');
    }
}
