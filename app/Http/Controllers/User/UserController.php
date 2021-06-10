<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Application;

class UserController extends Controller
{
    public function index()
    {
        $all = Application::where('id_pelamar', Auth::user()->id)->count();
        $pending = Application::where('id_pelamar', Auth::user()->id)->where('status', 'pending')->count();
        $ditolak = Application::where('id_pelamar', Auth::user()->id)->where('status', 'ditolak')->count();
        $diterima = Application::where('id_pelamar', Auth::user()->id)->where('status', 'diterima')->count();
        $apps = Application::skip(0)->take(6)->where('id_pelamar', Auth::user()->id)->orderBy('id', 'desc')->get();

        return view('user.index', compact(['all', 'pending', 'ditolak', 'diterima', 'apps']));
    }

    public function Name()
    {
        // dd(Auth()->user());
        return view('user.view');
    }
}
