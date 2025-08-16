<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
    public function aboutPage()
    {
        return view('about');
    }
    public function contactPage()
    {
        return view('contact');
    }
    public function dispatchPage()
    {
        return view('dispatch');
    }
    public function privacyPage()
    {
        return view('privacy');
    }
}
