<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Job;
use App\InfoCompany;
use App\Application;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $apps = Application::
        $companies = InfoCompany::skip(0)->take(8)->whereNotNull('npwp')->orderBy('created_at', 'DESC')->get();
        $jobs = Job::skip(0)->take(4)->orderBy('created_at', 'DESC')->get();
        return view('welcome', compact(['jobs', 'companies']));
    }
}
