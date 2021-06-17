<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Application;
use App\User;
use App\Job;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('verified');
    }

    public function index()
    {
        $all = Application::count();
        $pending = Application::where('status', 'pending')->count();
        $ditolak = Application::where('status', 'ditolak')->count();
        $diterima = Application::where('status', 'diterima')->count();
        $apps = Application::skip(0)->take(6)->orderBy('id', 'desc')->get();
        $users = User::skip(0)->take(6)->orderBy('id', 'desc')->whereIn('role', [2, 3])->get();
        $jobs = Job::all();

        return view('admin.index', compact(['all', 'pending', 'ditolak', 'diterima', 'apps', 'users', 'jobs']));
    }

    public function Name()
    {
        // dd(Auth()->user());
        return view('admin.view');
    }
}
